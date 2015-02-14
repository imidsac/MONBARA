<?php
include_once('connection.php');
$id_dep=$_POST['id_dep'];
$requete="DELETE from depences where id_dep=$id_dep";
									
$resultat=pg_query($connexion,$requete);
?>