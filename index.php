<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>page</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
 
    <body>
    
<?php
	 include("header.php"); 
	 ?>
	 <div style="text-align:center;" class="index_left">
	 	<ul>
		 	<li>
		 		<a style="text-decoration:none;" href="intervenant.php">
		 			<img style="width: 150px;" src="images/liste.jpg">
			 		<h1>Liste des intervenant</h1>
			 	</a>
		 	</li>
		 	<li>
		 		<a style="text-decoration:none;" href="matiere.php">
		 			<img style="width: 150px;" src="images/liste2.jpg">
			 		<h1>Liste des matieres</h1>
			 	</a>
		 	</li>
		 	<li>
		 		<a style="text-decoration:none;" href="tuto_index.php">
		 			<img style="width: 150px;" src="images/tuto.png">
			 		<h1>Tutoriel</h1>
			 	</a>
		 	</li>
	 	</ul>
	 </div>
	 <hr>
	 <?php
	 include("connexion.php");
	 $requette=$bd->query('SELECT * FROM annee') or die(print_r($bd->errorInfo()));
	 ?>
	 <ul class="bp_index" >
	 <p>Liste des Annee Scolaire :</p><br/>
	 <?php
	 while ($annee=$requette->fetch()) {
	 	?>
	 	<li ><a href="planning.php?annee=<?php echo $annee['annee']; ?>"><button><?php echo $annee['annee']; ?></button></a></li></br>
	 	<?php
	 }
	 ?>
	 </ul>
	 <div style="text-align: center; margin-bottom: 20px;">
			<a href="#" id="ajouter"><button>Nouvelle Annee</button></a>
	</div>
	<div id="ajout" class="hidden">
			<form method="POST" action="ajouter_annee.php" id="form_ajout">
				<div id="fermer" class="fermer" ><a href="#">X</a></div>
				<h1>NOUVELLE ANNEE</h1>
				<ul>
					<li>
							<label for="an">Annee Academique</label></br>
							<input type="text" id="an" name="an" placeholder="2010-2011">
					</li>
		
					<li>
						<input type="submit" id="ins" value="Ajouter">
					</li>
				</ul>
			</form>
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
	</script>
	<hr>
	<?php
	include("footer.php");
	?>