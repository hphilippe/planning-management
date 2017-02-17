<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	include("../connexion.php");
	$sup=$bd->prepare('DELETE FROM intervenant WHERE id_inter=?');
	$sup->execute(array($id)) or die(print_r($sup->errorInfo()));
	//header('Location: matiere.php');
?>
