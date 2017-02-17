<?php 
	if (isset($_POST['num']) and isset($_POST['jr']) and isset($_POST['mois']) and isset($_POST['an']) and isset($_POST['mom'])) {
		$id=$_POST['num'];
		$jr=$_POST['jr'];
		$mois=$_POST['mois'];
		$an=$_POST['an'];
		$moment=$_POST['mom'];
		$date=$an.'-'.$mois.'-'.$jr;
		include("connexion.php");
		$requette1=$bd->prepare('INSERT INTO contrainte_particuliere(date_cont, moment, id_inter) VALUES(?,?,?)');
		$requette1->execute(array($date,$moment,$id)) or die(print_r($requette1->errorInfo()));
		$requette1->closeCursor();
		header('Location: contrainte.php?id='.$id);
	}
	else{
		header('Location: intervenant.php');
	}
 ?>