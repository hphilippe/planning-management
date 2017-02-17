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
				<td>Numéro</td>
				<td>Unité d'Enseignement</td>
				<td>Modifier</td>
				<td>Supprimer</td>
			</tr>
	<?php
 		include("connexion.php");
		$requ1=$bd->query("SELECT * FROM unite_enseignement") or die(print_r($bd->errorInfo()));
		while ($unite=$requ1->fetch()) {
				?>
				<tr>
					<td><?php echo'UE'.$unite['id_ue']; ?></td>
					<td><?php echo $unite['nom_ue']; ?></td>
					<td><a href="#" class="modifier" id="<?php echo $unite['id_ue']; ?>"><img src="images/modif.png" width="30" height="15"></a></td>
					<td><a class="supprimer" data-num="<?php echo $unite['id_ue']; ?>" href="#"><img src="images/sup.png" width="30" height="15"></a></td>
				</tr>
				<?php
		}
		?>
		</table>
		<div>
			<a href="#" id="ajouter"><button class="button_inter">Ajouter une unité</button></a>
		</div>
		<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_unite.php" id="form_ajout">
				<div id="fermer_aj" class="fermer"><a href="#">X</a></div>
				<h1>AJOUTER UNE UNITE D'ENSEIGNEMENT</h1>
				<ul>
					<li>
							<label for="nm">Intitulé</label></br>
							<input type="text" id="nm" name="nom">
					</li>
			
					<li>
						<input type="submit" value="Ajouter">
					</li>
				</ul>
			</form>
		</div>
		<div id="modif" class="hidden">
			<form method="POST" action="modif_unite_enseignement.php" id="form_modif">
				<div id="fermer_mod" class="fermer"><a href="#">X</a></div>
				<h1>MODIFIER L'UNITE D'ENSEIGNEMENT</h1>
				<ul>
					<li>	
							<input type="hidden" name="id" id="id">
							<label for="nom">Intitulé</label></br>
							<input type="text" id="nom" name="nom">
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
				intitul=document.getElementById('nom'),
				id=document.getElementById('id');

			function recup_unite(champ1,champ2,but){
				var id=but.getAttribute('id'),
					xhr= new XMLHttpRequest();
				xhr.open('GET','ajax/recup_unite.php?id='+ id);
				xhr.onreadystatechange= function(){
					if (xhr.readyState==4 && xhr.status==200) {
						// alert(xhr.responseText);
						list(xhr.responseText,champ1,champ2);
					}
				};

				xhr.send(null);
			}

			function list(reponse, cont1,cont2){
 				if (reponse.length) {
 					reponse=reponse.split('|');
 						cont1.value=reponse[0];
 						cont2.value=reponse[1];
 				}
 			}
			for (var i = 0; i < button.length; i++) {
				button[i].onmousedown=function(){
					recup_unite(id,intitul,this);
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
				xhr.open('GET','ajax/sup_unite.php?id='+ id);
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