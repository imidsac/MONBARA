<?php
include_once('connection.php');
$id_tr=$_POST['id_tr'];
/*$id_ar=$_POST['id_ar'];
$qte_ar=$_POST['qte_ar'];
$qte_livres=$_POST['qte_livres'];
$prix_vente=$_POST['prix_vente'];
$requete="update transferts_con set qte_ar=$qte_ar,
												qte_livres=$qte_livres,
												prix_vente=$prix_vente 
												where id_tr=$id_tr and id_ar=$id_ar";								

$resultat=pg_query($connexion,$requete);*/



$resultat1=pg_query($connexion, "SELECT * from transferts_con where id_tr=$id_tr");
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
		$qte_ar=$_POST[$qt];
		$liv=$_POST[$li];
		$prix_vente=$_POST[$pu];
		//if($etat==1) 
		$requete="update transferts_con set qte_ar=$qte_ar,prix_vente=$prix_vente,qte_livres=$liv 
		where id_tr=$id_tr and id_ar=$id_ar";
		//else 
		//$requete="update transferts_con set qte_ar=$qte_ar,prix_vente=$prix_vente where id_tr=$id_tr and id_ar=$id_ar";
		$resultat=pg_query($connexion,$requete);
	}
?>
