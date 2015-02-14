
<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$date_ve=$_POST['date_ve'];
$client=$_POST['client'];

$requete="UPDATE ventes SET date_ve ='$date_ve', client='$client' where id_ve=$id_ve";
									
$resultat=pg_query($connexion,$requete);
?>
