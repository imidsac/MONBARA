<?php
include_once('connection.php');
$id_ve=$_POST['id_ve'];
$resultat1=pg_query($connexion, "SELECT * from ventes_con where id_ve=$id_ve");
$resultat2=pg_query($connexion,$requete);
while ($ligne=pg_fetch_assoc($resultat1))
	{
		$id_ar=$ligne['id_ar'];		
		$qt='qt_'.$ligne['id_ar'];
		$et='et_'.$ligne['id_ar'];
		$etat=0;
		if(isset($_POST[$et])) $etat=1;
		$id_ar=$ligne['id_ar'];
		$qte_ar=$_POST[$qt];
		$etat=$_POST[$et];
		if($etat==1) 
		$requete="update ventes_con set qte_ar=$qte_ar,etat=1 where id_ve=$id_ve and id_ar=$id_ar";
		else 
		$requete="update ventes_con set qte_ar=$qte_ar,etat=0 where id_ve=$id_ve and id_ar=$id_ar";
		$resultat=pg_query($connexion,$requete);
	}
?>
