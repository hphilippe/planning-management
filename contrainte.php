<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
 
    <body>
    
<?php 
	include("header.php"); 
	include("connexion.php");
	$id=$_GET['id'];
	$rep=$bd->prepare('SELECT * FROM contrainte WHERE id_inter=?');
	$rep->execute(array($id)) or die(print_r($rep->errorInfo()));
	$nbr=$rep->rowCount();
	if($nbr!=0){
		$rep2=$bd->prepare('SELECT nom_inter, prenom FROM intervenant WHERE id_inter=?');
		$rep2->execute(array($id)) or die(print_r($rep2->errorInfo()));
		$inter=$rep2->fetch();
		?>
		<h1 style="font-size: 24px; margin-left: 10px;"><?php echo $inter['nom_inter'].' '.$inter['prenom']; ?></h1>
		<?php
		$matin=array();
		$amidi=array();
		while ($contrainte=$rep->fetch()) {
			if ($contrainte['moment']=='matin') {
				array_push($matin, $contrainte['niveau']);
			}
			else{
				array_push($amidi, $contrainte['niveau']);
			}
		}	
		$nbr1=count($matin);
		$nbr2=count($amidi);
			?>
		<form method="POST" action="modif_contrainte.php">
		<table border="1" class="CSSTableGenerator">
			<tr>
				<td></td>
				<td>Lundi</td>
				<td>Mardi</td>
				<td>Mercredi</td>
				<td>Jeudi</td>
				<td>Vendredi</td>
			</tr>
			<tr>
				<td>Matin</td>
				<?php
				for ($i=0; $i < $nbr1 ; $i++) {
				?> 
					<td>
						<input type="hidden" name="num" value="<?php echo $id; ?>">
						<?php
							if ($matin[$i]=='impossible') {
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="m<?php echo $i+1; ?>" value="convenable">
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="m<?php echo $i+1; ?>" value="non-convenable">
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="m<?php echo $i+1; ?>" value="impossible" checked>
								<?php
							}
							elseif ($matin[$i]=='non-convenable') {
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="m<?php echo $i+1; ?>" value="convenable">
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="m<?php echo $i+1; ?>" value="non-convenable"  checked>
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="m<?php echo $i+1; ?>" value="impossible">
								<?php
							}
							else{
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="m<?php echo $i+1; ?>" value="convenable" checked>
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="m<?php echo $i+1; ?>" value="non-convenable">
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="m<?php echo $i+1; ?>" value="impossible">
								<?php
							}
						?>
					</td>
				<?php
				}
				?>
			</tr>
			<tr>
				<td>Après-midi</td>
				<?php
				for ($j=0; $j < $nbr2 ; $j++) {
				?> 
					<td>
						<?php
							if ($amidi[$j]=='impossible') {
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="am<?php echo $j+1; ?>" value="convenable">
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="am<?php echo $j+1; ?>" value="non-convenable">
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="am<?php echo $j+1; ?>" value="impossible" checked>
								<?php
							}
							elseif ($amidi[$j]=='non-convenable') {
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="am<?php echo $j+1; ?>" value="convenable">
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="am<?php echo $j+1; ?>" value="non-convenable" checked>
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="am<?php echo $j+1; ?>" value="impossible">
								<?php
							}
							else{
								?>
								<label for="id2">Disp</label>
								<input type="radio" id="id2" name="am<?php echo $j+1; ?>" value="convenable" checked>
								<label for="id3">Non</label>
								<input type="radio" id="id3" name="am<?php echo $j+1; ?>" value="non-convenable">
								<label for="id1">Imp</label>
								<input type="radio" id="id1" name="am<?php echo $j+1; ?>" value="impossible">
								<?php
							}
						?>
					</td>
				<?php
				}
				?>
			</tr>
		</table>
		<input style="margin-left: 10px;margin-top: 10px;" type="submit" value="Sauvegarder">
		<hr>
		</form>
		<form method="POST" action="ajout_contrainte_part.php">
			<h1 style="font-size: 20px;margin-left: 10px;margin-top: 20px;">Ajouter une contrainte particulière</h1>
			<input type="hidden" name="num" value="<?php echo $id; ?>">
			<select style="margin-left: 10px;" id="jr" name="jr">
				<option>Jour</option>
				<?php
				for ($i=1; $i < 32 ; $i++) { 
				?>
				<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
				<?php
				}
				?>
			</select>
			<select id="mois" name="mois">
				<option>Moi</option>
				<?php
				for ($i=1; $i < 13 ; $i++) { 
				?>
				<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
				<?php
				}
				?>
			</select>
			<select id="an" name="an">
				<option>Année</option>
				<?php
				for ($i=2016; $i < 2021 ; $i++) { 
				?>
				<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
				<?php
				}
				?>
			</select>
			<select id="mom" name="mom">
				<option value="matin">Matin</option>
				<option value="a-midi">Aprés-midi</option>
			</select>
			</br>
			<input style="margin-left: 10px;" type="submit" value="Ajouter">
		</form>
		<hr>
		<?php
		$requette=$bd->prepare('SELECT id_cont_par as id, moment, DAYNAME(date_cont) as jour, DAY(date_cont) as jr, MONTHNAME(date_cont) as mois, YEAR(date_cont) as annee
								 FROM contrainte_particuliere WHERE id_inter=?
								 ORDER BY date_cont');
		$requette->execute(array($id)) or die(print_r($requette->errorInfo()));
		$ligne=$requette->rowCount();
		if ($ligne!=0) {
			?>
			<h1>Liste des contraintes particulières :</h1>
				<ul class="stylePer">
			<?php
			while ($donnees=$requette->fetch()) {
				if($donnees["moment"]=="a-midi")
				{
					$moment="Après-midi";
				}
				else
				{
					$moment="Matin";
				}
				?>
					<li>
						<?php echo $moment.' '.$donnees['jour'].' '.$donnees['jr'].' '.$donnees['mois'].' '.$donnees['annee']; ?>
						<a href="sup_cont_part.php?num=<?php echo $donnees['id']; ?>&id=<?php echo $id; ?>"><img src="images/sup.jpg" width="30" height="15"></a>
					</li>
				<?php
			}
		}
		else{
			?>
			<h1>Aucune contrainte paticulière n'a été saisie</h1>
			<?php
		}
	}
	else{
		header('Location: ajout_contrainte.php?id='.$id);
	}
	include("footer.php");?>