
<?php
include_once('connection.php');
$id_dep=$_POST['id_dep'];
$lib_dep=$_POST['lib_dep'];
$crencier=$_POST['crencier'];
$beneficiere=$_POST['beneficiere'];
$date_dep=$_POST['date_dep'];
$montant=$_POST['montant'];
$id_bo=$_POST['id_bo'];
$requete="UPDATE depences SET lib_dep=$$$lib_dep$$,
                                        id_bo=$id_bo, 
										date_dep='$date_dep',
										crencier='$crencier', 
										beneficiere='$beneficiere', 
										montant='$montant' WHERE id_dep=$id_dep";								
$resultat=pg_query($connexion,$requete);
?>
