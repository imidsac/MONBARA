<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$id_b=$_POST['id_b'];
$compte_banc=$_POST['compte_banc'];
$type=$_POST['type'];
$date_b=$_POST['date_b'];
$somme=$_POST['somme'];
$id_bk=$_POST['id_bk'];
$requete="UPDATE bamk SET compte_banc='$compte_banc', type='$type', date_b ='$date_b', id_bk =$id_bk, solde =$somme where id_b =$id_b";
									
$resultat=pg_query($connexion,$requete);
?>