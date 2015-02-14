<?php
include_once('connection.php');
$uti=$_POST['id_bo'];
$id_em=$_POST['id_em'];
$id_ep=$_POST['id_ep'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_tep=$_POST['date_tep'];
$requete2="INSERT INTO tepaiement (id_em,motif,date_tep,montant,id_ep,id_bo) 
VALUES ($id_em,'$motif','$date_tep',$reste, $id_ep,$uti)";
									
$resultat2=pg_query($connexion,$requete2);
?>