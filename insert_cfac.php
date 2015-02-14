<?php
include_once('connection.php');
$id_fac=isset($id_fac)?$id_fac:$_POST['id_fac'];
//$id_fac=$_POST['id_fac'];
$id_ar=$_POST['id_ar'];
$qte_ar=$_POST['qte_ar'];
$p_u=$_POST['p_u'];
$requete="INSERT INTO facture_con (id_fac, id_ar, qte_ar, prix_vente) VALUES ($id_fac,$id_ar,$qte_ar, $p_u)";
									
$resultat=pg_query($connexion,$requete);
?>