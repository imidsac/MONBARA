<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$id_ve=$_POST['id_ve'];
$date_ve=$_POST['date_ve'];
$id_ar=$_POST['id_ar'];
//$lib_ar=$_POST['lib_ar'];
//$type_ar=$_POST['type_ar'];
$qt_ar=$_POST['qt_ar'];
//$pu_ar=$_POST['pu_ar'];
$debit=$_POST['debit'];
//$id_fo=$_POST['id_fo'];
//$nom_fo=$_POST['nom_fo'];

$requete="UPDATE ventes SET date_ve='$date_ve', id_ar=$id_ar, qt_ar=$qt_ar, debit=$debit  where id_ve=$id_ve";
									
$resultat=pg_query($connexion,$requete);

?>
