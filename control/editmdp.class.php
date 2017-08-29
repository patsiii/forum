<?php
	include_once 'function.php';

class modifprofil{
	private $modifmdp;
	private $modifmdp2;
	private $bdd;
	
	public function __construct($modifmdp,$modifmdp2){
		$modifmdp = htmlspecialchars($modifmdp);
		$modifmdp2 = htmlspecialchars($modifmdp2);
		
		$this->modifmdp = $modifmdp;
		$this->modifmdp2 = $modifmdp2;
		$this->bdd = bdd();
	}
	public function verif(){
		if(strlen($this->modifmdp)>2 AND strlen($this->modifmdp)<20){
			if($this->modifmdp == $this->modifmdp2){
				$hashOption = [
				'cost' => 11,
				'salt' => 'Er31415pcFklM98745A.Px',
				];
				$this->modifmdp = password_hash($this->modifmdp, PASSWORD_BCRYPT, $hashOption);
				return 'ok';
			}
			else{
				echo 'Les mots de passe doivent être identiques';
			}
		}
		else{
			echo 'Le mot de passe doit contenir entre 2 et 20 caractères';
		}
	}
	
	public function enregistrement(){
		$requete = $this->bdd->prepare('UPDATE membres SET mdp = :mdp WHERE id = :id');
		
		$requete->execute([
			'id' => $_SESSION['id'],
			'mdp' => $this->modifmdp
			]);
		return 1;
	}
}