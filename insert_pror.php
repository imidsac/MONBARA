<?php
include_once('connection.php');
$id_ar=$_POST['id_ar'];
$lib_ar=$_POST['lib_ar'];
$type_ar=$_POST['type_ar'];
//$stoc_ar=$_POST['stoc_ar'];
$id_fo=$_POST['id_fo'];
$prix_achat=$_POST['prix_achat'];
$prix_vente=$_POST['prix_vente'];
$requete="INSERT INTO articles (lib_ar, type_ar, id_fo,prix_achat, prix_vente) VALUES ('$lib_ar', '$type_ar', $id_fo,$prix_achat, $prix_vente)";
									
$resultat=pg_query($connexion,$requete);
?>