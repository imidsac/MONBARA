<?php
include_once('connection.php');
$id_fac=$_POST['id_fac'];
$id_ar=$_POST['id_ar'];
$requete="DELETE FROM facture_con WHERE id_fac=$id_fac and id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>