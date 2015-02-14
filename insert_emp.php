<?php
include_once('connection.php');
$id_em=$_POST['id_em'];
$nom_em=$_POST['nom_em'];
$prenom_em=$_POST['prenom_em'];
$lieu=$_POST['lieu'];
$add_em=$_POST['add_em'];
$tel1_em=$_POST['tel1_em'];
$tel2_em=$_POST['tel2_em'];
$montant=$_POST['montant'];
$compte_banc=$_POST['compte_banc'];
$uti=$_POST['id_bo'];
$requete="INSERT INTO employer (nom_em, prenom_em, add_em, tel1_em,compte_banc, montant,id_bo,lieu) 
					VALUES ('$nom_em', '$prenom_em', '$add_em', '$tel1_em','$compte_banc', $montant,$uti,'$lieu')";
									
$resultat=pg_query($connexion,$requete);
?>