<?php
include_once('connection.php');
$date_ve=$_POST['date_ve'];
$client=$_POST['client'];

$requete="INSERT INTO ventes (date_ve, client) VALUES ('$date_ve','$client')";
									
$resultat=pg_query($connexion,$requete);
?>