
<?php
include_once('connection.php');
$id_bo=$_POST['id_bo'];
//$id_ar=$_POST['id_ar'];
//$lib_ar=$_POST['lib_ar'];
//$type_ar=$_POST['type_ar'];
//$stoc_ar=$_POST['stoc_ar'];
//$vente_ar=$_POST['vente_ar'];
//$id_fo=$_POST['id_fo'];
//$prix_achat=$_POST['prix_achat'];
$pvente=$_POST['pvente'];
$requete="UPDATE produits SET  pvente=$pvente  where id_ar=$id_ar and id_bo=$id_bo";
									
$resultat=pg_query($connexion,$requete);
?>
