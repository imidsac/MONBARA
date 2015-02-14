<?php
include_once('connection.php');
$id_bo=$_POST['id_bo'];
$requete="DELETE from boutiques where id_bo=$id_bo";
									
$resultat=pg_query($connexion,$requete);
?>