<?php
	include_once 'function.php';

class avatar{
	private $avatar;
	private $bdd;
	
	public function __construct($avatar){
		
		$this->avatar = 'avatar';
		$this->bdd = bdd();
	}
	public function verif(){
		if (isset($_FILES[$this->avatar]) AND !empty($_FILES[$this->avatar]['name'])){
		$tailleMax = 2097152; //limiter la taille de l'avatar à 2Mo
		$taille = filesize($_FILES[$this->avatar]['tmp_name']);
		$extensionsValides = [
			'jpg',
			'jpeg',
			'gif',
			'png'
		];
			if($taille < $tailleMax){
				//ignorer un caractère et checker l'extension du fichier
				$extensionUpload = strtolower(substr(strrchr($_FILES[$this->avatar]['name'], '.'), 1) );
				if(in_array($extensionUpload, $extensionsValides)){
					return 'ok';
				}
			}
		}
	}
	public function enregistrement(){
		$extensionUpload = strtolower(substr(strrchr($_FILES[$this->avatar]['name'], '.'), 1) );
		$chemin = '../vue/images/avatar/'.$_SESSION['id'].'.'.$extensionUpload;
		$resultat = move_uploaded_file($_FILES[$this->avatar]['tmp_name'],$chemin);
		if($resultat){
			echo '<br/>upload ok';
			//ajouter une colonne avatar dans bdd membres
			$updateavatar = $this->bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id= :id');
			$updateavatar->execute([
				'avatar' => $_SESSION['id'].'.'.$extensionUpload,
				'id' => $_SESSION['id']
			]);
			header ('Location: index.php');
		}
		return 1;
	}
}