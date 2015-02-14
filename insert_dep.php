<?php
include_once('connection.php');
//$id_dep=$_POST['id_dep'];
$lib_dep=$_POST['lib_dep'];
$crencier=$_POST['crencier'];
$beneficiere=$_POST['beneficiere'];
$date_dep=$_POST['date_dep'];
$montant=$_POST['montant'];
$id_bo=$_POST['id_bo'];
$requete="INSERT INTO depences (lib_dep,crencier, beneficiere, date_dep, montant,id_bo) 
VALUES ($$$lib_dep$$,'$crencier','$beneficiere','$date_dep',$montant,$id_bo)";									
$resultat=pg_query($connexion,$requete);
?>