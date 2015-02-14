<?php
include_once('connection.php');
$id_fac=$_POST['id_fac'];
$id_ar=$_POST['id_ar'];
$reste=$_POST['reste'];
//$id_ar=$_POST['id_ar'];
//if(!pg_connection_busy($requete)) {
$requete="update facture_con set qte_livres=0 where id_ar=$id_ar and id_fac=$id_fac ";
	//}
//$res1 = pg_get_result($requete);
//echo pg_result_error($res1);								
$resultat=pg_query($connexion,$requete);
?>