<?php 
	if (isset($_POST['nom']) and isset($_POST['pre']) and isset($_POST['mail']) and isset($_POST['com'])) {
		$nom=$_POST['nom'];
		$pre=$_POST['pre'];
		$mail=$_POST['mail'];
		$com=$_POST['com'];
		include("connexion.php");
		$req=$bd->prepare("INSERT INTO intervenant(nom_inter,prenom,email,commentaire) VALUES(?,?,?,?)");
		$req->execute(array($nom,$pre,$mail,$com))  or die(print_r($req->errorInfo()));
		$req->closeCursor();
		$requette=$bd->query('SELECT id_inter FROM intervenant
								ORDER BY id_inter
								LIMIT 1') or die(print_r($bd->errorInfo()));
		$inter=$requette->fetch();
		$requette->closeCursor();
		$requette1=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette1->execute(array('lundi','matin','disponible',$inter['id_inter'])) or die(print_r($requette1->errorInfo()));
		$requette1->closeCursor();
		$requette2=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette2->execute(array('mardi','matin','disponible',$inter['id_inter'])) or die(print_r($requette2->errorInfo()));
		$requette2->closeCursor();
		$requette3=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette3->execute(array('mercredi','matin','disponible',$inter['id_inter'])) or die(print_r($requette3->errorInfo()));
		$requette3->closeCursor();
		$requette4=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette4->execute(array('jeudi','matin','disponible',$inter['id_inter'])) or die(print_r($requette4->errorInfo()));
		$requette4->closeCursor();
		$requette5=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette5->execute(array('vendredi','matin','disponible',$inter['id_inter'])) or die(print_r($requette5->errorInfo()));
		$requette5->closeCursor();
		$requette6=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette6->execute(array('lundi','a-midi','disponible',$inter['id_inter'])) or die(print_r($requette6->errorInfo()));
		$requette6->closeCursor();
		$requette7=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette7->execute(array('mardi','a-midi','disponible',$inter['id_inter'])) or die(print_r($requette7->errorInfo()));
		$requette7->closeCursor();
		$requette8=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette8->execute(array('mercredi','a-midi','disponible',$inter['id_inter'])) or die(print_r($requette8->errorInfo()));
		$requette8->closeCursor();
		$requette9=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette9->execute(array('jeudi','a-midi','disponible',$inter['id_inter'])) or die(print_r($requette9->errorInfo()));
		$requette9->closeCursor();
		$requette10=$bd->prepare('INSERT INTO contrainte(journee, moment, niveau, id_inter) VALUES(?,?,?,?)');
		$requette10->execute(array('vendredi','a-midi','disponible',$inter['id_inter'])) or die(print_r($requette10->errorInfo()));
		$requette10->closeCursor();
		header('Location: intervenant.php');
	}
	else{
		header('Location: intervenant.php');
	}
 ?>