<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
	
	?>

	<div id="colTwo">
	<?php
     echo fan();
     echo fmois_balance($annee);

	?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>

		<div align="center" class="myborder" id="myb">
				<!-- <ul class="myborder">
					<a href="#brec"><button id="myb"  class="ui-state-active ui-corner-all boutons"><h4>Les Recettes</h4></button></a>
					<a href="#bdep"><button id="myb"  class="ui-state-active ui-corner-all boutons"><h4>Les Depenses</h4></button></a>
				</ul> -->
		
<?php
/*$resultat=pg_query($connexion, "SELECT lib_ar, type_ar,nom_fo, achat, vente, benefice 
from benefices 
join articles using(id_ar) 
join fournisseur using(id_fo) 
where mois=$mois and (achat<>0 or vente<>0 ) 
order by lib_ar");*/

$resultat=pg_query($connexion, "SELECT * from benefices_total
 where annee=$annee and mois=$mois and id_bo=$uti ORDER BY mois");
//$ligne['mois']=$s_mois;
echo '<table align="center" style="width:60%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
			<th>N°</th>
			<th>ANNEE</th>
			<th>MOIS</th>
			<th>CHARGES</th>
			<th>ACHATS</th>
			<th>VENTES</th>
			<th>BENEFICES</th>
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['annee'].'</td>';
			echo '<td>'.$ligne['mois'].'</td>';
			echo '<td align="right" class="ldroite crouge">'.number_format($ligne['depence'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right" class="ldroite crouge">'.number_format($ligne['achat'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right" class="ldroite cbleu">'.number_format($ligne['vente'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($ligne['benefice'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;
			$som_b=$som_b+$ligne['benefice'];
			$som_a=$som_a+$ligne['achat'];
			$som_v=$som_v+$ligne['vente'];
			$som_d=$som_d+$ligne['depence'];
}
echo '<tr  class="header2 bw">';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($som_d,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_a,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_v,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_b,0,' ',' ').'</strong><sup>F</sup> </td>'; 
			echo '</tr>';
echo '</table>';
?>


	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

