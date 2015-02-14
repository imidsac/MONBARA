<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$a_date=$_POST['a_date'];
$id_ar=$_POST['id_ar'];
$qt_ar=$_POST['qt_ar'];
$debit=$_POST['debit'];
$id_fo=$_POST['id_fo'];
//$prix_vente=$_POST['prix_vente'];
$requete="INSERT INTO achat (a_date,id_ar, qt_ar,debit, id_fo) VALUES ('$a_date', $id_ar, $qt_ar, $debit, $id_fo)";
									
$resultat=pg_query($connexion,$requete);
?>