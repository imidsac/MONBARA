
<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
$id_fo=$_POST['id_fo'];
$date_1=$_POST['date_1'];
$date_2=$_POST['date_2'];
$requete="UPDATE achat SET id_fo=$id_fo,date_1='$date_1',date_2='$date_2' where id_ac=$id_ac";
									
$resultat=pg_query($connexion,$requete);
?>
