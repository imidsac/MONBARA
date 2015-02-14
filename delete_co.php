<?php
include_once('connection.php');
$id_co=$_POST['id_co'];
$requete="DELETE from commandes where id_co=$id_co";
									
$resultat=pg_query($connexion,$requete);
?>