<?php
include_once('connection.php');
$id_ac=isset($id_ac)?$id_ac:$_POST['id_ac'];
//$id_ac=$_POST['id_ac'];
$id_ar=$_POST['id_ar'];
$qt_ar=$_POST['qt_ar'];
$p_u=$_POST['p_u'];
$requete="INSERT INTO achat_con (id_ac, id_ar, qt_ar, prix_achat) VALUES ($id_ac,$id_ar,$qt_ar, $p_u)";
									
$resultat=pg_query($connexion,$requete);
?>