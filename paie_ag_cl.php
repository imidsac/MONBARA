<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

$som_t=0;
$som_p=0;
$som_r=0;
$som_ta=0;
$som_pa=0;
$som_ra=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
		
	
	<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
	
	
</table>
	
		<?php
		$som=0;
		
		$role1=$_POST['role1'];
			if ($role1=='payercl')
				include_once('update_pai_cl.php');
			if ($role1=='payerag')
				include_once('update_pai_ag.php');
			//if ($role1=='ajouter')
			//	include_once('insert_fac.php');
			if ($role1=='supprimer')
				include_once('delete_fac.php');
			
$resultat=pg_query($connexion, "SELECT count(*) as nb_achat,id_cl,nom_cl,prenom_cl,sum(reste) as reste,sum(payee) as payee,sum(somme) as somme 
from facture join clients using(id_cl)
where facture.id_bo=$uti AND reste<>0   
group by id_cl, nom_cl, prenom_cl order by nom_cl, prenom_cl");

echo '<div id="colTwoh">';
 

echo '<table  align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">LISTE DE CREDITAIRES CLIENTS   </h5></th></tr>';

echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<!-- <th>DATE</th> -->
		<th colspan="2" align="center">CLIENT</th>
		<th align="center">NB_ACHATS</th>
		<th align="right">SOMME_TOTAL</th>
		<th align="right">SOMME_PAYEE</th>
		<th align="right">SOMME_RESTE</th>';
		if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {
		echo '<th class="lcentre">ACTION</th>';
		}
		echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
 	//echo '<td class="ldroite crouge">'.$ligne['id_fac'].'</td>';
	//echo '<td>'.$ligne['date_fac'].'</td>';
	echo '<td>'.$ligne['nom_cl'].'</td>';
	echo '<td>'.$ligne['prenom_cl'].'</td>';
	echo '<td class="lcentre cnoire">'.$ligne['nb_achat'].' Fois</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
	/*if($ligne['etat_fac']=='n') 
		echo '<td class="lcentre crouge">N-Livrai</td>';
	else if($ligne['etat_fac']=='p')
		echo '<td class="lcentre cbleu">P-Livrai</td>';
	else 
		echo '<td class="lcentre cnoire">T-Livrai</td>';*/
		
	if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {	
	echo '<td align="center"><a href="paie_cl.php?date_fac='.$ligne['date_fac'].
										'&nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										'&nb_achat='.$ligne['nb_achat'].
										 '&somme='.$ligne['somme'].
										  '&payee='.$ligne['payee'].
										   '&reste='.$ligne['reste'].
										 '&id_cl='.$ligne['id_cl'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">PAIEMENT</button></a></td>';
										 
	}
	/*echo '<td><a href="sup_fac.php?nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
										'&date_fac='.$ligne['date_fac'].
										'&client='.$client.
										 '&id_fac='.$ligne['id_fac'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
										 
	echo '<td><a href="cfac.php?id_fac='.$ligne['id_fac'].
												'&nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
												'&date_fac='.$ligne['date_fac'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'&client='.$client.
												'"><button id="myb"  class="ui-state-active ui-corner-all boutons">TRACE PAIEMENTS</button></a></td>';*/	
	
	echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
	$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="4" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td></td>';
		 	//echo '<td colspan="4" align="center"></td>';
			echo '</tr>';

echo '</table>';
/*}
else { 
echo '<div style="text-align: center"><h2><strong>Pas des sorties dans cette client!!!!</strong></h2></div>';
echo '<a href="ajo_fac.php?&client='.$client.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>';
} 
*/
echo '</div>';
/*========================================================================transferts==========================================*/

$resultat2=pg_query($connexion, "SELECT count(*) as nb_achat,id_bo,nom_bo,adr_bo,sum(reste) as reste,sum(payee) as payee,sum(somme) as somme           
from transferts join boutiques using(id_bo)
where reste<>0                       
group by id_bo, nom_bo,adr_bo order by nom_bo");

if($_SESSION['id_bo'] == 1 ) {
echo '<div id="colTwoc">';
echo '<table  align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">LISTE DE CREDITAIRES AGENCES  </h5></th></tr>';

echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<!-- <th>DATE</th> -->
		<th align="center">AGENCE</th>
		<th align="center">NB_ACHATS</th>
		<th align="right">SOMME_TOTAL</th>
		<th align="right">SOMME_PAYEE</th>
		<th align="right">SOMME_RESTE</th>
		<!-- <th>ETATS</th> -->';
		if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {	
		echo '<th class="lcentre">ACTION</th>';
		}
		echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat2))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
 	//echo '<td class="ldroite crouge">'.$ligne['id_fac'].'</td>';
	//echo '<td>'.$ligne['date_fac'].'</td>';
	echo '<td class="lcentre ">'.$ligne['nom_bo'].' '.$ligne['adr_bo'].'</td>';
	echo '<td class="lcentre cnoire">'.$ligne['nb_achat'].' Fois</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
		
	if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {	
	echo '<td align="center"><a href="paie_ag.php?
										&nom_bo='.$ligne['nom_bo'].
										'&adr_bo='.$ligne['adr_bo'].
										 '&somme='.$ligne['somme'].
										  '&payee='.$ligne['payee'].
										   '&reste='.$ligne['reste'].
										 '&id_tr='.$ligne['id_tr'].
										 '&id_bo='.$ligne['id_bo'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">PAIEMENT</button></a></td>';
										 
	}
	/*echo '<td><a href="sup_fac.php?nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
										'&date_fac='.$ligne['date_fac'].
										'&client='.$client.
										 '&id_fac='.$ligne['id_fac'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
										 
	echo '<td><a href="cfac.php?id_fac='.$ligne['id_fac'].
												'&nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
												'&date_fac='.$ligne['date_fac'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'&client='.$client.
												'"><button id="myb"  class="ui-state-active ui-corner-all boutons">TRACE PAIEMENTS</button></a></td>';*/	
	
	echo '</tr>';
															
										$som_ta=$som_ta+$ligne['somme'];
										$som_pa=$som_pa+$ligne['payee'];
										$som_ra=$som_ra+$ligne['reste'];
	$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_ta,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_pa,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_ra,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td></td>';
		 	//echo '<td colspan="4" align="center"></td>';
			echo '</tr>';

echo '</table>';
echo '</div>';
}
?>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

