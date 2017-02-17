<?php 
	if (isset($_POST['an']) and isset($_POST['jrd']) and isset($_POST['md']) and isset($_POST['annd']) 
		and isset($_POST['jrf']) and isset($_POST['mf']) and isset($_POST['annf'])){
		$annee=$_POST['an'];
		$jrd=$_POST['jrd'];
		$md=$_POST['md'];
		$annd=$_POST['annd'];
		$jrf=$_POST['jrf'];
		$mf=$_POST['mf'];
		$annf=$_POST['annf'];
		$dated=$annd.'-'.$md.'-'.$jrd;
		$datef=$annf.'-'.$mf.'-'.$jrf;
		include("connexion.php");
		//on insert la periode dans la base de données
		$requette1=$bd->prepare('INSERT INTO periode(date_d, date_f, annee) VALUES(?,?,?)');
		$requette1->execute(array($dated,$datef,$annee)) or die(print_r($requette1->errorInfo()));
		$requette1->closeCursor();
		//on recupere la dernière entrée de la table periode
		$requette2=$bd->query('SELECT * FROM periode
									ORDER BY id_per DESC
									LIMIT 1') or die(print_r($bd->errorInfo()));
		$periode=$requette2->fetch();
		$requette2->closeCursor();
		//on crée la prémière semaine de la periode
		$requette3=$bd->prepare('INSERT INTO semaine(date_d,id_per) VALUES(?,?)');
		$requette3->execute(array($periode['date_d'],$periode['id_per'])) or die(print_r($requette3->errorInfo()));
		$requette3->closeCursor();
		//on recupere la derniére entrée de la table semaine
		$requette4=$bd->query('SELECT ADDDATE(date_d, 5) as dd, date_d 
								FROM semaine
								ORDER BY id_sem DESC
								LIMIT 1') or die(print_r($bd->errorInfo()));
		$semaine=$requette4->fetch();
		$dateDebut=$semaine['date_d'];//date debut de la semaine courante
		$dateSem=$semaine['dd'];
		$requette4->closeCursor();

		$dateSem= new DateTime($dateSem);//date fin de la semaine courante
		$datePer= new DateTime($periode['date_f']);//date fin de la periode
		//tant que la date fin de la semaine courante est inferieure à la date fin de la periode, on ajoute une nouvelle semaine
		while ($dateSem < $datePer) {
			$requette=$bd->prepare('INSERT INTO semaine(date_d,id_per) VALUES(ADDDATE(?,7),?)');
			$requette->execute(array($dateDebut,$periode['id_per'])) or die(print_r($requette->errorInfo()));
			$requette->closeCursor();
			//on recupere la derniére entrée de la table semaine
			$rep=$bd->query('SELECT ADDDATE(date_d, 5) as dd, date_d 
									FROM semaine
									ORDER BY id_sem DESC
									LIMIT 1') or die(print_r($bd->errorInfo()));
			$sem=$rep->fetch();
			$dateDebut=$sem['date_d'];//date debut de la semaine courante
			$dateSem=$sem['dd'];
			$dateSem= new DateTime($dateSem);//date fin de la semaine courante
			$rep->closeCursor();
		}
		header('Location: periodes.php?an='.$annee);
	}
	else{
		header('Location: index.php');
	}
 ?>