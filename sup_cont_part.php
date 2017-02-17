<?php
	if (isset($_GET['id']) and isset($_GET['num'])) {
		$num=$_GET['num'];
		$id=$_GET['id'];
	
	include("connexion.php");
	$sup=$bd->prepare('DELETE FROM contrainte_particuliere WHERE id_cont_par=?');
	$sup->execute(array($num)) or die(print_r($sup->errorInfo()));
	header('Location: contrainte.php?id='.$id);
	}
?>
