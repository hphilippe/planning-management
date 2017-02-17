<?php
	$id=$_GET['id'];
	include("../connexion.php");
		//recupération de la table unité d'enseignement
	$rep=$bd->prepare('SELECT id_inter, nom_inter, prenom, email, commentaire FROM intervenant WHERE id_inter=?');
	$rep->execute(array($id)) or die(print_r($rep->errorInfo()));
	$donnees=$rep->fetch();
	$resultat=$donnees['id_inter'].'|'.$donnees['nom_inter'].'|'.$donnees['prenom'].'|'.$donnees['email'].'|'.$donnees['commentaire'];
	$rep->closeCursor();
	echo $resultat;
?>
