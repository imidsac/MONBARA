<?php
include_once('connection.php');
$id_m=$_POST['id_m'];
$requete="DELETE from materiels where id_m=$id_m";
									
$resultat=pg_query($connexion,$requete);
?>