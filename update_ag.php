
<?php
include_once('connection.php');
$id_bo=$_POST['id_bo'];
$nom_bo=$_POST['nom_bo'];
$tel_bo=$_POST['tel_bo'];
$id_vi=$_POST['id_vi'];
$adr_bo=$_POST['adr_bo'];

$requete="UPDATE boutiques SET 
						nom_bo='$nom_bo', 
						tel_bo='$tel_bo', 
						id_vi=$id_vi,
						adr_bo='$adr_bo' 
						 where id_bo=$id_bo";
									
$resultat=pg_query($connexion,$requete);
?>
