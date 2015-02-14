<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_facp=$_POST['date_facp'];
$uti=$_POST['id_bo'];
//$requete="update facture set payee=payee+$reste where id_tr=$id_tr";
$requete1="INSERT INTO trpaiement (id_tr, motif,date_facp, montant,id_bo) 
						VALUES ($id_tr,'$motif','$date_facp',$reste,$uti)";
									
//$resultat=pg_query($connexion,$requete);
$resultat1=pg_query($connexion,$requete1);
?>