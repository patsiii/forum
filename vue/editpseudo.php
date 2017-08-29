<?php session_start();
include_once '../control/function.php';
include_once '../control/editpseudo.class.php';

	$bdd = bdd();
	if(isset($_POST['newpseudo'])){
		$modifprofil = new modifprofil($_POST['newpseudo']);
		$verification = $modifprofil->verif();
		if($verification == 'ok'){
			if($modifprofil->enregistrement()){
				if($modifprofil->session()){/*Tout est mis en session*/
					header ('Location: index.php');
				}
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
		<h1>Editer email</h1>
		<form method="post" action="editpseudo.php">
			<input name="newpseudo" type="text" placeholder="Nouveau pseudo..." required /><br/>
			<br/><input type="submit" class="btn btn-primary" value="Editer pseudo" required />
			<?php
				if (isset($erreur) ){
					echo $erreur;
				}
			?>
		</form>
	</body>
</html>