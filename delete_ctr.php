<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
$id_ar=$_POST['id_ar'];
$requete="DELETE FROM transferts_con WHERE id_tr=$id_tr and id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>