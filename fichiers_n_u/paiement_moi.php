<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru");
}
?>

<?php
include_once('connection.php');
include_once('header.php');
//$mois=$_GET['mois'];
$EDATE=(date('Y'));
switch($mois) {
	case 1: $nom_mois='Janvier'; break;
	case 2: $nom_mois='Fevrier'; break;
	case 3: $nom_mois='Mars'; break;
	case 4: $nom_mois='Avril'; break;
	case 5: $nom_mois='Mai'; break;
	case 6: $nom_mois='Juin'; break;
	case 7: $nom_mois='Juillet'; break;
	case 8: $nom_mois='Août'; break;
	case 9: $nom_mois='Septembre'; break;
	case 10: $nom_mois='Octobre'; break;
	case 11: $nom_mois='Novembre'; break;
	case 12: $nom_mois='Decembre'; break;
	
	}
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
where facture.id_bo=$uti 
and extract(year from date_fac)=f_annee() 
and extract(month from date_fac)=$mois 
group by id_cl, nom_cl, prenom_cl order by nom_cl, prenom_cl");
/*$rclient=pg_query($connexion, "SELECT count(*) as nb from facture 
where extract(year from date_fac)=f_annee() 
and extract(month from date_fac)=$client and id_bo=$uti ");

$rr=pg_fetch_assoc($rclient);
if($rr['nb']!=0) {*/

echo '<div id="colTwoh">';
?>
<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
	<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">PAIEMENTS <?php echo $EDATE ?> </h5></th></tr>
	<tr class="header3 bw">
			
				<td><a href="paiement_moi.php?mois=1">Janvier</a></td>
				<td><a href="paiement_moi.php?mois=2">Fevrier</a></td>
				<td><a href="paiement_moi.php?mois=3">Mars</a></td>
				<td><a href="paiement_moi.php?mois=4">Avril</a></td>
				<td><a href="paiement_moi.php?mois=5">Mai</a></td>
				<td><a href="paiement_moi.php?mois=6">Juin</a></td>
				<td><a href="paiement_moi.php?mois=7">Juillet</a></td>
				<td><a href="paiement_moi.php?mois=8">Août</a></td>
				<td><a href="paiement_moi.php?mois=9">Septembre</a></td>
				<td><a href="paiement_moi.php?mois=10">Octobre</a></td>
				<td><a href="paiement_moi.php?mois=11">Novembre</a></td>
				<td><a href="paiement_moi.php?mois=12">Decembre</a></td>
				<!-- <td><a href="vente_fac_total.php">Annuaire</a></td> -->
			</tr>
</table>
<h1 align="center"><strong><em><pre><?php echo $nom_mois ?> </pre></em></strong></h1>
<?php 

echo '<table  align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">PAIEMENTS DES CLIENTS   </h5></th></tr>';

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
	echo '<td align="center"><a href="paiement_cl.php?date_fac='.$ligne['date_fac'].
										'&nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										'&nb_achat='.$ligne['nb_achat'].
										 '&somme='.$ligne['somme'].
										  '&payee='.$ligne['payee'].
										   '&reste='.$ligne['reste'].
										 '&id_cl='.$ligne['id_cl'].
										 '&mois='.$mois.
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
		 	echo '<td colspan="4" align="center"></td>';
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

$resultat2=pg_query($connexion, "SELECT id_bo,nom_bo, sum(reste) as reste, sum(payee) as payee,sum(somme) as somme 
from transferts join boutiques using(id_bo) 
where extract(year from date_tr)=f_annee() 
and reste<>0
group by id_bo, nom_bo order by nom_bo");

if($_SESSION['id_bo'] == 1 ) {
echo '<div id="colTwoc">';
echo '<table  align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">PAIEMENTS DES AGENCES  </h5></th></tr>';

echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<!-- <th>DATE</th> -->
		<th align="center">AGENCE</th>
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
	echo '<td class="lcentre ">'.$ligne['nom_bo'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
		
	if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {	
	echo '<td align="center"><a href="paiement_ag.php?
										&nom_bo='.$ligne['nom_bo'].
										 '&somme='.$ligne['somme'].
										  '&payee='.$ligne['payee'].
										   '&reste='.$ligne['reste'].
										 '&id_tr='.$ligne['id_tr'].
										 '&id_bo='.$ligne['id_bo'].
										 '&mois='.$mois.
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
			echo '<td colspan="2" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_ta,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_pa,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_ra,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td colspan="4" align="center"></td>';
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

