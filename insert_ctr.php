<?php
include_once('connection.php');
$id_tr=isset($id_tr)?$id_tr:$_POST['id_tr'];
//$id_tr=$_POST['id_tr'];
$id_ar=$_POST['id_ar'];
$qte_ar=$_POST['qte_ar'];
$p_u=$_POST['p_u'];
$requete="INSERT INTO transferts_con (id_tr, id_ar, qte_ar, prix_vente) VALUES ($id_tr,$id_ar,$qte_ar, $p_u)";
									
$resultat=pg_query($connexion,$requete);
?>