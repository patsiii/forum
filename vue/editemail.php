<?php session_start();
include_once '../control/function.php';
include_once '../control/editemail.class.php';

	$bdd = bdd();
	if(isset($_POST['newemail'])){
		$modifprofil = new modifprofil($_POST['newemail']);
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
		return 'non vérifiée';
		}
	}
?>
<?php require '../vue/header.php';?>
		<h1>Editer email</h1>
		<form method="post" action="editemail.php">
			<input name="newemail" type="email" placeholder="Adresse e-mail..." required /><br/>
			<br/><input type="submit" class="btn btn-primary" value="Editer mon email" required />
			<?php
				if (isset($erreur) ){
					echo $erreur;
				}
			?>
		</form>
	</body>
</html>