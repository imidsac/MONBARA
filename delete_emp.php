<?php
include_once('connection.php');
$id_em=$_POST['id_em'];
$requete="DELETE from employer where id_em=$id_em";
									
$resultat=pg_query($connexion,$requete);
?>