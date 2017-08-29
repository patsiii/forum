<?php session_start();
include_once '../control/function.php';
include_once '../control/addavatar.class.php';

$monavatar = new avatar('avatar');
	if ($monavatar->verif() == 'ok'){
		$monavatar->enregistrement();
	}
?>
<?php require '../vue/header.php';?>
	<h1>Ajouter un avatar</h1>
		<form method="POST" action="addavatar.php" enctype="multipart/form-data">
			 <!-- On limite le fichier à 2Mo -->
			 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			 Fichier : <input type="file" name="avatar">
			 <br/><input type="submit" class="btn btn-primary" name="envoyer" value="Ajouter un avatar">
		</form>
	</body>
</html>