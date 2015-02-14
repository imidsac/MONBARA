<?php
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$id_acha=$_POST['id_acha'];
$requete="DELETE from achat where id_acha=$id_acha";
									
$resultat=pg_query($connexion,$requete);
?>