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
				<td>Unité d'Enseignement</td>
				<td>Discipline</td>
				<td>Abregé</td>
				<td>Nombre heure</td>
				<td>Heure/Seance</td>
				<td>Modifier</td>
				<td>Supprimer</td>
			</tr>
	<?php
 		include("connexion.php");
		$requ1=$bd->query("SELECT id_ue FROM unite_enseignement") or die(print_r($bd->errorInfo()));
		while ($unite=$requ1->fetch()) {
			$requette=$bd->prepare("SELECT * FROM matiere WHERE id_ue=?");
			$requette->execute(array($unite['id_ue'])) or die(print_r($requette->errorInfo()));
			$i=1;
			while ($matiere=$requette->fetch()) {
				?>
				<tr>
					<td><?php echo $unite['id_ue'].'.'.$i; ?></td>
					<td><?php echo $matiere['nom_mat']; ?></td>
					<td><?php echo $matiere['abreg_mat']; ?></td>
					<td><?php echo $matiere['nb_heure']; ?></td>
					<td><?php echo $matiere['nbh_seance']; ?></td>
					<td><a href="#" class="modifier" id="<?php echo $matiere['id_mat']; ?>"><img src="images/modif.png" width="30" height="15"></a></td>
					<td><a href="#" class="supprimer" data-num="<?php echo $matiere['id_mat']; ?>"><img src="images/sup.png" width="30" height="15"></a></td>
				</tr>
				<?php
				$i++;
			}
		}
		?>
		</table>
		<div>
			<a href="#" id="ajouter"><button class="button_inter">Ajouter une matière</button></a>
		</div>
		<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_matiere.php" id="form_ajout">
				<div id="fermer_aj" class="fermer"><a href="#">X</a></div>
				<h1>AJOUTER UNE MATIERE</h1>
				<ul>
					<li>
							<label for="nm">Discipline</label></br>
							<input type="text" id="nm" name="nom">
					</li>
					<li>
							<label for="abrg">Abregé</label></br>
							<input type="text" id="abrg" name="abreg">
					</li>
					<li>
							<label for="nbrh">Nombre d'heure</label></br>
							<input type="text" id="nbrh" name="nbh">
					</li>
					<li>
							<label for="nbhs">Heure/Seance</label></br>
							<input type="text" id="nbhs" name="nbhs">
					</li>
					<li>
							<div>Unité enseignement</div>
							<select class="ue" name="ue">
							<?php
							$rep=$bd->query('SELECT id_ue FROM unite_enseignement') or die(print_r($bd->errorInfo()));
									while ($mat=$rep->fetch()) {
										?>
										<option value="<?php echo $mat['id_ue'];?>"><?php echo'UE'.$mat['id_ue'];?></option>
										<?php
									}
							?>
							</select>
					</li>
					<li>
						<input type="submit" value="Ajouter">
					</li>
				</ul>
			</form>
		</div>
		<div id="modif" class="hidden">
			<form method="POST" action="modif_matiere.php" id="form_modif">
				<div id="fermer_mod" class="fermer"><a href="#">X</a></div>
				<h1>MODIFIER LA MATIERE</h1>
				<ul>
					<li>	
							<input type="hidden" name="id" id="id">
							<label for="nom">Discipline</label></br>
							<input type="text" id="nom" name="nom">
					</li>
					<li>
							<label for="abreg">Abregé</label></br>
							<input type="text" id="abreg" name="abreg">
					</li>
					<li>
							<label for="nbh">Nombre d'heure</label></br>
							<input type="text" id="nbh" name="nbh">
					</li>
					<li>
							<label for="hs">Heure/Seance</label></br>
							<input type="text" id="hs" name="nbhs">
					</li>
					<li>
							<div>Unité enseignement</div>
							<select class="ue" name="ue">
							<?php
							$rep=$bd->query('SELECT id_ue FROM unite_enseignement') or die(print_r($bd->errorInfo()));
									while ($mat=$rep->fetch()) {
										?>
										<option value="<?php echo $mat['id_ue'];?>"><?php echo'UE'.$mat['id_ue'];?></option>
										<?php
									}
							?>
							</select>
					</li>
					<li>
						<input type="submit" value="Modifier">
					</li>
				</ul>
			</form>
		</div>
		<div id="over">
			<div id="sup">
				<h3>Voulez-Vous vraiment supprimer cette ligne?</h3>
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
				fermer_aj=document.getElementById('fermer_aj'),
				fermer_mod=document.getElementById('fermer_mod');
				modifier=document.getElementsByClassName('modifier'),
				modif=document.getElementById('modif');
			function displayDiv(button,div){
				button.onmouseup=function(){
					div.style.display= 'block';
				};
			}
			displayDiv(ajouter,ajout);
			for (var i = 0; i < modifier.length; i++) {
				displayDiv(modifier[i],modif);
			};
			function disappearDiv(touche,div){
				touche.onclick=function(){
					div.style.display= 'none';
				};
			}
			disappearDiv(fermer_aj,ajout);
			disappearDiv(fermer_mod,modif);
		})();

		(function(){

			var button=document.getElementsByClassName('modifier'),
				disc=document.getElementById('nom'),
				abreg=document.getElementById('abreg'),
				nbh=document.getElementById('nbh'),
				hseance=document.getElementById('hs'),
				id=document.getElementById('id');

			function recup_matiere(champ1,champ2,champ3,champ4,champ5,but){
				var id=but.getAttribute('id'),
					xhr= new XMLHttpRequest();
				xhr.open('GET','ajax/recup_matiere.php?id='+ id);
				xhr.onreadystatechange= function(){
					if (xhr.readyState==4 && xhr.status==200) {
						// alert(xhr.responseText);
						list(xhr.responseText,champ1,champ2,champ3,champ4,champ5);
					}
				};

				xhr.send(null);
			}

			function list(reponse, cont1,cont2,cont3,cont4,cont5){
 				if (reponse.length) {
 					reponse=reponse.split('|');
 						cont1.value=reponse[0];
 						cont2.value=reponse[1];
 						cont3.value=reponse[2];
 						cont4.value=reponse[3];
 						cont5.value=reponse[4];
 				}
 			}
			for (var i = 0; i < button.length; i++) {
				button[i].onmousedown=function(){
					recup_matiere(id,disc,abreg,nbh,hseance,this);
				}
			};
				
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
				xhr.open('GET','ajax/sup_matiere.php?id='+ id);
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
include("footer.php"); ?>