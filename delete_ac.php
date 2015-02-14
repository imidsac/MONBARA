<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
$requete="DELETE from achat where id_ac=$id_ac";
									
$resultat=pg_query($connexion,$requete);
?>