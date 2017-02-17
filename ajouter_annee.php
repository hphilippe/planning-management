<?php
	if (isset($_POST['an'])) {
		$annee=$_POST['an'];
		include("connexion.php");
	 	$requette=$bd->prepare('INSERT INTO annee(annee) VALUES(?)');
	 	$requette->execute(array($annee)) or die(print_r($requette->errorInfo()));
	 	$requette->closeCursor();
	 	//recuperatin de l'année directement anterieur
	 	$requette1=$bd->prepare('SELECT annee FROM annee WHERE annee <> ?
	 							ORDER BY annee DESC
	 							LIMIT 1');
	 	$requette1->execute(array($annee)) or die(print_r($requette1->errorInfo()));
	 	$reponse=$requette1->fetch();
	 	$an=$reponse['annee'];
	 	$requette1->closeCursor();
	 	$requette2=$bd->prepare('SELECT id_mat, id_inter FROM intervenir WHERE annee= ?');
	 	$requette2->execute(array($an)) or die(print_r($requette2->errorInfo()));
	 	while ($intervenir=$requette2->fetch()) {
	 		$requette3=$bd->prepare('INSERT INTO intervenir(id_mat,id_inter,annee) VALUES(?, ?, ?)');
	 		$requette3->execute(array($intervenir['id_mat'], $intervenir['id_inter'], $annee)) or die(print_r($requette3->errorInfo()));
	 		$requette3->closeCursor();
	 	}
	 	$requette2->closeCursor();
	 	header('Location: periodes.php?an='.$annee);
	}
	else{
		header('Location: index.php');
	}
?>
	 