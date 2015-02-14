<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

$som_t=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
<?php
echo fan();
echo fmois_dep($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>
	
<?php
      $role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_dep.php');
			if ($role1=='ajouter')
				include_once('insert_dep.php');
			if ($role1=='supprimer')
				include_once('delete_dep.php');
$resultat=pg_query($connexion, "SELECT id_dep,lib_dep,date_dep,crencier,beneficiere,montant,id_bo,nom_bo, 
(date_dep)::date as dte 
from depences join boutiques using(id_bo) 
where annee=$annee
and extract(month from date_dep)=$mois order by date_dep desc");
$rmois=pg_query($connexion, "SELECT count(*) as nb from depences 
where extract(year from date_dep)=$annee 
and extract(month from date_dep)=$mois");
$resultat1=pg_query($connexion, "SELECT now()::date as dte1");
$datej=pg_fetch_assoc($resultat1);
$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {

echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 lgauche bw">';
	if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {
			echo '<td colspan="9">
				<a href="ajo_dep.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter une depence</button>
				</a>
			</td>';
	}
echo '</tr>';
echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">LISTE DES DEPENCES</h5></th></tr>';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th>DESIGNATION</th>
			<th>CAISSIERE</th>
			<th>BENEFICIERE</th>
			<th>DATE</th>
			<th>MONTANT</th>
			<th>AGENCE</th>';
			//if($datej['dte1'] >= $ligne['dte'] || $_SESSION['gid'] ==1000) {
			echo '<th colspan="2" align="center">ACTION</th>';
			//}
			echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_dep'].'</td>';
	echo '<td>'.$ligne['crencier'].'</td>';
	echo '<td>'.$ligne['beneficiere'].'</td>';
	echo '<td>'.$ligne['date_dep'].'</td>';
	echo '<td align="right" class="ldroite crouge">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td>'.$ligne['nom_bo'].'</td>';
	if($_SESSION['gid'] ==1000) {			
	echo '<td>
	<a href="mod_dep.php?lib_dep='.$ligne['lib_dep'].
										 '&date_dep='.$ligne['date_dep'].
										 '&montant='.$ligne['montant'].
										 '&id_dep='.$ligne['id_dep'].
										 '&id_bo='.$ligne['id_bo'].
										 '&crencier='.$ligne['crencier'].
										 '&beneficiere='.$ligne['beneficiere'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
	echo '<td>
	<a href="sup_dep.php?lib_dep='.$ligne['lib_dep'].
										'&date_dep='.$ligne['date_dep'].
										 '&id_dep='.$ligne['id_dep'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	}
	else {
		if($datej['dte1'] <= $ligne['dte']) {
			echo '<td>
	<a href="mod_dep.php?lib_dep='.$ligne['lib_dep'].
										 '&date_dep='.$ligne['date_dep'].
										 '&montant='.$ligne['montant'].
										 '&id_dep='.$ligne['id_dep'].
										 '&id_bo='.$ligne['id_bo'].
										 '&crencier='.$ligne['crencier'].
										 '&beneficiere='.$ligne['beneficiere'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
		echo '<td>
	<a href="sup_dep.php?lib_dep='.$ligne['lib_dep'].
										'&date_dep='.$ligne['date_dep'].
										 '&id_dep='.$ligne['id_dep'].
										 '&annee='.$annee.
										 '&mois='.$mois.
										 '&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
		}
		else {echo '<td></td><td></td>';}
		}
	/*if($_SESSION['gid'] ==1000) {
									 
	echo '<td>
	<a href="sup_dep.php?lib_dep='.$ligne['lib_dep'].
										'&date_dep='.$ligne['date_dep'].
										 '&id_dep='.$ligne['id_dep'].
										 '&mois='.$mois.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	}*/
	echo '</tr>';
	$som_t=$som_t+$ligne['montant'];
	$i++;
	}
echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="4" align="center"><strong>TOTAL</strong></td>';
			echo '<td colspan="2" class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			if($_SESSION['privilege'] == "admin") {			 	
		 	echo '<td colspan="3" align="center"></td>';
		 	}
			echo '</tr>';
			if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {
echo '<tr class="header3 lgauche bw"><td colspan="9"><a href="ajo_dep.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter une depence</button></a></td></tr>';
}
echo '</table>';
}
else { 
echo '<div style="text-align: center"><h2><strong>Pas des depences dans cette mois!!!!</strong></h2></div>';
if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {
echo '<a href="ajo_dep.php?&mois='.$mois.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter une depence</button>
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

