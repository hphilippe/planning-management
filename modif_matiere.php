<?php 
	if (isset($_POST['id']) and isset($_POST['nom']) and isset($_POST['abreg']) and isset($_POST['nbh']) and isset($_POST['ue']) and isset($_POST['nbhs'])) {
		$id=$_POST['id'];
		$nom=$_POST['nom'];
		$abreg=$_POST['abreg'];
		$nbh=$_POST['nbh'];
		$ue=$_POST['ue'];
		$hseance=$_POST['nbhs'];
		include("connexion.php");
		$req=$bd->prepare("UPDATE matiere SET nom_mat=?,abreg_mat=?,nb_heure=?, nbh_seance=?,id_ue=? WHERE id_mat=?");
		$req->execute(array($nom,$abreg,$nbh,$hseance,$ue,$id)) or die(print_r($req->errorInfo()));
		$req->closeCursor();
		header('Location: matiere.php');
	}
	else{
		header('Location: matiere.php');
	}
 ?>