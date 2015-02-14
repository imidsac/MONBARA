<?php
include_once('connection.php');
//$id_fac=$_POST['id_fac'];
$date_fac=$_POST['date_fac'];
$id_cl=$_POST['id_cl'];
$uti=$_POST['id_bo'];

$requete="INSERT INTO facture (date_fac, id_cl,id_bo) VALUES ('$date_fac',$id_cl,$uti)";
									
$resultat=pg_query($connexion,$requete);
?>