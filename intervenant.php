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
		$requette=$bd->query("SELECT * FROM intervenant") or die(print_r($bd->errorInfo()));
		?>
		<table border="1" class="CSSTableGenerator">
		<tr>
			<td>Nom</td>
			<td>Prénom</td>
			<td>Adresse mail</td>
			<td>Commentaire</td>
			<td>Modifier</td>
			<td>Supprimer</td>
			<td>Disponibilité</td>
		</tr>
		<?php
		while ($intervenant=$requette->fetch()) {
			?>
			<tr>
				<td><?php echo $intervenant['nom_inter']; ?></td>
				<td><?php echo $intervenant['prenom']; ?></td>
				<td><?php echo $intervenant['email']; ?></td>
				<td><?php echo $intervenant['commentaire']; ?></td>
				<td><a href="#" class="modifier" id="<?php echo $intervenant['id_inter']; ?>"><img src="images/modif.png" width="30" height="15"></a></td>
				<td><a href="#" class="supprimer" data-num="<?php echo $intervenant['id_inter']; ?>"><img src="images/sup.png" width="30" height="15"></a></td>
				<td><a href="contrainte.php?id=<?php echo $intervenant['id_inter']; ?>">Contrainte</a></td>
			</tr>
			<?php
		}
		?>
		</table>
		<div>
			<a href="#" id="ajouter"><button class="button_inter">Ajouter un intervenant</button></a>
		</div>
		<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_intervenant.php" id="form_ajout">
				<div id="fermer_aj" class="fermer" ><a href="#">X</a></div>
				<h1>AJOUTER UN INTERVENANT</h1>
				<ul>
					<li>
							<label for="nom">Nom</label></br>
							<input type="text" id="nom" name="nom">
					</li>
					<li>
							<label for="pre">Prénom</label></br>
							<input type="text" id="pre" name="pre">
					</li>
					<li>
							<label for="mail">Adresse électronique</label></br>
							<input type="text" id="mail" name="mail">
					</li>
					<li>
							<label for="com">Commentaire</label></br>
							<textarea id="com" name="com" rows="4" cols="40"></textarea>
					</li>
					<li>
						<input type="submit" id="ins" value="Ajouter">
					</li>
				</ul>
			</form>
		</div>
		<div id="modif" class="hidden">
			<form method="POST" action="modif_intervenant.php" id="form_ajout">
				<div id="fermer_mod" class="fermer" ><a href="#">X</a></div>
				<h1>MODIFIER LES INFORMTIONS SUR L'INTERVENANT</h1>
				<ul id="form_modif">
					<li>
							<input type="hidden" name="id" id="id">
							<label for="nm">Nom</label></br>
							<input type="text" id="nm" name="nom">
					</li>
					<li>
							<label for="pr">Prénom</label></br>
							<input type="text" id="pr" name="pre">
					</li>
					<li>
							<label for="email">Adresse électronique</label></br>
							<input type="text" id="email" name="mail">
					</li>
					<li>
							<label for="comm">Commentaire</label></br>
							<textarea id="comm" name="com" rows="4" cols="40"></textarea>
					</li>
					<li>
						<input type="submit" id="ins" value="Modifier">
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
				fermer_mod=document.getElementById('fermer_mod'),
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
				id=document.getElementById('id'),
				nom=document.getElementById('nm'),
				email=document.getElementById('email'),
				pre=document.getElementById('pr'),
				com=document.getElementById('comm');

			function recup_intervenant(champ1,champ2,champ3,champ4,champ5,but){
				var id=but.getAttribute('id'),
					xhr= new XMLHttpRequest();
				xhr.open('GET','ajax/recup_intervenant.php?id='+ id);
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
					recup_intervenant(id,nom,pre,email,com,this);
					// displayDiv(this,modif);
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
				xhr.open('GET','ajax/sup_intervenant.php?id='+ id);
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