<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$id_acha=$_POST['id_acha'];
$a_date=$_POST['a_date'];
$id_ar=$_POST['id_ar'];
//$lib_ar=$_POST['lib_ar'];
//$type_ar=$_POST['type_ar'];
$qt_ar=$_POST['qt_ar'];
//$pu_ar=$_POST['pu_ar'];
$debit=$_POST['debit'];
$id_fo=$_POST['id_fo'];
//$nom_fo=$_POST['nom_fo'];

$requete="UPDATE achat SET a_date='$a_date', id_ar=$id_ar, qt_ar=$qt_ar, debit=$debit, id_fo=$id_fo  where id_acha=$id_acha";
									
$resultat=pg_query($connexion,$requete);

?>
