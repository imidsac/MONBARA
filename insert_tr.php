

<?php
include_once('connection.php');
//$id_fac=$_POST['id_fac'];
$date_tr=$_POST['date_tr'];
$id_cl=$_POST['id_cl'];
$id_bo=$_POST['id_bo'];

$requete="INSERT INTO transferts (date_tr,id_bo) VALUES ('$date_tr',$id_bo)";
									
$resultat=pg_query($connexion,$requete);
?>