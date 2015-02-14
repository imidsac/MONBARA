<?php
include_once('connection.php');
$id_ctj=$_POST['id_ctj'];
$requete="DELETE from ctjournal where id_ctj=$id_ctj";
									
$resultat=pg_query($connexion,$requete);
?>