<?php
include_once('connection.php');
$id_co=$_POST['id_co'];
$resultat1=pg_query($connexion, "SELECT * from ccommandes where id_co=$id_co");
$resultat2=pg_query($connexion,$requete);
while ($ligne=pg_fetch_assoc($resultat1))
	{
		$id_ar=$ligne['id_ar'];		
		$qt='qt_'.$ligne['id_ar'];
		$et='et_'.$ligne['id_ar'];
		$etat=0;
		if(isset($_POST[$et])) $etat=1;
		$id_ar=$ligne['id_ar'];
		$qt_ar=$_POST[$qt];
		$etat=$_POST[$et];
		if($etat==1) 
		$requete="update ccommandes set qt_ar=$qt_ar,etat=1 where id_co=$id_co and id_ar=$id_ar";
		else 
		$requete="update ccommandes set qt_ar=$qt_ar,etat=0 where id_co=$id_co and id_ar=$id_ar";
		$resultat=pg_query($connexion,$requete);
	}
?>