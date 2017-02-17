<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
 
    <body>
    
<?php include("header.php");
	?>
	<table border="1" class="CSSTableGenerator">
			<tr>
				<td>Discipline</td>
				<td>Abregé</td>
				<td>Nombre heure</td>
				<td>Intervenant</td>
				<td>Supprimer</td>
			</tr>
	<?php
 		include("connexion.php");
 			$annee=$_GET['an'];
			$requette=$bd->prepare("SELECT DISTINCT(matiere.id_mat), nom_mat, abreg_mat, nb_heure
									 FROM matiere INNER JOIN intervenir ON matiere.id_mat=intervenir.id_mat
									  WHERE annee=?");
			$requette->execute(array($annee)) or die(print_r($requette->errorInfo()));
			while ($matiere=$requette->fetch()) {
				?>
				<tr>
					<td><?php echo $matiere['nom_mat']; ?></td>
					<td><?php echo $matiere['abreg_mat']; ?></td>
					<td><?php echo $matiere['nb_heure']; ?></td>
					<td>
						<?php
							$requette1=$bd->prepare('SELECT intervenant.id_inter, nom_inter 
													FROM intervenant INNER JOIN intervenir ON intervenant.id_inter=intervenir.id_inter
													WHERE annee=? and id_mat=?');
							$requette1->execute(array($annee, $matiere['id_mat'])) or die(print_r($requette1->errorInfo()));
							while ($inter=$requette1->fetch()) {
								?>
								<div><?php echo $inter['nom_inter'];?>
									<a href="sup_intervention.php?inter=<?php echo $inter['id_inter']; ?>&mat=<?php echo $matiere['id_mat']; ?>&an=<?php echo $annee; ?>"><img src="images/sup.png" width="15" height="10"></a>
								</div>
								<?php
							}
						?>
					</td>
					<td><a href="sup_enseigner.php?mat=<?php echo $matiere['id_mat']; ?>&an=<?php echo $annee; ?>"><img src="images/sup.png" width="30" height="15"></a></td>
				</tr>
				<?php
			}
		?>
		</table>
		<div>
			<a href="#" id="ajouter"><button class="button_inter">Ajouter une matière pour cette année scolaire</button></a>
			<a href="planning.php?annee=<?php echo $annee;?>"><button class="button_inter">Aller au Planning</button></a>
		</div>
		<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_intervention.php" id="form_ajout">
				<div id="fermer_aj" class="fermer"><a href="#">X</a></div>
				<h1>AJOUTER UNE MATIERE</h1>
				<ul>
					<li>
						<div>Matière</div>
						<select name="mat">
						<?php
							$rep=$bd->query('SELECT id_mat, abreg_mat FROM matiere') or die(print_r($bd->errorInfo()));
									while ($mat=$rep->fetch()) {
										?>
										<option value="<?php echo $mat['id_mat'];?>"><?php echo $mat['abreg_mat'];?></option>
										<?php
									}
						?>
							</select>
					</li>
					
					<li>
						<div>Intervenant(s)</div>
						<select name="inter[]" multiple>
						<?php
							$rep1=$bd->query('SELECT id_inter, nom_inter FROM intervenant') or die(print_r($bd->errorInfo()));
									while ($intervenant=$rep1->fetch()) {
										?>
										<option value="<?php echo $intervenant['id_inter'];?>"><?php echo $intervenant['nom_inter'];?></option>
										<?php
									}
						?>
							</select>
					</li>
					<li>
						<input type="hidden" name="an" value="<?php echo $annee;?>">
						<input type="submit" value="Ajouter">
					</li>
				</ul>
			</form>
		</div>
		
		<script type="text/javascript">
			
		(function(){
			var ajouter=document.getElementById('ajouter'),
				ajout=document.getElementById('ajout'),
				fermer_aj=document.getElementById('fermer_aj');
			
			function displayDiv(button,div){
				button.onmouseup=function(){
					div.style.display= 'block';
				};
			}
			displayDiv(ajouter,ajout);
			function disappearDiv(touche,div){
				touche.onclick=function(){
					div.style.display= 'none';
				};
			}
			disappearDiv(fermer_aj,ajout);
		})();

		</script>
		<?php
include("footer.php"); ?>