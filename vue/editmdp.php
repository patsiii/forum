<?php session_start();
include_once '../control/function.php';
include_once '../control/editmdp.class.php';

	$bdd = bdd();
	if(isset($_POST['newmdp']) AND isset($_POST['newmdp2'])){
		$modifprofil = new modifprofil($_POST['newmdp'],$_POST['newmdp2']);
		$verification = $modifprofil->verif();
		if($verification == 'ok'){
			if($modifprofil->enregistrement()){
				header ('Location: index.php');
			}
			else{
				echo '<br/>Une erreur est survenue<br/>';
			}
			return 'vérification ok';
		}
		else{
			//header ('Location: index.php');
		}
	}
?>
<?php require '../vue/header.php';?>
		<h1>Editer mot de passe</h1>
		<form method="post" action="editmdp.php">
			<input name="newmdp" type="password" placeholder="Nouveau mot de passe..." required /><br/><br/>
			<input name="newmdp2" type="password" placeholder="Confirmer ..." required /><br/><br/>
			<br/><input type="submit" class="btn btn-primary" value="Editer mot de passe" required />
			<?php
				if (isset($erreur) ){
					echo $erreur;
				}
			?>
		</form>
	</body>
</html>