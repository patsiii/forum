<?php
function bdd(){
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=test2','root','',$pdo_options);
	}
	catch(Exception $e){
		die('Erreur:'.$e->getMessage());
	}
	return $bdd;
}