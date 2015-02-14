<?php
include_once('connection.php');
$id_fo=$_POST['id_fo'];
$id_ac=isset($_GET['id_ac'])?$_GET['id_ac']:$_POST['id_ac'];
$reste=$_POST['reste'];
$motif=$_POST['motif'];
$date_fp=$_POST['date_fp'];
$id_bo=$_POST['id_bo'];
//$requete="update achat set payee=payee+$reste where id_ac=$id_ac";
$requete1="INSERT INTO fpaiement (id_fo, motif,date_fp, montant, id_ac,id_bo) 
						VALUES ($id_fo,'$motif','$date_fp',$reste, $id_ac,$id_bo)";
									
//$resultat=pg_query($connexion,$requete);
$resultat1=pg_query($connexion,$requete1);
?>