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
  include("connexion.php");
?>

</div>
<!--<p>planning de la période 1 :</p>
<p>semaine 1 :</p>-->

<div class="left">
  <?php
     $co1 = 250;
      $co2 = 0;
      $co3 = 0;
      $co4[0]='990000';
      $co4[1]='994d00';
      $co4[2]='999900';
      $co4[3]='009900';
      $co4[4]='009999';
      $co4[5]='e6eeff';
      $co4[6]='927CA7';
      $co4[7]='990073';
      $co4[8]='15bff0';
      $co4[9]='D48E25';
      $co4[10]='ccddff';
      $co4[11]='990026';
      $co4[12]='873F9E';
      $co4[13]='6F86B5';
      $co4[14]='007399';
      $co4[15]='009926';
      $co4[16]='4d9900';
      $co4[17]='997300';
      $co4[18]='455473';
      $co4[19]='494b50';
      $co4[20]='ccddff';
      $co4[21]='4d88ff';
      $co4[22]='0055ff';
      $co4[23]='63bf66';
      $co4[24]='bcbf66';
      $co4[25]='fabf66';
      $co4[26]='fabfee';
      $co4[27]='b5bfee';
      $co4[28]='5abfee';
      $co4[29]='15bfee';
      $co4[30]='15bfff';
      $co4[31]='66FFFF';
      $co4[32]='6633CC';
      $co4[33]='669966';
      $co4[34]='FF9966';
      $co4[35]='CC9966';
      $co4[36]='CCCC00';
      $co4[37]='FF0066';
      $co4[38]='CC3399';
      $co4[39]='0099CC';
      $co4[40]='006666';
      $ic = 1;
    $annee=$_GET['annee'];
    $requette=$bd->prepare('SELECT id_per as id, DAY(date_d) as jrd, MONTH(date_d) as md, YEAR(date_d) as annd,
                             DAY(date_f) as jrf, MONTH(date_f) as mf, YEAR(date_f) as annf
                             FROM periode 
                             WHERE annee=?
                             ORDER BY date_d');
    $requette->execute(array($annee)) or die(print_r($requette->errorInfo()));
    ?>
    <table border="1" style="float: right; margin: 0 2px;">
      <tr>
        <td>Lundi</td> 
        <td class="ShowNot"></td>
        <td>Mardi</td>
        <td class="ShowNot"></td>
        <td>Mercredi</td>
        <td class="ShowNot"></td>
        <td>Jeudi</td>
        <td class="ShowNot"></td>
        <td>Vendredi</td>
      </tr>
    </table>
    <ul>
      <?php
        while ($periode=$requette->fetch()) {
          ?>
          <li>
            <div class="periode"><?php echo 'Du '.$periode['jrd'].'/'.$periode['md'].'/'.$periode['annd'].' au '.$periode['jrf'].'/'.$periode['mf'].'/'.$periode['annf']; ?></div>
            <div class="planning">
              <?php
                $requette1=$bd->prepare('SELECT * FROM semaine WHERE id_per=?');
                $requette1->execute(array($periode['id'])) or die(print_r($requette1->errorInfo()));
                while ($semaine=$requette1->fetch()) {
                    $date1=$semaine['date_d'];
                    $date2=$date1;
                  ?>
                    <table>
                      <tr class="matin"><?php
                            //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date1,'matin')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            //echo $nbr;
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" class="NoClass" draggable="true"  style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" data-id_seance="<?php echo $seance['cour']; ?>" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" data-id_seance="<?php echo $seance['cour']; ?>" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                             }
                          ?></td><td class="ShowNot"></td><?php
                          //on incremente d'une journée
                         $date1=date("Y-m-d", strtotime($date1."+ 1 day"));
                         //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date1,'matin')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }
                            ?>

                        </td><td class="ShowNot"></td><?php 
                        //on incremente d'une journée
                        $date1=date("Y-m-d", strtotime($date1."+ 1 day"));
                        //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date1,'matin')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }
                            ?>
                          
                        </td><td class="ShowNot"></td><?php
                        //on incremente d'une journée
                         $date1=date("Y-m-d", strtotime($date1."+ 1 day"));
                         //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date1,'matin')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }
                
                           ?>                          
                        </td><td class="ShowNot"></td><?php
                        //on incremente d'une journée
                         $date1=date("Y-m-d", strtotime($date1."+ 1 day"));
                         //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date1,'matin')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date1; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }
                            ?>                          
                        </td><td class="ShowNot"></td></tr>
                      <tr class="a-midi"><?php
                           //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date2,'a-midi')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Lundi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }

                          ?>
                        </td><td class="ShowNot"></td><?php 
                        //on incremente la date d'une journée
                         $date2=date("Y-m-d", strtotime($date2."+ 1 day"));
                        //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date2,'a-midi')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mardi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }

                          ?>
                        </td><td class="ShowNot"></td><?php
                         //on incremente la date d'une journée
                        $date2=date("Y-m-d", strtotime($date2."+ 1 day"));
                        //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date2,'a-midi')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Mercredi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }

                          ?>                          
                        </td><td class="ShowNot"></td><?php
                        //on incremente la date d'une journée
                        $date2=date("Y-m-d", strtotime($date2."+ 1 day"));
                        //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date2,'a-midi')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Jeudi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }

                          ?>
                        </td><td class="ShowNot"></td><?php
                        //on incremente la date d'une journée
                        $date2=date("Y-m-d", strtotime($date2."+ 1 day"));
                        //on recupere de la base de données l'identifiant de la seance
                            //l'identifiant et l'abregé de la matiere en question
                            //et celui de l'intervenant
                            $a=$bd->prepare('SELECT seance.id_seance as cour, matiere.id_mat as mat, intervenant.id_inter as inter, abreg_mat, intervenant.nom_inter as inter_name
                                              FROM jour INNER JOIN seance ON jour.id_jour=seance.id_jour 
                                                          INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                          INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                                          INNER JOIN diriger ON seance.id_seance=diriger.id_seance
                                                          INNER JOIN intervenant ON diriger.id_inter=intervenant.id_inter
                                              WHERE date_j=? and moment=?');
                            $a->execute(array($date2,'a-midi')) or die(print_r($a->errorInfo()));
                            $nbr=$a->rowCount();//on compte le nombre de resultat de la requuette dans $nbr
                            if ($nbr==0) {//si $nbr est egal à 0(la celulle ne contient aucune seance) : on affiche la celulle du planning par defaut
                              ?>
                              <td id="dropper" class="none" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                              <?php
                            }
                            elseif ($nbr==1) {//si $nbr est egal à 1(la celulle contient une seule seance) : on lui donne comme class="dragN1"
                              $seance=$a->fetch();
                              ?>
                              <td id="dropper" class="dragN1" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                              <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                              <?php
                            }
                            elseif($nbr==2){//si $nbr est egal à 2(la celulle contient deux seances) : on lui donne comme class="dragN2"
                              ?>
                               <td id="dropper2" class="dragN2" data-sem="<?php echo $semaine['id_sem'];?>" data-date="<?php echo $date2; ?>" data-cont="convenable" data-day="Vendredi" onclick="panel(this)">
                               <?php
                              while ($seance=$a->fetch()) {
                                ?>
                                <div id="draggableThrow" data-mat="<?php echo $seance['mat']; ?>" data-dir="<?php echo $seance['inter']; ?>" data-interName="<?php echo $seance['inter_name'];?>" data-id_seance="<?php echo $seance['cour']; ?>" class="NoClass" draggable="true" style="background-color:#<?php echo $co4[$seance['inter']]; ?>;width:100%;" ><?php echo $seance['abreg_mat']; ?></div>
                                <?php
                              }
                            }

                          ?>
                        </td><td class="ShowNot"></td></tr>
                    </table>
                  <?php
                }
              ?>
            </div>
          </li>
          <?php
        }
      ?>
    </ul>
<button class="button_periode"><a style="text-decoration: none; color:black;" href="periodes.php?an=<?php echo $annee; ?>">Gestion Periode</a></button>
</div>

<div class="right">
  
 <!-- <div class="bouton_intervenant"><span class="bouton" id="bouton_texte" onclick="afficher_cacher('texte');">Afficher le texte</span></div> -->
 <h1 style="font-size: 18px; padding-left: 10px; background-color: #EEEEEE; font-weight: bold;">Liste des intervenants et matière</h1>
  <div id="texte" class="texte">
    <div>Select all recapitulatif :  <a href="mail_tous.php?annee=<?php echo $annee;?>"><img class="mail_logo" src="images/mail.png"></a></div>
    
     <div style="display:inline;">Corbeille :</div> <div  id="dropper" class="dropperOut" style="width:200px; height:20px; border:1px solid #111; display: inline-block; margin: 5px 0px 0px 0px;"></div>
  <ul class="col1">
   <?php
     
      $rep=$bd->prepare('SELECT distinct(intervenant.id_inter), nom_inter 
                        FROM intervenant INNER JOIN intervenir ON intervenant.id_inter=intervenir.id_inter
                        WHERE annee=?');
      $rep->execute(array($annee)) or die(print_r($rep->errorInfo()));
      while ($inter=$rep->fetch()) {
        ?>
          <li>
            <!--<div><?php //echo $inter['nom_inter']; ?></div>-->
            <div class="DragEnsemble"><?php echo $inter['nom_inter']; ?> : 
              <input type="radio" style="float: right;" name="radio" class="intervenant" data-inter="<?php echo $inter['id_inter']; ?>" <?php echo " onclick=\"radioToCheckbox(" . '\'' . $inter['nom_inter'] . '\'' . ")\"";?> > 
              <input type="checkbox" checked="false" style="display:none;" name="foo" <?php echo "id=\"" . $inter['nom_inter'] . "\" ";?> <?php echo "onclick=\"check(" . '\'' . $inter["nom_inter"] . '\'' . ")\"";?>> 
              <a style="float: right;" href="mail.php?inter=<?php echo $inter['id_inter']; ?>&an=<?php echo $annee;?>">
                <img class="mail_logo" src="images/mail.png">
              </a> 
            </div>
            <ul class="col2">
              <?php
                $rep2=$bd->prepare('SELECT matiere.id_mat, nom_mat, abreg_mat, nb_heure, nbh_seance, id_inter
                                  FROM  matiere INNER JOIN intervenir ON matiere.id_mat=intervenir.id_mat
                                  WHERE id_inter=? and annee=?');
                $rep2->execute(array($inter['id_inter'], $annee)) or die(print_r($rep2->errorInfo()));
                while ($matiere=$rep2->fetch()) {
                  ?>
                  <li>
                    <div class="DragZoneSource" style="background-color: rgba(128, 128, 128, 0.18);">
                      <div id="draggable" data-mat="<?php echo $matiere['id_mat'];?>" data-an="<?php echo $annee;?>" data-heure="<?php echo $matiere['nbh_seance'];?>" data-dir="<?php echo $inter['id_inter'];?>" data-interName="<?php echo $inter['nom_inter'];?>" <?php echo "class=\"" . $inter['nom_inter'] . "\" ";?> draggable="false"  <?php echo "style=\"" . "background-color:#". $co4[$inter['id_inter']] . ";" . " width:100%" .";\" ";?> ><?php echo $matiere['abreg_mat']; ?>
                      </div>
                    </div><div class="nbHeure">
                      <?php
                        $reponse=$bd->prepare('SELECT (nb_heure-SUM(duree)) as rest_heure 
                                              FROM annee INNER JOIN periode ON annee.annee=periode.annee
                                                    INNER JOIN semaine ON periode.id_per=semaine.id_per
                                                    INNER JOIN jour ON semaine.id_sem=jour.id_sem
                                                    INNER JOIN seance ON jour.id_jour=seance.id_jour                                                    
                                                    INNER JOIN dispenser ON seance.id_seance=dispenser.id_seance
                                                    INNER JOIN matiere ON dispenser.id_mat=matiere.id_mat
                                              WHERE matiere.id_mat=? and annee.annee=?');
                        $reponse->execute(array($matiere['id_mat'],$annee)) or die(print_r($reponse->errorInfo()));
                        $reste=$reponse->fetch();
                        echo $reste['rest_heure']; 
                      ?>
                    </div>
                  </li>
                  <?php
                  $ic = $ic +1;
                  ?>
                  <?php
                }
              ?>
            </ul>
          </li>
        <?php
      }
    ?>
    <button class="button_periode"><a style="text-decoration: none; color:black;" href="gestion_matiere.php?an=<?php echo $annee; ?>">Gestion des Matières</a></button>
  </ul>
    <div class="panel_information">
      <p>date : <span style="display:none;" id="panel_date">  </span>  <span id="panel_date_entier">  </span></p>
      <p>intervenant 1 : <span id="panel_inter_1">  </span></p>
      <p>cour 1 : <span id="panel_cour_1">  </span> </p>
      <p>intervenant 2 : <span id="panel_inter_2">  </span></p>
      <p>cour 2 : <span id="panel_cour_2">  </span> </p>
      <p>contrainte : <span id="panel_cont">  </span></p>
      <p>moment : <span id="panel_mom">  </span></p>

    </div>
  </div>
</div>
  <!--<script type="text/javascript" src="js/ouvre_mail.js"></script>-->
  <SCRIPT language="javascript">

  (function(){
      var intervenant=document.getElementsByClassName('intervenant'),
          matin=document.getElementsByClassName('matin'),
          amidi=document.getElementsByClassName('a-midi');
          //alert(matin[0].getElementsByTagName('td').length);
      //les fonction AJAX pour recupération contrainte matin
      function recup_contrainte_mat(but,mat){
        var inter=but.getAttribute('data-inter'),
            xhr= new XMLHttpRequest();
            //alert(inter);
        xhr.open('GET','ajax/recup_contrainte_mat.php?inter='+ inter);
        xhr.onreadystatechange= function(){
          if (xhr.readyState==4 && xhr.status==200) {
            /*alert("ffsfs");
            alert(xhr.responseText);
            alert(mat);*/
            list(xhr.responseText,mat);
            
          }
        };

        xhr.send(null);
      }

      function list(reponse, lignes){
        
        if (reponse.length) {
          reponse=reponse.split('|');
          //alert(reponse[0]);
          for (var i = 0; i < lignes.length; i++) {
            var celulles=lignes[i].getElementsByTagName('td'),
                j=0;
                //alert(lignes[i].childNodes.length);
            for (var k = 0; k < celulles.length; k+=2) {
              j=k/2;
              //alert(celulles[k].getAttribute('data-cont'));
              celulles[k].setAttribute('data-cont',reponse[j]);
              //alert(reponse[j]);
              //celulles[k].dataset.cont= reponse[j];
            };
          };
        }
      }
      //les fonction AJAX pour recupération contrainte apres-midi
      function recup_contrainte_soir(but,soir){
        var inter=but.getAttribute('data-inter'),
            xhr= new XMLHttpRequest();
        xhr.open('GET','ajax/recup_contrainte_soir.php?inter='+ inter);
        xhr.onreadystatechange= function(){
          if (xhr.readyState==4 && xhr.status==200) {

            list2(xhr.responseText,soir);
          }
        };

        xhr.send(null);
      }

    

      function list2(reponse, lignes){
        
        if (reponse.length) {
          reponse=reponse.split('|');
          //alert(reponse[0]);
          for (var i = 0; i < lignes.length; i++) {
            var celulles=lignes[i].getElementsByTagName('td'),
                j=0;
               // alert(lignes[i].childNodes.length);
            for (var k = 0; k < celulles.length; k+=2) {
              j=k/2;
              //alert(celulles[k].getAttribute('data-cont'));
              celulles[k].setAttribute('data-cont',reponse[j]);
              //alert(reponse[j]);
              //celulles[k].dataset.cont= reponse[j];
            };
          };
        }
      }

      //recupération des contraintes paticulieres 
      function recup_contrainte_part(but,mat,soir){
        var inter=but.getAttribute('data-inter'),
            xhr= new XMLHttpRequest();
        xhr.open('GET','ajax/recup_contrainte_part.php?inter='+ inter);
        xhr.onreadystatechange= function(){
          if (xhr.readyState==4 && xhr.status==200) {
            //alert(xhr.responseText);
            list3(xhr.responseText,mat,soir);
          }
        };

        xhr.send(null);
      }

      function list3(reponse,lignes1,lignes2){
        //alert("fsefsrgrde");
        if (reponse.length) {
          //on recupre notre tableau php envoy par la requette AJAX
          reponse=reponse.split('|');
          for (var a = 0; a < reponse.length; a++) {
            //alert(reponse[a]);
            //on recupere les elements de la contrainte particulire courante
            var contrainte=reponse[a].split('#');
            //alert(contrainte[1]);
            if (contrainte[0]=='matin') {//si le moment = matin : on agit sur les lignes matin
              for (var i = 0; i < lignes1.length; i++) {//on recupere les celulles de la ligne courante
                var celulles=lignes1[i].getElementsByTagName('td');
                for (var j = 0; j < celulles.length; j+=2) {//pour chaque celulles on recupere la date associée
                  var cont_date=celulles[j].getAttribute('data-date'),
                      data_cont=celulles[j].getAttribute('data-cont');
                  if (cont_date==contrainte[1]) {//si la date de la celulle = la date de  la contrainte courante : on modifie la contrainte de la celulle
                    celulles[j].setAttribute('data-cont', 'impossible');
                  }
                };
              };
            }
            else{//si le moment = a-midi : on agit sur les lignes amidi
              //alert(contrainte[0]);
              //alert(ligne2.length);
              for (var i = 0; i < lignes2.length; i++) {//on recupere les celulles de la ligne courante
                var celulles=lignes2[i].getElementsByTagName('td');
               // alert(lignes2[i].childNodes.length);
                for (var j = 0; j < celulles.length; j+=2) {//pour chaque celulles on recupere la date associée
                  var cont_date=celulles[j].getAttribute('data-date'),
                      data_cont=celulles[j].getAttribute('data-cont');
                  if (cont_date==contrainte[1]) {//si la date de la celulle = la date de  la contrainte courante : on modifie la contrainte de la celulle
                    celulles[j].setAttribute('data-cont','impossible');
                  }
                };
              };
            }
          };
          
        }
      }
      for (var i = 0; i < intervenant.length; i++) {
        intervenant[i].onmouseup=function(){
          recup_contrainte_mat(this,matin);
          recup_contrainte_soir(this,amidi);
          recup_contrainte_part(this,matin,amidi);
        }
      };

    })();

     function ouvre_mail(page) {
        var myWindow = window.open(page,"nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=500");
        myWindow.document.write("<div id='hello'>intervenant : baptiste jeudy <div><p>commentaire de intervenant : il ne met pas possible de faire cour le jeudy apres midi du à mes cour à la fac de science de iut </p> <p>durée du cour : 3h30</p> cour le : <ul><li> mardi 08 mars 2016 Après-midi </li><li> mercredi 09 mars 2016 matin </li><li> mardi 15 mars 2016 Après-midi </li><li> mardi 23 mars 2016 Après-midi </li></ul>");
        var range = myWindow.document.createRange();
        range.selectNode(myWindow.document.getElementById('hello'));
        myWindow.getSelection().addRange(range);
        myWindow.select();

     }

  </SCRIPT>
  <script type="text/javascript" src="js/afficher_cacher_div.js"></script>
  <script type="text/javascript">
  //<!--
     // afficher_cacher('texte');
  //-->
  </script>



<script type="text/javascript" src="js/checkbox.js"></script>
<script type="text/javascript" src="js/dragAndDropV4.js"></script>


<br/><br/>

<?php include("footer.php"); ?>