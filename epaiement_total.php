<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
include_once('update_pay_em.php');
//$mois=$_GET['mois'];
$EDATE=(date('Y'));
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
$som_1=0;$som_2=0;$som_3=0;$som_4=0;$som_5=0;$som_6=0;$som_7=0;$som_8=0;$som_9=0;$som_10=0;$som_11=0;
$som_12=0;
$som_m=0;
$som_p=0;
$som_r=0;
	
	?>

	<div id="colTwo">
	<?php
echo fan();
echo fmois_emp($annee);


$resultat=pg_query($connexion, "SELECT * FROM employer order by nom_em, prenom_em");
echo '<table align="center" style="width:99%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
			<th rowspan="2">N°</th>
			<th colspan="2">EMPLOYES</th>
			<th colspan="12">'.$annee.'</th>
			<th rowspan="2">MONTANT</th>
			<th rowspan="2">SOMME-PAYEE</th>
			<th rowspan="2">SOMME-RESTE</th>
		</tr>';
echo '<tr class="header2 bw">
			
			<th>NOM</th>
			<th>PRENOM</th>
			<th>Jan</th>
			<th>Fev</th>
			<th>Mar</th>
			<th>Avr</th>
			<th>Mai</th>
			<th>Jui</th>
			<th>Jui</th>
			<th>Aou</th>
			<th>Sep</th>
			<th>Oct</th>
			<th>Nov</th>
			<th>Dec</th>
			<!-- <th>ACTION</th> -->
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['nom_em'].'</td>';
			echo '<td>'.$ligne['prenom_em'].'</td>';
			
			$id_em=$ligne['id_em'];
			$som_t=0;
			$som_p=0;
			$resultat2=pg_query($connexion, "SELECT mois, emontant, payee from 
			epaiement  where annee=$annee and id_em=$id_em order by mois");
			while ($ligne2=pg_fetch_assoc($resultat2))
			{
				echo '<td align="right">'.number_format($ligne2['emontant'],0,'','').'<sup>F</sup></td>';
				$som_t+=$ligne2['emontant'];
				$som_p+=$ligne2['payee'];
			}	
			echo '<td align="right"><strong>'.number_format($som_t,0,' ',' ').'<sup>F</sup></strong></td>';
			echo '<td class="ldroite crouge">'.number_format($som_p,0,' ',' ').'<sup>F</sup></td>';
			echo '<td class="ldroite cbleu">'.number_format($som_t-$som_p,0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;			
}
/*echo '<tr>';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right">'.number_format($som_1,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_2,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_3,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_4,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_5,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_6,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_7,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_8,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_9,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_10,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_11,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($som_12,0,' ',' ').'<sup>F</sup></td>'; 
			echo '<td align="right">'.number_format($som_m,0,' ',' ').'<sup>F</sup></td>'; 
			echo '<td align="right">'.number_format($som_p,0,' ',' ').'<sup>F</sup></td>'; 
			echo '<td align="right">'.number_format($som_r,0,' ',' ').'<sup>F</sup></td>'; 
			 
			echo '</tr>';*/
echo '</table>';
?>
<!-- <a href="epaiement.php"><input type="button" name="retour" value="PAIEMENT PERIODIQUE" /></a> -->

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

