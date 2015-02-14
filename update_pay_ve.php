<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_vp=$_POST['date_vp'];
$requete="update ventes set payee=payee+$reste where id_ve=$id_ve";
$requete1="INSERT INTO vpaiement (id_ve, motif,date_vp, montant) 
						VALUES ($id_ve,'$motif','$date_vp',$reste)";
									
$resultat=pg_query($connexion,$requete);
$resultat1=pg_query($connexion,$requete1);
?>