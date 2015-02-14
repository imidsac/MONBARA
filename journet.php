<?php
include_once('header.php');
include_once('connection.php');
$EDATE=2012; 
?>
<div id="content">
<?php
include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
$som_d=0;
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
?>
<div id="colTwo">
<h1 align="center"><strong>Les retours d'aujourd'hui</strong></h1>
	
<?php
$resultat1=pg_query($connexion, "SELECT distinct somme, payee, reste from facture where extract(month from date_fac)=10 and extract(day from date_fac)=18");
$resultat2=pg_query($connexion, "SELECT * from achat where extract(month from date_1)=10 and extract(day from date_1)=18");
$resultat3=pg_query($connexion, "SELECT * from depences where extract(month from date_dep)=10 and extract(day from date_dep)=18");

$rr=pg_fetch_assoc($resultat1);
$som_a=$som_a+$rr['somme'];
$som_v=$som_v+$rr['payee'];
$som_d=$som_d+$rr['reste'];

echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
		
			<th colspan="3" align="center"><h1>ENTREES</h1></th>
			
		</tr>';
echo '<tr class="header2 bw">
		
			<th >TOTAL</th>
			<th >PAYEE</th>
			<th >RESTE</th>		
			
		</tr>';
echo '</table>';

echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
		
			<th colspan="3" align="center"><h1>DEPENCES</h1></th>
			
		</tr>';
echo '<tr class="header2 bw">
		
			<th >TOTAL</th>		
			
		</tr>';
echo '</table>';

echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
		
			<th colspan="3" align="center"><h1>SORTIES</h1></th>
			
		</tr>';
echo '<tr class="header2 bw">
		
			<th >TOTAL</th>
			<th >PAYEE</th>
			<th >RESTE</th>		
			
		</tr>';
echo '</table>';

echo '</table>';

/*echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 bw">
		
			<th colspan="3" align="center">RECETTES TOTALES</th>
			<th colspan="3" align="center">DEPENCES TOTALES</th>
			<th align="center">BENEFICES TOTALES</th>
			
		</tr>';

echo '</table>';*/

?>
<!-- <a href="benefice.php"><input type="button" name="retour" value="BILLAN PERIODIQUE" /></a> -->
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
