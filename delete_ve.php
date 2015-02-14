<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$requete="DELETE from ventes where id_ve=$id_ve";
									
$resultat=pg_query($connexion,$requete);
?>