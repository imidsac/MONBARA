<?php
include_once('connection.php');
$id_co=$_POST['id_co'];
$id_ar=$_POST['id_ar'];
$requete="DELETE FROM ccommandes WHERE id_co=$id_co and id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>