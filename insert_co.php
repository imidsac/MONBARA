<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$requete="INSERT INTO commandes (id_cl, date1, date2) VALUES ($id_cl, '$date1', '$date2')";
									
$resultat=pg_query($connexion,$requete);
?>