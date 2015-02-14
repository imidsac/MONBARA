<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$EDATE=(date('Y'))
?>
<div id="content">
<?php
include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
$som_d=0;

?>
<div id="colTwo">
<?php
     echo fan();
     echo fmois_balance($annee);

	?>

	<h1 align="center"><em><strong>Annuaire</strong></em></h1>
<?php
$resultat=pg_query($connexion, "SELECT * from benefices_total 
where annee=$annee and id_bo=$uti ORDER BY mois");
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
			<th>ANNEE</th>
			<th>MOIS</th>
			<th align="right">CHARGES</th>
			<th align="right">ACHATS</th>
			<th align="right">VENTES</th>
			<th align="right">BENEFICES</th>
		</tr>';
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$ligne['annee'].'</td>';
			echo '<td>'.$ligne['mois'].'</td>';
			echo '<td align="right" class="ldroite crouge">'.number_format($ligne['depence'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right" class="ldroite crouge">'.number_format($ligne['achat'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right" class="ldroite cbleu">'.number_format($ligne['vente'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($ligne['benefice'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$som_b=$som_b+$ligne['benefice'];
			$som_a=$som_a+$ligne['achat'];
			$som_v=$som_v+$ligne['vente'];
			$som_d=$som_d+$ligne['depence'];
}
echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="2"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($som_d,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_a,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_v,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_b,0,' ',' ').'</strong><sup>F</sup> </td>'; 
			echo '</tr>';
echo '</table>';
?>
<!-- <a href="benefice.php"><input type="button" name="retour" value="BILLAN PERIODIQUE" /></a> -->
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
