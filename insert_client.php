<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$nom_cl=$_POST['nom_cl'];
$prenom_cl=$_POST['prenom_cl'];
$add_cl=$_POST['add_cl'];
$tel1_cl=$_POST['tel1_cl'];
$tel2_cl=$_POST['tel2_cl'];
$uti=$_POST['id_bo'];
$requete="INSERT INTO clients (nom_cl, prenom_cl, add_cl, tel1_cl, id_bo) 
VALUES ('$nom_cl', '$prenom_cl', '$add_cl', '$tel1_cl',$uti)";
									
$resultat=pg_query($connexion,$requete);
?>