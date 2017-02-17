<?php 
	if (isset($_POST['nom'])) {
		$nom=$_POST['nom'];

		include("connexion.php");
		$req=$bd->prepare("INSERT INTO unite_enseignement(nom_ue) VALUES(?)");
		$req->execute(array($nom)) or die(print_r($req->errorInfo()));
		$req->closeCursor();
		header('Location: unite_enseignement.php');
	}
	else{
		header('Location: unite_enseignement.php');
	}
 ?>