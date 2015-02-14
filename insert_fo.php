<?php
include_once('connection.php');
$id_fo=$_POST['id_fo'];
$nom_fo=$_POST['nom_fo'];
//$prenom_cl=$_POST['prenom_cl'];
$add_fo=$_POST['add_fo'];
$tel1_fo=$_POST['tel1_fo'];
$tel2_fo=$_POST['tel2_fo'];
$requete="INSERT INTO fournisseur (nom_fo, add_fo, tel1_fo ) VALUES ('$nom_fo', '$add_fo','$tel1_fo')";
									
$resultat=pg_query($connexion,$requete);
?>