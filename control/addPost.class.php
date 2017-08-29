<?php
	/*if(!isset($_SESSION)) 
    { 
        session_start(); 
    }*/
	
	include_once 'function.php';

class addPost{
	private $name;
	private $sujet;
	private $bdd;
	
	public function __construct($name,$sujet){
		$this->sujet = htmlspecialchars($sujet);
		$this->name = htmlspecialchars($name);
		$this->bdd = bdd();
	}
	public function verif(){
			if(strlen($this->sujet)>0 ){/*si on a bien un sujet */
				
				return 'ok';
			}
			else{/*Si on n'a pas de contenu*/
				$erreur = 'Veuillez entrer le contenu';
				return $erreur;
			}

	}
	public function insert(){

		$requete2 = $this->bdd->prepare('INSERT INTO postsujet(propri,contenu,date,sujet) VALUES (:propri,:contenu,NOW(),:sujet)');
		$requete2->execute([
			'propri' => $_SESSION['id'],
			'contenu' => $this->sujet,
			'sujet' => $this->name
			]);
		
		return 1;
	}
}