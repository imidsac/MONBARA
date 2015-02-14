<?php
include_once('connection.php');
$id_bo=$_POST['id_bo'];
$id_b=$_POST['id_b'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_trp=$_POST['date_trp'];
//$uti=$_POST['id_bo'];

$requete1="SELECT f_trpaie_annee($id_bo,$reste,'$date_trp','$motif',$id_b)";
									
$resultat1=pg_query($connexion,$requete1);
?>