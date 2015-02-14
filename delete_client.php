<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$requete="DELETE from clients where id_cl=$id_cl";
									
$resultat=pg_query($connexion,$requete);
?>