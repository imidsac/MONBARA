<?php
include_once('connection.php');
$id_fo=$_POST['id_fo'];
$requete="DELETE from fournisseur where id_fo=$id_fo";
									
$resultat=pg_query($connexion,$requete);
?>