<?php
include_once('connection.php');
$id_f=$_POST['id_f'];
$id_si1=$_POST['id_si1'];
$id_si2=$_POST['id_si2'];
$mont=$_POST['mont'];
//$pieces=$_POST['pieces'];
$nom_ex=$_POST['nom_ex'];
$prenom_ex=$_POST['prenom_ex'];
$tel_ex=$_POST['tel_ex'];
$nom_des=$_POST['nom_des'];
$prenom_des=$_POST['prenom_des'];
$tel_des=$_POST['tel_des'];
$date1=$_POST['date1'];
$requete="INSERT INTO transfere (id_si1,id_si2,mont,nom_ex,prenom_ex,tel_ex,nom_des,prenom_des,tel_des,date1) 
VALUES ($id_si1,$id_si2,$mont, '$nom_ex','$prenom_ex','$tel_ex','$nom_des','$prenom_des','$tel_des','$date1')";
									
$resultat=pg_query($connexion,$requete);
?>