<?php
	$tab=array();
	include("../connexion.php");
		//recupération de la table unité d'enseignement
	$rep=$bd->query('SELECT id_ue FROM unite_enseignement') or die(print_r($bd->errorInfo()));
	while($donnee=$rep->fetch()){
			array_push($tab, $donnee['id_ue']);
		}
	$rep->closeCursor();
	echo implode('|', $tab);
?>
