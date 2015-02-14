<?php
include_once('connection.php');
$id_facp=$_POST['id_facp'];

$requete1="DELETE from facpaiement where id_facp=$id_facp";
									
$resultat1=pg_query($connexion,$requete1);
?>