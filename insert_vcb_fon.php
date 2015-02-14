<?php
include_once('connection.php');
$montant=$_POST['montant'];
$type_ctj=$_POST['type_ctj'];
$crencier1=$_POST['crencier1'];
$crencier2=$_POST['crencier2'];
$date_ctj=$_POST['date_ctj'];
$uti=$_POST['id_bo'];
$requete="INSERT INTO ctjournal (montant,type_ctj,crencier1,crencier2,date_ctj,id_bo)
 
				VALUES ($montant,'$type_ctj','$crencier1','$crencier2','$date_ctj',$uti)";								
$resultat=pg_query($connexion,$requete);
?>