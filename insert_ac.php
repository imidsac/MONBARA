<?php
include_once('connection.php');
/*$id_fo=$_POST['id_fo'];
$date_1=$_POST['date_1'];
$date_2=$_POST['date_2'];*/
$uti=$_POST['id_bo'];
$requete="INSERT INTO achat (id_fo, date_1, date_2,id_bo) VALUES ($id_fo, '$date_1', '$date_2',$uti)";
									
$resultat=pg_query($connexion,$requete);
?>