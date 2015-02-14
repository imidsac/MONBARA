<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
$id_ar=$_POST['id_ar'];
$reste=$_POST['reste'];
//$id_ar=$_POST['id_ar'];
//if(!pg_connection_busy($requete)) {
$requete="update achat_con set qte_livres=0 where id_ar=$id_ar and id_ac=$id_ac ";
	//}
//$res1 = pg_get_result($requete);
//echo pg_result_error($res1);								
$resultat=pg_query($connexion,$requete);
?>