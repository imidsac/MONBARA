<?php
include_once('connection.php');
$id_ve=isset($id_ve)?$id_ve:$_POST['id_ve'];
//$id_ve=$_POST['id_ve'];
$id_ar=$_POST['id_ar'];
$qte_ar=$_POST['qte_ar'];
$requete="INSERT INTO ventes_con (id_ve, id_ar, qte_ar) VALUES ($id_ve,$id_ar,$qte_ar)";
									
$resultat=pg_query($connexion,$requete);
?>