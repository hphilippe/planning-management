<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	include("../connexion.php");
	$sup=$bd->prepare('DELETE FROM unite_enseignement WHERE id_ue=?');
	$sup->execute(array($id)) or die(print_r($sup->errorInfo()));
	//header('Location: unite_enseignement.php');

?>
