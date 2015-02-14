<?php
include_once('connection.php');
$id_co=isset($id_co)?$id_co:$_POST['id_co'];
//$id_co=$_POST['id_co'];
$id_ar=$_POST['id_ar'];
$qt_ar=$_POST['qt_ar'];
$requete="INSERT INTO ccommandes (id_co, id_ar, qt_ar) VALUES ($id_co,$id_ar,$qt_ar)";
									
$resultat=pg_query($connexion,$requete);
?>