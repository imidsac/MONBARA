<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$id_ar=$_POST['id_ar'];
$requete="DELETE FROM ventes_con WHERE id_ve=$id_ve and id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>