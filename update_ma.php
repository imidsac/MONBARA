
<?php
include_once('connection.php');
$id_m=$_POST['id_m'];
$lib_m=$_POST['lib_m'];
$type_m=$_POST['type_m'];
//$stoc_m=$_POST['stoc_m'];
//$vente_m=$_POST['vente_m'];
$id_fo=$_POST['id_fo'];
$prix_achat=$_POST['prix_achat'];
$requete="UPDATE materiels SET 
						lib_m='$lib_m', 
						type_m='$type_m', 
						id_fo=$id_fo,
						prix_achat=$prix_achat
						where id_m=$id_m";
									
$resultat=pg_query($connexion,$requete);
?>
