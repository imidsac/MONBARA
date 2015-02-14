<?php
include_once('connection.php');
$id_ac=$_POST['id_ac'];
//$pu=$_POST['prix_achat'];
$resultat1=pg_query($connexion, "SELECT * from achat_con where id_ac=$id_ac");
$resultat2=pg_query($connexion,$requete);
while ($ligne=pg_fetch_assoc($resultat1))
	{
		$id_ar=$ligne['id_ar'];		
		$qt='qt_'.$ligne['id_ar'];
		$li='li_'.$ligne['id_ar'];
		$pu='pu_'.$ligne['id_ar'];
		//$etat=0;
		//if(isset($_POST[$et])) $etat=1;
		$id_ar=$ligne['id_ar'];
		$qt_ar=$_POST[$qt];
		$prix_achat=$_POST[$pu];
		$liv=$_POST[$li];
		//if($etat==1) 
		$requete="update achat_con set qt_ar=$qt_ar,prix_achat=$prix_achat, qte_livres=$liv 
		where id_ac=$id_ac and id_ar=$id_ar";
		//else 
		//$requete="update achat_con set qt_ar=$qt_ar,prix_achat=$prix_achat where id_ac=$id_ac and id_ar=$id_ar";
		$resultat=pg_query($connexion,$requete);
	}
?>