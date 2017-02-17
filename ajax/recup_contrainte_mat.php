<?php
	$tab=array();
	$inter=$_GET['inter'];
	include("../connexion.php");
		//recupération des contraintes de semaine type de l'intervenant
	$rep=$bd->prepare('SELECT niveau FROM contrainte WHERE id_inter=? and moment=?');
	$rep->execute(array($inter,'matin')) or die(print_r($rep->errorInfo()));
	while ($donnees=$rep->fetch()) {
		array_push($tab, $donnees['niveau']);
	}
	$rep->closeCursor();
	echo implode('|', $tab);
?>
