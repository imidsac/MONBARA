<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$EDATE=(date('Y'));
//$mois=$_GET['mois'];
?>

<div id="content">
	<!-- <h1 align="center"><em><strong>PERIODES</strong></em></h1> -->
	<?php
	include_once('sidebar.php');
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
$som_t=0;
$som_p=0;
$som_r=0;
	?>

	<div id="colTwo">
<?
if($_SESSION['gid'] ==1000) {
?>
	<table align="center">
<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">ACHATS MATERIELS <?php echo $EDATE ?></h5></th></tr>
</table>
	<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
				<!-- <h2 align="center">periodes</h2> -->
				<!-- <h1 align="center"><strong>ACHATS MATERIELS <?php echo $EDATE ?></strong></h1> -->
	
	<tr class="header3 bw">
			
				<td><a href="machat2.php?mois=1">Janvier</a></td>
				<td><a href="machat2.php?mois=2">Fevrier</a></td>
				<td><a href="machat2.php?mois=3">Mars</a></td>
				<td><a href="machat2.php?mois=4">Avril</a></td>
				<td><a href="machat2.php?mois=5">Mai</a></td>
				<td><a href="machat2.php?mois=6">Juin</a></td>
				<td><a href="machat2.php?mois=7">Juillet</a></td>
				<td><a href="machat2.php?mois=8">Août</a></td>
				<td><a href="machat2.php?mois=9">Septembre</a></td>
				<td><a href="machat2.php?mois=10">Octobre</a></td>
				<td><a href="machat2.php?mois=11">Novembre</a></td>
				<td><a href="machat2.php?mois=12">Decembre</a></td>
				<!-- <td><a href="vente_fac_total.php">Annuaire</a></td> -->
			</tr>
</table>

<?
}
else {
echo '<table align="center">
<tr>
<tr></tr>
<td align="center" class="titre00"><blink>Vous n\'avez pas le droit</blink></td>
</tr>

<tr><td align="center" class="titre00"><blink>pour acceder le contenu!!!</blink></td></tr>

</table>';
}
?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

