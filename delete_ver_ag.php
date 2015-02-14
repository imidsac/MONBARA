<?php
include_once('connection.php');
$id_trp=$_POST['id_trp'];

$requete1="DELETE from trpaiement where id_trp=$id_trp";
									
$resultat1=pg_query($connexion,$requete1);
?>