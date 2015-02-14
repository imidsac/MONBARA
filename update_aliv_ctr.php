<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
$id_ar=$_POST['id_ar'];
$reste=$_POST['reste'];
//$id_ar=$_POST['id_ar'];
//if(!pg_connection_busy($requete)) {
$requete="update transferts_con set qte_livres=0 where id_ar=$id_ar and id_tr=$id_tr ";
	//}
//$res1 = pg_get_result($requete);
//echo pg_result_error($res1);								
$resultat=pg_query($connexion,$requete);
?>