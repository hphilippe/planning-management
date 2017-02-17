<?php
	if (isset($_GET['inter']) and isset($_GET['mat']) and isset($_GET['an'])) {
		$inter=$_GET['inter'];
		$mat=$_GET['mat'];
		$annee=$_GET['an'];
	}
	include("connexion.php");
	$sup=$bd->prepare('DELETE FROM intervenir WHERE id_mat=? and id_inter=? and annee=?');
	$sup->execute(array($mat,$inter,$annee)) or die(print_r($sup->errorInfo()));
	header('Location: gestion_matiere.php?an='.$annee);
?>
