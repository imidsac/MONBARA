<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
$requete="DELETE from transferts where id_tr=$id_tr";
									
$resultat=pg_query($connexion,$requete);
?>