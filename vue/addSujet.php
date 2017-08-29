<?php
session_start();
		include_once '../control/function.php';
		include_once '../control/addSujet.class.php';
$bdd = bdd();

if (isset($_POST['name']) AND  isset($_POST['sujet']) ){

	$addSujet = new addSujet($_POST['name'],$_POST['sujet'],$_POST['categorie'] );
	$verif = $addSujet->verif();
	if($verif == 'ok'){
		if($addSujet->insert()){
			header ('Location: index.php?sujet='.$_POST['name']);
		}
		else{
			
		}
	}
	else{
		$erreur = $verif;
	}
}
else{
	
}

?>
<?php require '../vue/header.php';?>
		<h1>Ajouter un sujet</h1>
		<div id="Cform">
			<form method="post" action="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">
				<p>
					<input type="text" name="name" placeholder="Nom du sujet..." required /><br/>
					<textarea name="sujet" placeholder="Contenu du sujet..." ></textarea><br/>
					<input type="hidden" value="<?php echo $_GET['categorie']; ?>" name="categorie" /><br/>
					<input type="submit" class="btn btn-primary" value="Ajouter le sujet" />
						<?php
							if(isset($erreur)){
								echo $erreur;
							}
						?>
				</p>
			</form>
		</div>
	</body>
</html>