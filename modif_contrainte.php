<?php 
	if (isset($_POST['num']) and isset($_POST['m1']) and isset($_POST['m2']) and isset($_POST['m3']) and isset($_POST['m4']) and isset($_POST['m5'])
		and isset($_POST['am1']) and isset($_POST['am2']) and isset($_POST['am3']) and isset($_POST['am4']) and isset($_POST['am5']) ) {
		$lm=$_POST['m1'];
		$mam=$_POST['m2'];
		$mem=$_POST['m3'];
		$jm=$_POST['m4'];
		$vm=$_POST['m5'];
		$lam=$_POST['am1'];
		$maam=$_POST['am2'];
		$meam=$_POST['am3'];
		$jam=$_POST['am4'];
		$vam=$_POST['am5'];
		$id=$_POST['num'];
		$tab=array($lm,$mam,$mem,$jm,$vm,$lam,$maam,$meam,$jam,$vam);
		include("connexion.php");
		$rep=$bd->prepare('SELECT id_cont FROM contrainte WHERE id_inter=?');
		$rep->execute(array($id)) or die(print_r($rep->errorInfo()));
		$i=0;
		while ($donnees=$rep->fetch()) {
			$requette1=$bd->prepare('UPDATE contrainte SET niveau=? WHERE id_cont=?');
			$requette1->execute(array($tab[$i],$donnees['id_cont'])) or die(print_r($requette1->errorInfo()));
			$requette1->closeCursor();
			$i++;
		}
		header('Location: contrainte.php?id='.$id);
	}
	else{
		header('Location: intervenant.php');
	}
 ?>