<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	include("../connexion.php");
	$sup1=$bd->prepare('DELETE FROM semaine WHERE id_per=?');
	$sup1->execute(array($id)) or die(print_r($sup1->errorInfo()));
	$sup1->closeCursor();
	$sup=$bd->prepare('DELETE FROM periode WHERE id_per=?');
	$sup->execute(array($id)) or die(print_r($sup->errorInfo()));
	$sup->closeCursor();
	//header('Location: periodes.php?an='.$annee);
	}
?>
