<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_facp=$_POST['date_facp'];
$uti=$_POST['id_bo'];

$requete1="SELECT f_facpaie1_annee($id_cl,$reste,'$date_facp','$motif')";
									
$resultat1=pg_query($connexion,$requete1);
?>
