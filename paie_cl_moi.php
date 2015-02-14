<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
//$id_fac=isset($_GET['id_fac'])?$_GET['id_fac']:$_POST['id_fac'];
	$id_cl=$_GET['id_cl'];
	$nom_cl=$_GET['nom_cl'];
	$add_cl=$_GET['add_cl'];
	$tel1_cl=$_GET['tel1_cl'];
	$som_t=0;
	$som_p=0;
	$som_r=0;
?>
<div id="content">
<?php
include_once('sidebar.php');

	
	$role1=$_POST['role1'];
			if ($role1=='modag')
				include_once('update_ver_ag.php');
			if ($role1=='payercl')
				include_once('update_pai_cl.php');
			if ($role1=='supag')
				include_once('delete_ver_cl.php');

echo '<div id="colTwo">';
echo fan();
echo fpaie_cl($id_cl,$annee);

echo '<h1 align="center"><strong><em><pre>'.getPeriodes($mois).'</pre></em></strong></h1>';


$resultatb=pg_query($connexion, "SELECT * from banques order by nom_b,compte_banc");
$resultat1=pg_query($connexion, "SELECT  extract(month from now()::date) as dte1,extract(year from now()::date) as dte2");
$datej=pg_fetch_assoc($resultat1);

if($datej['dte2'] <= $annee) {
if($datej['dte1'] <= $mois) {
echo '<table align="center" style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
	echo '<form action="" method="post">';
	echo '<tr>';
		echo '<th class="header3 ldroite">SOMME A PAYEE</th>';
			echo '<td>
			<input type="text" name="reste" size="20" class="text header1 ui-corner-all" value="0" />
			</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<th class="header3 ldroite">MOTIFS</th>';
			echo '<td>
			<input type="text" name="motif" size="20" class="text header1 ui-corner-all" value="ESPECE" />
			</td>';
	echo '</tr>';
		
	echo '<tr>';
		echo '<th class="header3 ldroite">DATE</th>';
			echo '<td>
				<input type="text" name="date_facp" size="20" class="text header1 ui-corner-all" value="'.(date('d/m/Y H:i:s')).'" />
			</td>';
	echo '</tr>';

	echo '<tr><td collspan="2"></td></tr>';
	echo '<tr>';
		echo '<td></td>';
	echo '<td style="text-align: right;">
	<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';"/>
	<input type=hidden name="id_cl" value="'.$id_cl.'">
	<input type=hidden name="role1" value="payercl" />
	</form>	
	
	<a href="paie_ag_cl.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Retour</button>
	</a>
	</td>';
	echo '</tr>';
	
echo '</table><br>';
}
}

$resultat=pg_query($connexion, "SELECT id_fac,id_facp,(date_facp)::date as dte,date_facp,motif,montant 
                                   from facpaiement 
											  where id_cl=$id_cl   and extract(month from date_facp)=$mois  
											  and extract(year from date_facp)=$annee order by date_facp desc
													");

$rdate=pg_query($connexion, "SELECT  now()::date as dtej");
$datejj=pg_fetch_assoc($rdate);

$rmois=pg_query($connexion, "select count(*) as nb from facpaiement  
                                where id_cl=$id_cl
                                and extract(month from date_facp)=$mois
                                and extract(year from date_facp)=$annee 
                                ");

$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
			echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">VERSEMENT EFFECTUEE</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th  class="lcentre">DATE</th>';
			echo	'<th  class="lcentre">transferts N</th>';
			echo	'<th colspan="2" class="lcentre">MOTIFS</th>';
		  // echo	'<th colspan="2" class="lcentre">BANQUE</th>';
			echo	'<th colspan="2" class="ldroite">MONTANT</th>';
			echo	'<th colspan="2" class="lcentre">ACTION</th>';
			echo	'</tr>';

$i=1;
while ($ligne=pg_fetch_assoc($resultat))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td >'.$ligne['date_facp'].'</td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['id_fac'],0,' ',' ').'</td>';
	echo '<td colspan="2" class="lcentre">'.$ligne['motif'].'</td>';
	//echo '<td colspan="2" class="lcentre">'.$ligne['nom_b'].' '.$ligne['compte_banc'].'</td>';
	echo '<td colspan="2" class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
   if($_SESSION['gid'] == 1000 ) {	
	echo '<td><a href="mod_paicl.php?date_facp='.$ligne['date_facp'].
										'&id_cl='.$id_cl.
										'&motif='.$ligne['motif'].
										 '&montant='.$ligne['montant'].
										 '&id_facp='.$ligne['id_facp'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
			}
	else {
		if($datejj['dtej'] <= $ligne['dte']) {	
		echo '<td><a href="sup_paicl.php?date_facp='.$ligne['date_facp'].
										'&nom_b='.$ligne['nom_b'].
										'&compte_banc='.$ligne['compte_banc'].
										'&montant='.$ligne['montant'].
										'&motif='.$ligne['motif'].
										'&id_cl='.$id_cl.
										'&annee='.$annee.
										'&mois='.$mois.
										'&bar='.$bar.
										'&id_facp='.$ligne['id_facp'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
										 
			}
		else {echo '<td></td>';}
		}
			if($_SESSION['gid'] ==1000) {							 
			echo '<td><a href="sup_paicl.php?date_facp='.$ligne['date_facp'].
										'&nom_b='.$ligne['nom_b'].
										'&compte_banc='.$ligne['compte_banc'].
										'&montant='.$ligne['montant'].
										'&motif='.$ligne['motif'].
										'&id_cl='.$id_cl.
										'&annee='.$annee.
										'&mois='.$mois.
									    '&bar='.$bar.
										'&id_facp='.$ligne['id_facp'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
			
			}
			else {echo '<td></td>';}	
	
	echo '</tr>';
	$som_t=$som_t+$ligne['montant'];
	$i++;
	}			
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="5" align="center"><strong>TOTAL</strong></td>';
			echo '<td colspan="2" class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>';
			echo '<td></td><td></td>'; 
			echo '</tr>';
echo '</table>';
}
else { 
echo '<div style="text-align: center"><h2><strong>Pas de versement pour client(e) dans ce mois!!!!</strong></h2></div>';

}
?>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
