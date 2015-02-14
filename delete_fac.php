<?php
include_once('connection.php');
$id_fac=$_POST['id_fac'];
$requete="DELETE from facture where id_fac=$id_fac";
									
$resultat=pg_query($connexion,$requete);
?>