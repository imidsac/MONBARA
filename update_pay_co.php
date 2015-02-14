<?php
include_once('connection.php');
$id_cl=$_POST['id_cl'];
$id_co=$_POST['id_co'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_cp=$_POST['date_cp'];
$requete="update commandes set payee=payee+$reste where id_co=$id_co";
$requete1="INSERT INTO cpaiement (id_cl, motif,date_cp, montant, id_co) 
						VALUES ($id_cl,'$motif','$date_cp',$reste, $id_co)";
									
$resultat=pg_query($connexion,$requete);
$resultat1=pg_query($connexion,$requete1);
?>