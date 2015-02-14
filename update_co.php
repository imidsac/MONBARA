
<?php
include_once('connection.php');
$id_co=$_POST['id_co'];
$id_cl=$_POST['id_cl'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$requete="UPDATE commandes SET id_cl=$id_cl,date1='$date1',date2='$date2' where id_co=$id_co";
									
$resultat=pg_query($connexion,$requete);
?>
