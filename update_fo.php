<?php
include_once('connection.php');
$id_fo=$_POST['id_fo'];
$nom_fo=$_POST['nom_fo'];
$add_fo=$_POST['add_fo'];
$tel1_fo=$_POST['tel1_fo'];
$tel2_fo=$_POST['tel2_fo'];
$requete="update fournisseur SET 
						nom_fo='$nom_fo', 
						add_fo='$add_fo',
						tel1_fo='$tel1_fo'
						where id_fo=$id_fo";
									
$resultat=pg_query($connexion,$requete);
?>