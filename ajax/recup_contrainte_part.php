<?php
	$cont=array();
	$tab=array();
	$inter=$_GET['inter'];
	include("../connexion.php");
		//recupération des contraintes de semaine type de l'intervenant
	$rep=$bd->prepare('SELECT moment, date_cont FROM contrainte_particuliere WHERE id_inter=?');
	$rep->execute(array($inter)) or die(print_r($rep->errorInfo()));
	while ($donnees=$rep->fetch()) {
		array_push($cont, $donnees['moment']);
		array_push($cont, $donnees['date_cont']);
		$text=implode('#', $cont);
		$cont=array();
		array_push($tab, $text);
	}
	$rep->closeCursor();
	echo implode('|', $tab);
?>
