<?php 
	if (isset($_POST['mat']) and isset($_POST['an']) and isset($_POST['inter'])) {
		$mat=$_POST['mat'];
		$annee=$_POST['an'];
		$inter=$_POST['inter'];
		include("connexion.php");
		//nombre des intervenant selectionés dans a variable $n
		$n=count($inter);
		//on insert les couples matiere-intervenant dans la table intervenir
		//créant ainsi une liaison entre matiere et intervenant
		for ($i=0; $i < $n ; $i++) { 
			$requette1=$bd->prepare('INSERT INTO intervenir(id_mat,id_inter,annee) VALUES(?, ?, ?)');
			$requette1->execute(array($mat, $inter[$i], $annee)) or die(print_r($requette1->errorInfo()));
			$requette1->closeCursor();
		}
		header('Location: gestion_matiere.php?an='.$annee);
	}
	else{
		header('Location: gestion_matiere.php?an='.$annee);
	}
 ?>