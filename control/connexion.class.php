<?php
	include_once 'function.php';
class connexion{
	private $pseudo;
	private $mdp;
	private $bdd;
	
	public function __construct($pseudo, $mdp){
		$this->pseudo = $pseudo;
		$this->mdp = $mdp;
		$this->bdd = bdd();
	}
	
	public function verif(){
		$requete = $this->bdd->prepare('SELECT * FROM membres where pseudo = :pseudo');
		$requete->execute([
			'pseudo' => $this->pseudo
			]);
		$reponse = $requete->fetch();
		if($reponse){
			
			$hashOption = [
						'cost' => 11,
						'salt' => 'Er31415pcFklM98745A.Px',
						];
			$this->mdp = password_hash($this->mdp, PASSWORD_BCRYPT, $hashOption);
			
			if($this->mdp == $reponse['mdp']){
				echo 'vous êtes connecté';
				//header ('Location: ../TP_FORUM/index.php');
				return 'ok';
			}
			else{
				return 'mot de passe erroné';
			}
		}
		else{
			return '<br/>pseudo inexistant';
		}
	}
	
	public function session(){//mettre en session toutes les données, tout le monde peut se connecter
		$requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
		$requete->execute([
			'pseudo' => $this->pseudo
			]);
		$requete = $requete->fetch();
		$_SESSION['id'] = $requete['id'];
		$_SESSION['pseudo'] = $this->pseudo;
		
		return 1;
	}
}