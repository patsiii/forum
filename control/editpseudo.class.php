<?php
	include_once 'function.php';

class modifprofil{
	private $modifpseudo;
	private $bdd;
	
	public function __construct($modifpseudo){
		$modifpseudo = htmlspecialchars($modifpseudo);
		
		$this->modifpseudo = $modifpseudo;
		$this->bdd = bdd();
	}
	public function verif(){
		$reqpseudo = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo =:pseudo');
		$reqpseudo->execute([
			'pseudo'=>$this->modifpseudo
		]);
		$resultat = $reqpseudo->fetch();
		if(!$resultat){
			if(strlen($this->modifpseudo)>2 AND strlen($this->modifpseudo)<20){//pseudo bon
				return 'ok';
			}
			else{
				echo 'Le pseudo doit contenir entre 2 et 20 caractères';
			}
		}
		else{//pseudo mauvais
			echo 'pseudo déjà utilisé';
		}
	}
	
	public function enregistrement(){
		$requete = $this->bdd->prepare('UPDATE membres SET pseudo = :pseudo WHERE id = :id');
		
		$requete->execute([
			'id' => $_SESSION['id'],
			'pseudo' => $this->modifpseudo
			]);
		return 1;
	}
	
	public function session(){//mettre en session toutes les données, tout le monde peut se connecter
		$requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
		$requete->execute([
			'pseudo' => $this->modifpseudo
			]);
		$requete = $requete->fetch();
		$_SESSION['pseudo'] = $this->modifpseudo;
		return 1;
	}
}