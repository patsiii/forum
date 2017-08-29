<?php session_start();
include_once '../control/function.php';
include_once '../control/addPost.class.php';
$bdd = bdd();
if(!isset($_SESSION['id'])){
	header ('Location: inscription.php');
}
else{
	
	if (isset($_POST['name']) AND  isset($_POST['sujet']) ){

		$addPost = new addPost($_POST['name'],$_POST['sujet']);
		$verif = $addPost->verif();
		if($verif == 'ok'){
			if($addPost->insert()){
				header ('Location: index.php?sujet='.$_POST['name']);
			}
			else{
				
			}
		}
		else{
			$erreur = $verif;
		}
	}
	
	?>
<?php require '../vue/header.php';?>

		<h1>Bienvenue</h1>
		<!--<div class="jumbotron">-->
		<div id="Cform">
		<?php
		$monavatar = $bdd->prepare('SELECT avatar FROM membres WHERE id= :id');
		$monavatar->execute([
			'id' => $_SESSION['id']
		]);
		$monavatar = $monavatar->fetch();
		?>
			<div>
				<h4>Utilisateur: <img width="40" height="40" id="avatar" src="../vue/images/avatar/<?php echo $monavatar['avatar']; ?>">
				<?php echo $_SESSION['pseudo']; ?></h4>
			</div>
		<?php

			if(isset($_GET['categorie'] )){/*Si on est dans une catégorie*/
				$_GET['categorie'] = htmlspecialchars($_GET['categorie']);
				?>
					<div class="jumbotron" id="categorie">
					<!--<div class="categories">-->
						<h4><?php echo strtoupper($_GET['categorie']); ?></h4>
					</div>
					<?php
					$requete = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie');
					$requete->execute(array(
						'categorie'=>$_GET['categorie']
						));
						
						while($reponse = $requete->fetch()){
							?>
							<div class="nav nav-pills">
								<a href="index.php?sujet=<?php echo $reponse['name']; ?>"><h4 id="sujet"><?php echo $reponse['name']; ?></h4></a>
							</div>
						<?php
						}
						?>
					<a href="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">Ajouter un sujet</a>
				<?php
			}
			
			else if(isset($_GET['sujet'] )){/*Si on est dans une POST*/
				$_GET['sujet'] = htmlspecialchars($_GET['sujet']);
				?>
					<div class="jumbotron" id="categorie">
					<!--<div class="categories">-->
						<h4><?php echo strtoupper($_GET['sujet']); ?></h4>
					</div>
					<?php
						$requete = $bdd->prepare('SELECT * FROM postsujet WHERE sujet = :sujet');
						$requete->execute(['sujet'=>$_GET['sujet']]);
						?>
						<div class="bs-component">
							<table class="table table-striped table-hover ">
							<thead>
							  <tr>
								<th>#</th>
								<th>Utilisateur</th>
								<th>Commentaires</th>
							  </tr>
							</thead>
						<?php
						while ($reponse = $requete->fetch()){
					?>
						<div class="post">
							<?php
								$requete2 = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
								$requete2->execute(['id'=>$reponse['propri']]);
								$membres = $requete2->fetch();
							?>
							
						</div>
							<tbody>
							  <tr>
								<td><?php echo $membres['id']; ?></td>
								<td><?php echo $membres['pseudo'];?></td>
								<td><?php echo $reponse['contenu'];?></td>
							  </tr>
							</tbody>
							<?php
							
						}
					?>		</table>
						</div>
						
						<form method="post" action="index.php?sujet=<?php echo $_GET['sujet'] ?>">
							<textarea name="sujet" placeholder="commentaire..." ></textarea>
							<input type="hidden" name="name" value="<?php echo $_GET['sujet']?>" /><br/>
							<br/><input class="btn btn-default btn-primary" type="submit" value="Ajouter à la conversation"/>
							<?php
								if(isset($erreur)){
									echo $erreur;
								}
								else{
									
								}
							?>
						</form>
				<?php
			}
			else{/*si on est sur la page normale*/
					$requete = $bdd->query('SELECT * FROM categories');
					while($reponse = $requete->fetch()){
						?>
						<div class="jumbotron" id="categorie">
						<!--<div class="categories">-->
							<a href="index.php?categorie=<?php echo $reponse['name']; ?>"><?php echo strtoupper($reponse['name']); ?></a><br/><br/>
						</div>
					<?php
					}
			}
			?>
		</div>
	</body>
</html>
<?php
}
?>