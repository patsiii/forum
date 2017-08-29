<?php //session_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
		include_once '../control/function.php';
		include_once '../control/connexion.class.php';
		
$bdd = bdd();
if(isset($_POST['pseudo']) AND isset($_POST['mdp'])){
	$connexion = new connexion(($_POST['pseudo']),$_POST['mdp']);
	$verif = $connexion->verif();
	if ($verif == 'ok'){
		if($connexion->session()){/*Tout est mis en session*/
			header ('Location: index.php');
		}
		else{
			header ('Location: inscription.php');
		}
	}
	else{
		$erreur = $verif;
	}
}
?>
<?php require '../vue/header.php';?>
		<h1>Connexion
			<a href="inscription.php" id="inscription">S'inscrire</a>
		</h1>
		<form method="post" action="connexion.php">
			<div class="form-group">
				<input name="pseudo" type="text"class="form-control"  placeholder="Pseudo..." required /><br/>
			</div>
			<div class="form-group">
				<input name="mdp" type="password" class="form-control" placeholder="Mot de passe..." required /><br/>
			</div>
			<br/><input type="submit"class="btn btn-primary"  value="Se connecter" required />
			<?php
				if(isset($erreur)){
					echo $erreur;
				}
			?>
		</form>
	</body>
</html>