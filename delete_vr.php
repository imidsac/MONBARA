<?php
include_once('connection.php');
$id_vr=$_POST['id_vr'];
$requete="DELETE from verait where id_vr=$id_vr";							
$resultat=pg_query($connexion,$requete);
?>