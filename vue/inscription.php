<?php session_start();
include_once '../control/function.php';
include_once '../control/inscription.class.php';
$bdd = bdd();
if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['mdp']) AND isset($_POST['mdp2'])){
	$inscription = new inscription($_POST['pseudo'],$_POST['email'],$_POST['mdp'],$_POST['mdp2']);
	$verif = $inscription->verif();
	if($verif == 'ok'){
		if($inscription->enregistrement()){
			if($inscription->session()){/*Tout est mis en session*/
				header ('Location: index.php');
			}
		}
		else{
			echo '<br/>Une erreur est survenue<br/>';
		}
	}
	else{
		$erreur = $verif;
	}
}

?>
<?php require '../vue/header.php';?>
		<h1>inscription &nbsp &nbsp <a href="connexion.php" id="seConnecter">Se connecter</a></h1>
		<form method="post" action="inscription.php">
			<div class="form-group">
				<input name="pseudo" type="text" class="form-control" placeholder="Pseudo..." required /><br/>
			</div>
			<div class="form-group">
				<input name="email" type="email" class="form-control" placeholder="Adresse e-mail..." required /><br/>
			</div>
			<div class="form-group">
				<input name="mdp" type="password" class="form-control" placeholder="Mot de passe..." required /><br/>
			</div>
			<div class="form-group">
				<input name="mdp2" type="password" class="form-control" placeholder="Confirmer mot de passe..." required /><br/>
			</div>
			<table>
			 <t>
				 <td><label for="captcha">Recopiez ces caractères :
					<td>	
						&nbsp <img src="../modele/captcha.php" alt="Captcha" id="captcha" width="80" height="50" /></label>
						&nbsp <span class="glyphicon glyphicon-refresh" onclick="document.getElementById('captcha').src = '../modele/captcha.php?r='+new Date().getMilliseconds();"></span>
					</td>
				</td>
			</tr>
			 <tr><td><input type="text" name="captcha" id="captcha" /><br /></td></tr>
			</table>
			<br/><input type="submit" class="btn btn-primary" value="S'inscrire" />
			<?php
				if (isset($erreur) ){
					echo $erreur;
				}
			?>
		</form>
	</body>
</html>