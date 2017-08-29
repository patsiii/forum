<?php
	/*if(!isset($_SESSION)) 
    { 
        session_start(); 
    }*/
	
	include_once 'function.php';

class addSujet{
	private $name;
	private $sujet;
	private $categorie;
	private $bdd;
	
	public function __construct($name,$sujet,$categorie){
		$this->name = htmlspecialchars($name);
		$this->sujet = htmlspecialchars($sujet);
		$this->categorie = htmlspecialchars($categorie);
		$this->bdd = bdd();
	}
	public function verif(){
		if(strlen($this->name)>5 AND strlen($this->name)<40){/*si le nom du sujet est bon*/
			if(strlen($this->sujet)>0 ){/*si on a bien un sujet */
				
				return 'ok';
			}
			else{/*Si on n'a pas de contenu*/
				$erreur = 'Veuillez entrer le contenu';
				return $erreur;
			}
		}
		else{/*si le nom du sujet est mauvais*/
			$erreur = 'Le nom du sujet doit contenir entre 5 et 20 caractères';
			return $erreur;
		}
	}
	public function insert(){
		$requete = $this->bdd->prepare('INSERT INTO sujet(name,categorie) VALUES (:name, :categorie)');
		$requete->execute([
			'name' => $this->name,
			'categorie' => $this->categorie
			]);
		
		$requete2 = $this->bdd->prepare('INSERT INTO postsujet(propri,contenu,date,sujet) VALUES (:propri,:contenu,NOW(),:sujet)');
		$requete2->execute([
			'propri' => $_SESSION['id'],
			'contenu' => $this->sujet,
			'sujet' => $this->name
			]);
		return 1;
	}
}