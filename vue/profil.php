<?php session_start();
	include_once '../control/function.php';
	
	if(!isset($_SESSION['id'])){
		header ('Location: connexion.php');
	}
?>
<?php require '../vue/header.php';?>
		<h1>Editer mon profil</h1>
		<form class="form-horizontal">
			<div class="form-group">
				<p>Ajouter avatar</p>
				<a href="addavatar.php" class="form-control">ajouter</a><br/>
				<?php echo 'Votre pseudo :'.$_SESSION['pseudo']; ?>
				<a href="editpseudo.php" class="form-control">&nbspéditer</a><br/>
			</div>
			<div class="form-group">
				<?php
				$bddemail = bdd();
				$email = $bddemail->prepare('SELECT email FROM membres WHERE id = :id');
				$email->execute([
					'id'=>$_SESSION['id']
				]);
				$reponse = $email->fetch();
				echo 'Votre email :'.$reponse['email'];
				?>
				<a href="editemail.php" class="form-control">&nbspéditer</a><br/>
				<?php
				echo 'Editer mot de passe :';
				?>
				<a href="editmdp.php" class="form-control">éditer</a><br/>
			</div>
		</form>
	</body>
</html>