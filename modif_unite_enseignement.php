<?php 
	if (isset($_POST['id']) and isset($_POST['nom'])) {
		$id=$_POST['id'];
		$nom=$_POST['nom'];
		include("connexion.php");
		$req=$bd->prepare("UPDATE unite_enseignement SET nom_ue=? WHERE id_ue=?");
		$req->execute(array($nom,$id)) or die(print_r($req->errorInfo()));
		$req->closeCursor();
		header('Location: unite_enseignement.php');
	}
	else{
		header('Location: unite_enseignement.php');
	}
 ?>