<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
//include_once('update_pay_em.php');

?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
$som_m=0;
$som_p=0;
$som_r=0;
	
	?>

	<div id="colTwo">
<?php
echo fan();
echo fmois_emp($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>

<?php

$resultat=pg_query($connexion, "SELECT id_ep, id_em,nom_em, prenom_em, emontant, payee, (emontant-payee) as reste 
from epaiement join employer using(id_em) 
where annee=$annee 
and mois=$mois order by nom_em, prenom_em");
echo '<a href="/html2pdf/pdf/pemployer.php?&mois='.$mois.
                                    '&annee='.$annee.
												'" title="paiements: '.getPeriodes($mois).'">
												<img src="images/pdf/pdf.png" width="3%" height="5%" alt="" align="right" border="0" />												
												</a>';
echo '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
			<th>N°</th>
			<th align="left">NOM</th>
			<th align="left">PRENOM</th>
			<th align="right">SALAIRE DE BASE</th>
			<th  align="right">AVANCE SUR SALAIRE</th>
			<th  align="right">SALAIRE NET A PAYEE</th>';
			if($_SESSION['gid'] == 5 || $_SESSION['gid'] ==1000) {
			echo '<th>ACTION</th>';
			}
		echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['nom_em'].'</td>';
			echo '<td>'.$ligne['prenom_em'].'</td>';
			echo '<td align="right">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td class="ldroite crouge">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td class="ldroite cbleu">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			if($_SESSION['gid'] == 5 || $_SESSION['gid'] ==1000) {
			if($ligne['emontant']-$ligne['payee']!==0) 
				{
			echo '<td align="center">
								<a href="payee_em.php?id_ep='.$ligne['id_ep'].
								'&id_em='.$ligne['id_em'].
								'&nom_em='.$ligne['nom_em'].
								'&prenom_em='.$ligne['prenom_em'].
								'&emontant='.$ligne['emontant'].
								'&payee='.$ligne['payee'].
								'&reste='.$ligne['reste'].
								'&annee='.$annee.
								'&mois='.$mois.
								'&bar='.$bar.
								'"><button id="myb"  class="ui-state-active ui-corner-all boutons">PAIEMENT</button></a></td>';
				}
					else { echo '<td align="center"><a href="payee_em.php?id_ep='.$ligne['id_ep'].
								'&id_em='.$ligne['id_em'].
								'&nom_em='.$ligne['nom_em'].
								'&prenom_em='.$ligne['prenom_em'].
								'&emontant='.$ligne['emontant'].
								'&payee='.$ligne['payee'].
								'&reste='.$ligne['reste'].
								'&annee='.$annee.
								'&mois='.$mois.
								'&bar='.$bar.
								'"><button id="myb"  class="ui-state-active ui-corner-all boutons">TRACE DE PAIEMENT</button></a></td>';}
					}
			
			echo '</tr>';
			$i++;
			$som_m=$som_m+$ligne['emontant'];
			$som_p=$som_p+$ligne['payee'];
			$som_r=$som_r+$ligne['reste'];
			
}
echo '<tr class="header2 bw">';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($som_m,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td align="right"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td></td>';
			 
			echo '</tr>';
echo '</table>';
?>


	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

