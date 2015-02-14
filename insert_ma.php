<?php
include_once('connection.php');
//$id_m=$_POST['id_m'];
$lib_m=$_POST['lib_m'];
$type_m=$_POST['type_m'];
//$stoc_m=$_POST['stoc_m'];
//$id_fo=$_POST['id_fo'];
$prix_achat=$_POST['prix_achat'];

$requete="INSERT INTO materiels (lib_m,type_m,prix_achat) VALUES ('$lib_m', '$type_m',$prix_achat)";
									
$resultat=pg_query($connexion,$requete);
?>