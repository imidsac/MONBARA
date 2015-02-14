
<?php
include_once('connection.php');
$id_ar=$_POST['id_ar'];
$lib_ar=$_POST['lib_ar'];
$type_ar=$_POST['type_ar'];
//$stoc_ar=$_POST['stoc_ar'];
$info=$_POST['info'];
$prix_vente=$_POST['prix_vente'];
$requete="UPDATE articles SET 
						lib_ar='$lib_ar', 
						type_ar='$type_ar', 
						info='$info',
						prix_vente=$prix_vente  where id_ar=$id_ar";
									
$resultat=pg_query($connexion,$requete);
?>
