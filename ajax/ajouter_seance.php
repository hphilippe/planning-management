<?php
	$inter=$_GET['inter'];
	$mat=$_GET['mat'];
	$heure=$_GET['heure'];
	$annee=$_GET['annee'];
	$sem=$_GET['sem'];
	$date=$_GET['date'];
	$day=$_GET['day'];
	$moment=$_GET['moment'];
	include("../connexion.php");
	//on recupere le jour concerné en fonction de la date envoyée
	$requette=$bd->prepare('SELECT id_jour FROM jour WHERE date_j=?');
	$requette->execute(array($date)) or die(print_r($requette->errorInfo()));
	//on met le nobre de lignes retournées par la requette dans la variable $n
	$nbr=$requette->rowCount();
	if ($nbr!=0) {//si $n supérieur est à 0 : le jour en quetion existe dans la base de données
		$jour=$requette->fetch();//on enregistre le resultat de la requette dans $jour
		$requette->closeCursor();
		
		//on insere la seance dans la table seance
		$requette1=$bd->prepare('INSERT INTO seance(journee,moment,duree,id_jour) VALUES(?, ?, ?, ?)');
		$requette1->execute(array($day,$moment,$heure,$jour['id_jour'])) or die(print_r($requette1->errorInfo()));
		$requette1->closeCursor();
		//on recupere l'identifiant de la seance precedement inserée
		$requette2=$bd->query('SELECT id_seance FROM seance
								ORDER BY id_seance DESC
								LIMIT 1') or die(print_r($bd->errorInfo()));
		$seance=$requette2->fetch();
		$requette2->closeCursor();
		//on crée la liason entre la seance l'intervenant qui la dirige
		$requette3=$bd->prepare('INSERT INTO diriger(id_seance,id_inter) VALUES(?, ?)');
		$requette3->execute(array($seance['id_seance'],$inter)) or die(print_r($requette3->errorInfo()));
		$requette3->closeCursor();
		//on crée la liason entre la seance et la matiere dispensée
		$requette4=$bd->prepare('INSERT INTO dispenser(id_seance,id_mat) VALUES(?, ?)');
		$requette4->execute(array($seance['id_seance'],$mat)) or die(print_r($requette4->errorInfo()));
		$requette4->closeCursor();
	}
	else{//si $n=0 (le resultat de la requette est vide)
		//on enregistre le jour dans la base de données
		$req=$bd->prepare('INSERT INTO jour(date_j,id_sem) VALUES(?,?)');
		$req->execute(array($date,$sem)) or die(print_r($req->errorInfo()));
		$req->closeCursor();
		//on recupere l'identifiant du precedement inseré
		$rep=$bd->query('SELECT id_jour FROM jour
								ORDER BY id_jour DESC
								LIMIT 1') or die(print_r($bd->errorInfo()));
		$jour=$rep->fetch();
		$rep->closeCursor();
		//on insere la seance dans la table seance
		$requette1=$bd->prepare('INSERT INTO seance(journee,moment,duree,id_jour) VALUES(?, ?, ?, ?)');
		$requette1->execute(array($day,$moment,$heure,$jour['id_jour'])) or die(print_r($requette1->errorInfo()));
		$requette1->closeCursor();
		//on recupere l'identifiant de la seance precedement inserée
		$requette2=$bd->query('SELECT id_seance FROM seance
								ORDER BY id_seance DESC
								LIMIT 1') or die(print_r($bd->errorInfo()));
		$seance=$requette2->fetch();
		$requette2->closeCursor();
		//on crée la liason entre la seance l'intervenant qui la dirige
		$requette3=$bd->prepare('INSERT INTO diriger(id_seance,id_inter) VALUES(?, ?)');
		$requette3->execute(array($seance['id_seance'],$inter)) or die(print_r($requette3->errorInfo()));
		$requette3->closeCursor();
		//on crée la liason entre la seance et la matiere dispensée
		$requette4=$bd->prepare('INSERT INTO dispenser(id_seance,id_mat) VALUES(?, ?)');
		$requette4->execute(array($seance['id_seance'],$mat)) or die(print_r($requette4->errorInfo()));
		$requette4->closeCursor();
	}
	$reponse=$bd->prepare('SELECT (nb_heure-SUM(duree)) as reste 
                          FROM annee INNER JOIN periode ON annee.annee=periode.annee
                                INNER JOIN semaine ON periode.id_per=semaine.id_per
                                INNER JOIN jour ON semaine.id_sem=jour.id_sem
                                INNER JOIN seance ON jour.id_jour=seance.id_jour                                                    
                                INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                          WHERE matiere.id_mat=? and annee.annee=?');
	$reponse->execute(array($mat,$annee)) or die(print_r($reponse->errorInfo()));
	$reste=$reponse->fetch();
	echo $seance['id_seance'].'|'.$reste['reste'];
?>