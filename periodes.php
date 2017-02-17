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
	if (isset($_GET['an'])) {
		$annee=$_GET['an']; 
		include("connexion.php");
		$requette=$bd->prepare('SELECT id_per as id, DAY(date_d) as jrd, MONTH(date_d) as md, YEAR(date_d) as annd,
								 DAY(date_f) as jrf, MONTH(date_f) as mf, YEAR(date_f) as annf
								 FROM periode WHERE annee=?
								 ORDER BY date_d');
		$requette->execute(array($annee)) or die(print_r($requette->errorInfo()));
		$ligne=$requette->rowCount();
		if ($ligne!=0) {
			?>
			<h1>Liste des periodes :</h1>
				<ul class="stylePer">
			<?php
			while ($periode=$requette->fetch()) {
				?>
				<li style="background-color: white; border: none;">
					<?php echo '<span style="padding: 4px;margin-right: 10px;border: solid 1px;background-color: aliceblue;"> Début : '.$periode['jrd'].'/'.$periode['md'].'/'.$periode['annd'].' </span> <span style="padding: 4px;margin-right: 10px;border: solid 1px;background-color: antiquewhite;"> Fin : '.$periode['jrf'].'/'.$periode['mf'].'/'.$periode['annf'] .'</span>'; ?>
					<a href="#" class="supprimer" data-num="<?php echo $periode['id']; ?>"><img src="images/sup.jpg" width="30" height="15"></a>
				</li>
				<?php
			}
		}
		else{
			?>
			<h1>Aucune periode n'a été saisie</h1>
			<?php
		}
		?>
	<div>
			<a href="#" id="ajouter"><button class="button_inter">Nouvelle Periode</button></a>
			<a href="planning.php?annee=<?php echo $annee;?>"><button class="button_inter">Aller au Planning</button></a>
	</div>
	<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_periode.php" id="form_ajout">
				<div id="fermer" class="fermer" ><a href="#">X</a></div>
				<h1>NOUVELLE PERIODE</h1>
				<ul>
					<li>
						<h1>Date Debut : </h1>
						<input type="hidden" name="an" value="<?php echo $annee; ?>">
						<select id="jr" name="jrd">
							<option>Jour</option>
							<?php
							for ($i=1; $i < 32 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
						<select id="mois" name="md">
							<option>Mois</option>
							<?php
							for ($i=1; $i < 13 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
						<select id="an" name="annd">
							<option>Année</option>
							<?php
							for ($i=2013; $i < 2021 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
					</li>
					<li>
						<h1>Date Fin : </h1>
						<select id="jr" name="jrf">
							<option>Jour</option>
							<?php
							for ($i=1; $i < 32 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
						<select id="mois" name="mf">
							<option>Mois</option>
							<?php
							for ($i=1; $i < 13 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
						<select id="an" name="annf">
							<option>Année</option>
							<?php
							for ($i=2013; $i < 2021 ; $i++) { 
							?>
							<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
					</li>
		
					<li>
						<input type="submit" id="ins" value="Ajouter">
					</li>
				</ul>
			</form>
	</div>
	<div id="over">
			<div id="sup">
				<h3>Voulez-Vous vraiment supprimer cette période?</h3>
				<div id="bt">
					<button id="oui" data-num="">OUI</button>
					<button id="non">NON</button>
				</div>
			</div>
		</div>
	<script type="text/javascript">
		(function(){
			var ajouter=document.getElementById('ajouter'),
				ajout=document.getElementById('ajout'),
				fermer=document.getElementById('fermer');
			function displayDiv(button,div){
				button.onclick=function(){
					div.style.display= 'block';
				};
			}
			displayDiv(ajouter,ajout);
			
			function disappearDiv(touche,div){
				touche.onclick=function(){
					div.style.display= 'none';
				};
			}
			disappearDiv(fermer,ajout);
		})();
		(function(){
			var supprimer=document.getElementsByClassName('supprimer'),
				sup=document.getElementById('over'),
				non=document.getElementById('non');
				oui=document.getElementById('oui');
			function afficher(button,div,el){
				button.onclick=function(){
					div.style.display= 'block';
					el.setAttribute('data-num',button.getAttribute('data-num'));
				};
			}
			for (var i = 0; i < supprimer.length; i++) {
				afficher(supprimer[i],sup,oui);
			};
			function cacher(touche,div){
				touche.onclick=function(){
					div.style.display= 'none';
				};
			}
			cacher(non,sup);
			function supprimer_unite(but){
				id=but.getAttribute('data-num'),
				xhr= new XMLHttpRequest();
				xhr.open('GET','ajax/sup_periode.php?id='+ id);
				xhr.onreadystatechange= function(){
					if (xhr.readyState==4 && xhr.status==200) {
						window.location.reload();
					}
				};

				xhr.send(null);
			}
			oui.onclick=function(){
				supprimer_unite(this);
			};
			

		})();
	</script>
	<?php
	}
	include("footer.php");
	?>

	 
	 