<?php
	if (isset($_GET['mat']) and isset($_GET['an'])) {
		$mat=$_GET['mat'];
		$annee=$_GET['an'];
	}
	include("connexion.php");
	$sup=$bd->prepare('DELETE FROM intervenir WHERE id_mat=? and annee=?');
	$sup->execute(array($mat,$annee)) or die(print_r($sup->errorInfo()));
	header('Location: gestion_matiere.php?an='.$annee);
?>
