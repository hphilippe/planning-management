<?php
	if(isset($_GET['annee'])){
		$annee=$_GET['annee'];
		include("connexion.php");
		$rep=$bd->prepare('SELECT DISTINCT(id_inter) FROM intervenir WHERE annee=?');
		$rep->execute(array($annee)) or die(print_r($rep->errorInfo()));
		echo '<ul>';
		while ($liste=$rep->fetch()) {
			$requette=$bd->prepare('SELECT * FROM intervenant WHERE id_inter=?');
			$requette->execute(array($liste['id_inter'])) or die(print_r($requette->errorInfo()));
			$intervenant=$requette->fetch();
			echo '<li>';
			echo 'intervenant : '.$intervenant['prenom'].' '.$intervenant['nom_inter'].' ('.$intervenant['email'].')</br>';
			echo 'Commentaire : '.$intervenant['commentaire'].'</br>';
			echo 'Liste des seances de l\'année '.$annee.' :';
			$requette2=$bd->prepare('SELECT journee, moment, DAYNAME(date_j) as jour, DAY(date_j) as jr, MONTHNAME(date_j) as mois, 
									YEAR(date_j) as annee,abreg_mat, nbh_seance
									FROM annee INNER JOIN periode ON annee.annee=periode.annee
				                                INNER JOIN semaine ON periode.id_per=semaine.id_per
				                                INNER JOIN jour ON semaine.id_sem=jour.id_sem
				                                INNER JOIN seance ON jour.id_jour=seance.id_jour                                                    
				                                INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
				                                INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat 
									 			INNER JOIN diriger ON seance.id_seance=diriger.id_seance
									WHERE id_inter=? and annee.annee=?');
			$requette2->execute(array($liste['id_inter'],$annee)) or die(print_r($requette2->errorInfo()));
			echo '<ul>';
			while ($seance=$requette2->fetch()) {
				echo '<li>'.$seance['journee'].' '.$seance['jr'].' '.$seance['mois'].' '.$seance['annee'].' '.$seance['moment'].' : '.$seance['abreg_mat'].'('.$seance['nbh_seance'].')</li>';
			}
			echo '</ul>';
			echo '</li>';
		}
		echo '</ul>';	
	}
?>