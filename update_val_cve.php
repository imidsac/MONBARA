<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$requete="update ventes_con set etat=1 where id_ve=$id_ve";
									
$resultat=pg_query($connexion,$requete);
?>