<?php
include_once('connection.php');
$id_ar=$_POST['id_ar'];
$requete="DELETE from articles where id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>