<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$date_ve=$_POST['date_ve'];
$id_ar=$_POST['id_ar'];
$qt_ar=$_POST['qt_ar'];
$debit=$_POST['debit'];
//$id_fo=$_POST['id_fo'];
//$prix_vente=$_POST['prix_vente'];
$requete="INSERT INTO ventes (date_ve,id_ar,qt_ar,debit) VALUES ('$date_ve', $id_ar, $qt_ar, $debit)";
									
$resultat=pg_query($connexion,$requete);
?>