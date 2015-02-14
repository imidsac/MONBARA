
<?php
include_once('connection.php');
$id_fac=$_POST['id_fac'];
$date_fac=$_POST['date_fac'];
$id_cl=$_POST['id_cl'];

$requete="UPDATE facture SET date_fac ='$date_fac', id_cl=$id_cl where id_fac=$id_fac";
									
$resultat=pg_query($connexion,$requete);
?>
