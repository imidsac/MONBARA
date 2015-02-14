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
echo fmois_tr($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>
	
<?php
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';





echo '<form action="vente_tr_moir2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post">';
	echo '<tr><th class="header3 ldroite">RECHERCHE</th><td colspan="6"><input type="text" name="dater" size="80" class="text header1 ui-corner-all" /></td>';
	echo  '</tr>';
	echo '<tr>
	<td>
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	
	</form>
	<td>
	<a href="vente_tr_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
	</td>
	</tr>';
	
	echo '</table>';

		$som=0;
		
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_tr.php');
			//if ($role1=='ajouter')
			//	include_once('insert_tr.php');
			if ($role1=='supprimer')
				include_once('delete_tr.php');
			
$resultat=pg_query($connexion, "SELECT transferts.*,nom_bo,adr_bo from transferts join boutiques using(id_bo)
where extract(year from date_tr)=extract(year from '$_POST[dater]'::date)
and extract(month from date_tr)=extract(month from '$_POST[dater]'::date)
and extract(day from date_tr)=extract(day from '$_POST[dater]'::date)
order by date_tr desc");
$rmois=pg_query($connexion, "SELECT count(*) as nb from transferts
where extract(year from date_tr)=extract(year from '$_POST[dater]'::date)
and extract(month from date_tr)=extract(month from '$_POST[dater]'::date)
and extract(day from date_tr)=extract(day from '$_POST[dater]'::date) ");

$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {
echo '<h1 align="center"><strong>LISTE DES TRANSFERTS</strong></h1>';
echo '<table  align="center" style="width:99%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo '<tr  class="header3 bw">
			<td colspan="11">
				<a href="ajo_tr.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE TRANSFERT</button>
				</a>
			</td>
		</tr>';
		}
echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<th>DATE</th>
		<th>AGENCE</th>
		<th align="right">SOMME_TOTAL</th>
		<th align="right">SOMME_PAYEE</th>
		<th align="right">SOMME_RESTE</th>
		<th align="center">ETATS</th>';
      //if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
		echo '<th colspan="3" class="lcentre">ACTION</th>';
		echo '<!-- <th>CONTENUE</th> --></tr>';
		//}
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	//echo '<td>'.$i.'</td>';
 	echo '<td class="ldroite crouge">'.$ligne['id_tr'].'</td>';
	echo '<td>'.$ligne['date_tr'].'</td>';
	echo '<td>'.$ligne['nom_bo'].' '.$ligne['adr_bo'].'</td>';
	//echo '<td>'.$ligne['prenom_bo'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
	if($ligne['etat_tr']=='n') 
		echo '<td class="lcentre crouge">N-Livrai</td>';
	else if($ligne['etat_tr']=='p')
		echo '<td class="lcentre cbleu">P-Livrai</td>';
	else 
		echo '<td class="lcentre cnoire">T-Livrai</td>';
		
	if($_SESSION['gid'] == 1000 ) {		
	echo '<td><a href="mod_tr.php?date_tr='.$ligne['date_tr'].
										'&nom_bo='.$ligne['nom_bo'].
										 '&somme='.$ligne['somme'].
										 '&id_tr='.$ligne['id_tr'].
										 '&id_bo='.$ligne['id_bo'].
										 '&mois='.$mois.
										 '&annee='.$annee.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button></a></td>';								 
	
	echo '<td><a href="sup_tr.php?nom_bo='.$ligne['nom_bo'].
										'&date_tr='.$ligne['date_tr'].
										'&mois='.$mois.
										'&annee='.$annee.
										 '&bar='.$bar.
										 '&id_tr='.$ligne['id_tr'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
	}
									 
	echo '<td><a href="ctr.php?id_tr='.$ligne['id_tr'].
												'&nom_bo='.$ligne['nom_bo'].
												'&date_tr='.$ligne['date_tr'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'&mois='.$mois.
												'&annee='.$annee.
										        '&bar='.$bar.
												'"><button id="myb"  class="ui-state-active ui-corner-all boutons">CONTENUE</button></a></td>';	
	
	echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
	//$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td colspan="4" align="center"></td>';
			echo '</tr>';
if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo '<tr  class="header3 bw">
			<td colspan="11">
				<a href="ajo_tr.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE TRANSFERT</button>
				</a>
			</td>
		</tr>';
		}
echo '</table>';
}
else { 
echo '<div style="text-align: center"><h2><strong>Pas des sorties dans cette mois!!!!</strong></h2></div>';
echo '<a href="ajo_tr.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE TRANSFERT</button>
				</a>';
} 
?> 
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

