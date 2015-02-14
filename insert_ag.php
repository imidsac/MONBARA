<?php
include_once('connection.php');
$id_bo=$_POST['id_bo'];
$nom_bo=$_POST['nom_bo'];
$tel_bo=$_POST['tel_bo'];
$adr_bo=$_POST['adr_bo'];
$id_vi=$_POST['id_vi'];

$requete="INSERT INTO boutiques (nom_bo, tel_bo, id_vi,adr_bo) 
VALUES ('$nom_bo', '$tel_bo', $id_vi,'$adr_bo')";
									
$resultat=pg_query($connexion,$requete);
?>