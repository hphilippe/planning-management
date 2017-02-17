<?php
	$id=$_GET['id'];
	include("../connexion.php");
		//recupération de la table unité d'enseignement
	$rep=$bd->prepare('SELECT id_mat, nom_mat, abreg_mat, nb_heure,nbh_seance FROM matiere WHERE id_mat=?');
	$rep->execute(array($id)) or die(print_r($rep->errorInfo()));
	$donnees=$rep->fetch();
	$resultat=$donnees['id_mat'].'|'.$donnees['nom_mat'].'|'.$donnees['abreg_mat'].'|'.$donnees['nb_heure'].'|'.$donnees['nbh_seance'];
	$rep->closeCursor();
	echo $resultat;
?>
