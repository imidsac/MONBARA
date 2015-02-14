<?php
include_once('connection.php');
$id_b=$_POST['id_b'];
$somme=$_POST['somme'];
$type=$_POST['type'];
$porteur=$_POST['porteur'];
$date_vr=$_POST['date_vr'];
$requete="INSERT INTO verait (id_b,somme,type,porteur,date_vr) 
VALUES ($id_b,$somme,'$type', '$porteur','$date_vr')";								
$resultat=pg_query($connexion,$requete);
?>