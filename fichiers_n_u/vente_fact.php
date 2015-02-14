<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>

<?php
include_once('header.php');
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
	<h1 align="center"><strong>LISTE DES VENTES</strong></h1>
		<?php
		$som=0;
		
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_fac.php');
			//if ($role1=='ajouter')
			//	include_once('insert_fac.php');
			if ($role1=='supprimer')
				include_once('delete_fac.php');
			
$resultat=pg_query($connexion, "SELECT * from facture order by date_fac desc");
echo '<table  align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr  class="header3 bw">
			<td colspan="9">
				<a href="ajo_fac.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>
			</td>
		</tr>';
echo '<tr class="header2 lgauche bw">
		<th>N°</th>
		<th>DATE</th>
		<th>CLIENT</th>
		<th>SOMME_TOTAL</th>
		<th>SOMME_PAYEE</th>
		<th>SOMME_RESTE</th>
		<th colspan="3" class="lcentre">ACTION</th>
		<!-- <th>CONTENUE</th> --></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['date_fac'].'</td>';
	echo '<td>'.$ligne['client'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').' <sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
	//if($ligne['etat_fac']=='0') 
		//	echo '<td>Non Livrée</td>';
//	if($ligne['etat_fac']=='1')
	//		echo '<td>Partielment Livrée</td>';
	//if($ligne['etat_fac']=='2')
		//	echo '<td>Totalment Livrée</td>';
		if($_SESSION['privilege'] == "admin") {	
	echo '<td><a href="mod_fac.php?date_fac='.$ligne['date_fac'].
										'&client='.$ligne['client'].
										 '&somme='.$ligne['somme'].
										 '&id_fac='.$ligne['id_fac'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button></a></td>';								 
	echo '<td><a href="sup_fac.php?client='.$ligne['client'].
										'&date_fac='.$ligne['date_fac'].
										 '&id_fac='.$ligne['id_fac'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
		}								 
	echo '<td><a href="cfac.php?id_fac='.$ligne['id_fac'].
												'&client='.$ligne['client'].
												'&date_fac='.$ligne['date_fac'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'"><button id="myb"  class="ui-state-active ui-corner-all boutons">CONTENUE</button></a></td>';	
	
	echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
	$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
			echo '<td align="right"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td colspan="3" align="center"></td>';
			echo '</tr>';
echo '<tr  class="header3 bw">
			<td colspan="9">
				<a href="ajo_fac.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE VENTE</button>
				</a>
			</td>
		</tr>';
echo '</table>';

?>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

