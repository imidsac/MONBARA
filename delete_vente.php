<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$id_ve=$_POST['id_ve'];
$requete="DELETE from ventes where id_ve=$id_ve";
									
$resultat=pg_query($connexion,$requete);
?>