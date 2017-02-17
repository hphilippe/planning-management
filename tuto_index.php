<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>page</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
 
    <body>
    <?php
    include("header.php"); 
    ?>
    <hr>
    <div class="row_tuto">
        <div class="center_tuto">
            <h1>INSTALATION HTACESS et HTPASSWD</h1>
            <p style="margin-bottom: 10px;">htacess :</p>
            <p style="text-align: left;margin-bottom: 5px;">1. Envoyez tous le dossier du site web sur votre serveur avec votre logiciel FTP</p>
            <p style="text-align: left;margin-bottom: 5px;">2. Ouvrez votre navigateur et lancer le fichier PHP "chemin.php" . Il vous donne le chemin absolu, par exemple dans mon cas : /home/site/www/admin/chemin.php</p>
            <p style="text-align: left;margin-bottom: 5px;">3. Ouvrer et Copiez ce chemin dans votre fichier ".htaccess" à l'endroit où il y a AuthUserFile, et remplacez la fin du chemin absolue "chemin.php" par ".htpasswd", ce qui nous donne au final par exemple : AuthUserFile "/home/site/www/admin/.htpasswd"</p>
            <p style="text-align: left;margin-bottom: 5px;">4. Enregistrez le fichier en inscrivant le nom entre guillemets, comme ceci : ".htaccess". Cela permet de forcer l'éditeur à enregistrer un fichier qui commence par un point. </p>
            <p style="margin-top: 10px; margin-bottom: 10px;">htpasswd :</p>
            <p style="text-align: left;margin-bottom: 5px;">1. Le fichier .htpasswd va contenir la liste des login autorisées à accéder aux pages du dossier avec leur mot de pass. On y inscrit une personne par ligne, sous cette forme : login:mot_de_passe</p>
            <p style="text-align: left;margin-bottom: 5px;">Au final, votre fichier .htpasswd devrait ressembler à ceci :</p>
            <p style="text-align: left;margin-bottom: 5px;">mateo21:SuperMotDePasse42</p>
            <p style="text-align: left;margin-bottom: 5px;">ptipilou:IciMotDePasse</p>
        </div>
    </div>
    <hr>
    <div class="row_tuto">
        <div class="center_tuto">
            <h1>INSTALATION BASE DE DONNÉE</h1>
            <p>1. Créer la base de donné "planning"</p>
            <img src="images/bdd_tuto1.2.png">
            <p>2. Une fois dans l'administration de la base de donnée "planning", aller dans "importer"</p>
            <img src="images/bdd_tuto1.png">
            <p>3. Cliquez sur choisissez un fichier et prenez "planning.sql" puis fait Exécuter</p>
            <img src="images/bdd_tuto2.png">
            <img src="images/bdd_tuto3.png">
        </div>
    </div>
    <hr>
    <div class="row_tuto">
        <div class="center_tuto">
            <h1>CONNEXION BASE DE DONNÉE</h1>
            <p>1. Ouvrir le fichier "connexion.php"</p>
            <p>2. Modifier les fichiers en rentrant entre les guillemets le login et mot de passe d'accès à la base de données</p>
            <img src="images/bdd_tuto4.png">
        </div>
    </div>
    <hr>
    <div class="row_tuto" style="height:80px;">
    	<div class="center_tuto">
    		<h1>MENU</h1>
    	</div>
	    <div class="left_tuto">
	    	<img src="images/menu.png">
	    </div>
	    <div class="right_tuto">
	    	<ul>
	    		<li>Planning par année : Avec la liste des boutons permettant d'accèder au planning d'une année scolaire</li>
	    		<li>Liste Intervenants : <span style="color:red;">Liste de tous les intervenants</span> existant dans la base de données. <span style="color:red;">l'ajout d'un intervenant</span> se fait dans cette page.</li>
	    		<li>Liste Matières : <span style="color:red;">Liste de toutes les matières</span> existant dans la base de données. <span style="color:red;">l'ajout d'une matières</span> se fait dans cette page.</li>
	    	</ul>
	    </div>
    </div>
    <hr>
    <div class="row_tuto">
	    <div class="center_tuto">
    		<h1> PAGE PLANNING PAR ANNÉE</h1>
    		<img src="images/index2.png">
    	</div>
    </div>
	<hr>
    <div class="row_tuto">
	    <div class="center_tuto">
    		<h1>PAGE PLANNING</h1>
    		<!--<img src="images/planning.png">-->
            <p style="color:red;">Gestion des périodes pour une année scolaire particulière :</p>
    		<img src="images/bp_periode.png">
    		<img src="images/exemple_periode.png">
            <p style="color:red;">Gestion des matières et intervenants qui apparaitront pour une année scolaire particulière : </p>
    		<img src="images/bp_matiere.png">
    		<img src="images/exemple_intervenant.png">
    	</div>
    </div>
    <hr>
    <div class="row_tuto">
        <div class="center_tuto">
            <h1>PAGE GESTION DES CONTRAINTES DES INTERVENANTS</h1>
            <p>1. Aller dans le menu de la liste des intervenants</p>
            <img src="images/tut1.png">
            <p>2. Cliquez sur "contrainte" de l'intervenant dont on souhaite ces contraintes</p>
            <img src="images/tut2.png">
            <p>3. Modifier les contraintes de l'intervenant avec une semaine type de disponibilité et des date particulière de non disponibilité</p>
            <img src="images/tut3.png">
        </div>
    </div>
    <div class="row_tuto">
        <div class="center_tuto">
            <h1 style="font-weight: bold; font-size: 20px;">PDF TUTORIEL</h1>
            <a href="images/tutoriel planning.pdf"><img src="images/pdf.png"></a>
            <a href="images/Tutoriel Page application.pdf"><img src="images/pdf2.png"></a>
        </div>
    </div>

	<?php
	include("footer.php");
	?>