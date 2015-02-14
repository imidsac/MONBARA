<?php
include_once('connection.php');
$id_fac=$_POST['id_fac'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_facp=$_POST['date_facp'];
$uti=$_POST['id_bo'];
//$requete="update facture set payee=payee+$reste where id_fac=$id_fac";
$requete1="INSERT INTO facpaiement (id_fac, motif,date_facp, montant,id_bo) 
						VALUES ($id_fac,'$motif','$date_facp',$reste,$uti)";
									
//$resultat=pg_query($connexion,$requete);
$resultat1=pg_query($connexion,$requete1);
?>