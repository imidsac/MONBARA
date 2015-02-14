<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
$id_ar=$_POST['id_ar'];
$requete="DELETE FROM achat_con WHERE id_ac=$id_ac and id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>