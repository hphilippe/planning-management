<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	include("../connexion.php");
	$sup=$bd->prepare('DELETE FROM matiere WHERE id_mat=?');
	$sup->execute(array($id)) or die(print_r($sup->errorInfo()));
	header('Location: matiere.php');
?>
