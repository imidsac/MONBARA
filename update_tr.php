
<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
$date_tr=$_POST['date_tr'];
$id_bo=$_POST['id_bo'];

$requete="UPDATE transferts SET date_tr ='$date_tr', id_bo=$id_bo where id_tr=$id_tr";
									
$resultat=pg_query($connexion,$requete);
?>
