<?php 
	if (isset($_POST['id']) and isset($_POST['nom']) and isset($_POST['pre']) and isset($_POST['mail']) and isset($_POST['com'])) {
		$id=$_POST['id'];
		$nom=$_POST['nom'];
		$pre=$_POST['pre'];
		$mail=$_POST['mail'];
		$com=$_POST['com'];
		include("connexion.php");
		$req=$bd->prepare("UPDATE intervenant SET nom_inter=?, prenom=?, email=?, commentaire=? WHERE id_inter=?");
		$req->execute(array($nom,$pre,$mail,$com,$id)) or die(print_r($req->errorInfo()));
		$req->closeCursor();
		header('Location: intervenant.php');
	}
	else{
		header('Location: intervenant.php');
	}
 ?>