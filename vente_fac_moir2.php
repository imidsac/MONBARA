<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');


$som_t=0;
$som_p=0;
$som_r=0;

?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
<?php
echo fan();
echo fmois_fac($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>



<?php
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';

echo '<form action="vente_fac_moir2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post">';
	echo '<tr><th class="header3 ldroite">RECHERCHE</th><td colspan="6"><input type="text" name="dater" size="80" class="text header1 ui-corner-all" /></td>';
	echo  '</tr>';
	echo '<tr>
	<td>
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	
	</form>
	<td>
	<a href="vente_fac_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
	</td>
	</tr>';
	
	echo '</table>';

		$som=0;
		
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_fac.php');
			//if ($role1=='ajouter')
			//	include_once('insert_fac.php');
			if ($role1=='supprimer')
				include_once('delete_fac.php');
			
$resultat=pg_query($connexion, "SELECT facture.*,nom_cl,prenom_cl,add_cl, tel1_cl from facture join clients using(id_cl)
where extract(year from date_fac)=extract(year from '$_POST[dater]'::date)
and extract(month from date_fac)=extract(month from '$_POST[dater]'::date)
and extract(day from date_fac)=extract(day from '$_POST[dater]'::date)
and facture.id_bo=$uti 
order by date_fac desc");
$rmois=pg_query($connexion, "SELECT count(*) as nb from facture 
where extract(year from date_fac)=extract(year from '$_POST[dater]'::date)
and extract(month from date_fac)=extract(month from '$_POST[dater]'::date)
and extract(day from date_fac)=extract(day from '$_POST[dater]'::date) and id_bo=$uti ");

$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {
echo '<h1 align="center"><strong>LISTE DES VENTES</strong></h1>';
echo '<table  align="center" style="width:99%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr  class="header3 bw">';
		if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
			echo '<td colspan="11">
				<a href="ajo_fac.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>
			</td>';
			}
echo '</tr>';
echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<th align="center">DATE</th>
		<th colspan="2" align="center">CLIENT</th>
		<th align="right">SOMME_TOTAL</th>
		<th align="right">SOMME_PAYEE</th>
		<th align="right">SOMME_RESTE</th>
		<th align="center">ETATS</th>';
		//if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo '<th colspan="3" class="lcentre">ACTION</th>';
			//}
echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	//echo '<td>'.$i.'</td>';
 	echo '<td class="ldroite crouge">'.$ligne['id_fac'].'</td>';
	echo '<td>'.$ligne['date_fac'].'</td>';
	echo '<td>'.$ligne['nom_cl'].'</td>';
	echo '<td>'.$ligne['prenom_cl'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
	if($ligne['etat_fac']=='n') 
		echo '<td class="lcentre crouge">N-Livrai</td>';
	else if($ligne['etat_fac']=='p')
		echo '<td class="lcentre cbleu">P-Livrai</td>';
	else 
		echo '<td class="lcentre cnoire">T-Livrai</td>';
		
	if($_SESSION['gid'] == 1000 ) {		
	echo '<td><a href="mod_fac.php?date_fac='.$ligne['date_fac'].
										'&nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										 '&somme='.$ligne['somme'].
										 '&id_fac='.$ligne['id_fac'].
										 '&id_cl='.$ligne['id_cl'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button></a></td>';
									 
	
	echo '<td><a href="sup_fac.php?nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
										'&date_fac='.$ligne['date_fac'].
										'&annee='.$annee.
										'&mois='.$mois.
										'&bar='.$bar.
										 '&id_fac='.$ligne['id_fac'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
	}
	
										 
	echo '<td><a href="cfac.php?id_fac='.$ligne['id_fac'].
												'&nom_cl='.$ligne['nom_cl'].
												'&prenom_cl='.$ligne['prenom_cl'].
												'&add_cl='.$ligne['add_cl'].
												'&tel1_cl='.$ligne['tel1_cl'].
												'&date_fac='.$ligne['date_fac'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'&annee='.$annee.
												'&mois='.$mois.
												'&bar='.$bar.
												'"><button id="myb"  class="ui-state-active ui-corner-all boutons">CONTENUE</button></a></td>';	
	
	echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
	//$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="4" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td colspan="4" align="center"></td>';
			echo '</tr>';
echo '<tr  class="header3 bw">';
		if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
			echo '<td colspan="11">
				<a href="ajo_fac.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>
			</td>';
			}
echo '</tr>';
echo '</table>';
}
else { 
echo '<div style="text-align: center"><h2><strong>Pas des sorties dans cette mois!!!!</strong></h2></div>';
if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo '<a href="ajo_fac.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>';
} 
}
?> 
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

