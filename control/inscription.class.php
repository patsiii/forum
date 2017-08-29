<?php	//session_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
		include_once 'function.php';

class inscription{
	private $pseudo;
	private $email;
	private $mdp;
	private $mdp2;
	private $bdd;
	private $captcha;
	
	public function __construct($pseudo,$email,$mdp,$mdp2){
		$pseudo = htmlspecialchars($pseudo);
		$email = htmlspecialchars($email);
		$mdp = htmlspecialchars($mdp);
		$mdp2 = htmlspecialchars($mdp2);
		
		$this->pseudo = $pseudo;
		$this->email = $email;
		$this->mdp = $mdp;
		$this->mdp2 = $mdp2;
		$this->bdd = bdd();
	}
	public function verif(){
		$reqpseudo = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo =:pseudo');
		$reqpseudo->execute([
			'pseudo'=>$this->pseudo
		]);
		$resultat = $reqpseudo->fetch();
		if(!$resultat){
				if(strlen($this->pseudo)>2 AND strlen($this->pseudo)<20){//pseudo bon
				$syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
				if(preg_match($syntaxe,$this->email)){
					if(strlen($this->mdp)>2 AND strlen($this->mdp)<20){
						if($this->mdp == $this->mdp2){
							$hashOption = [
							'cost' => 11,
							'salt' => 'Er31415pcFklM98745A.Px',
							];
							$this->mdp = password_hash($this->mdp, PASSWORD_BCRYPT, $hashOption);
							
								if(!empty($_POST['captcha']) AND ($_POST['captcha'] == $_SESSION['captcha'])){
									return 'ok';
								}
								else{
									return 'captcha error';
								}
						}
						else{
							$erreur = 'Les mots de passe doivent être identiques';
							return $erreur;
						}
					}
					else{
						$erreur = 'Le mot de passe doit contenir entre 5 et 20 caractères';
						return $erreur;
					}
				}
				else{
					$erreur= 'syntaxe de l\'adresse email incorrect';
					return $erreur;
				}
			}
			else{
				return 'Le pseudo doit contenir entre 5 et 20 caractères';
			}
		}
		else{//pseudo mauvais
			return 'pseudo déjà utilisé';
		}
	}
	
	public function enregistrement(){
		$requete = $this->bdd->prepare('INSERT INTO membres (pseudo,email,mdp) VALUES (:pseudo,:email,:mdp)');
		
		$requete->execute([
			'pseudo' => $this->pseudo,
			'email' => $this->email,
			'mdp' => $this->mdp
			]);
		return 1;
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