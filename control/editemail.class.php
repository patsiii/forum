<?php
	include_once 'function.php';

class modifprofil{
	private $modifemail;
	private $bdd;
	
	public function __construct($modifemail){
		$modifemail = htmlspecialchars($modifemail);
		
		$this->modifemail = $modifemail;
		$this->bdd = bdd();
	}
	public function verif(){
		echo $_SESSION['id'].'&nbsp ,vous êtes sur le point de modifier votre profil';
			$syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
			if(preg_match($syntaxe,$this->modifemail)){
				echo '<br/>email correct';
				return 'ok';
			}
			else{
				$erreur= 'syntaxe de l\'adresse email incorrect';
				return $erreur;
			}
	}
	public function enregistrement(){
		$requete = $this->bdd->prepare('UPDATE membres SET email = :email WHERE id = :id');
		
		$requete->execute([
			'id' => $_SESSION['id'],
			'email' => $this->modifemail
			]);
		return 1;
	}
}