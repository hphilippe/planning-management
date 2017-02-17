<?php
	$id=$_GET['id'];

	include("../connexion.php");
		//recupération de la table unité d'enseignement
	$rep=$bd->prepare('SELECT * FROM unite_enseignement WHERE id_ue=?');
	$rep->execute(array($id)) or die(print_r($rep->errorInfo()));
	$donnee=$rep->fetch();
	echo $donnee['id_ue'].'|'.$donnee['nom_ue'];
	$rep->closeCursor();
?>
