<?php
	
	$id=$_GET['id'];
	include("../connexion.php");
	//suppresion de la liaison avec l'intervenant(table diriger);
	$requette=$bd->prepare('DELETE FROM diriger WHERE id_seance=?');
	$requette->execute(array($id)) or die(print_r($requette->errorInfo()));
	$requette->closeCursor();
	//suppresion de la liaison avec la matiere(table dispenser);
	$requette1=$bd->prepare('DELETE FROM dispenser WHERE id_seance=?');
	$requette1->execute(array($id)) or die(print_r($requette1->errorInfo()));
	$requette1->closeCursor();
	//supresion complete de la seance (table seance);
	$requette2=$bd->prepare('DELETE FROM seance WHERE id_seance=?');
	$requette2->execute(array($id)) or die(print_r($requette2->errorInfo()));
	$requette2->closeCursor();
?>