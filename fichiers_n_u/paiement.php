<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>

<?php
include_once('connection.php');
include_once('header.php');
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
	<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
	<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">PAIEMENTS <?php echo $EDATE ?></h5></th></tr>
	<tr class="header3 bw">
			
				<td><a href="paiement_moi.php?mois=1">Janvier</a></td>
				<td><a href="paiement_moi.php?mois=2">Fevrier</a></td>
				<td><a href="paiement_moi.php?mois=3">Mars</a></td>
				<td><a href="paiement_moi.php?mois=4">Avril</a></td>
				<td><a href="paiement_moi.php?mois=5">Mai</a></td>
				<td><a href="paiement_moi.php?mois=6">Juin</a></td>
				<td><a href="paiement_moi.php?mois=7">Juillet</a></td>
				<td><a href="paiement_moi.php?mois=8">Août</a></td>
				<td><a href="paiement_moi.php?mois=9">Septembre</a></td>
				<td><a href="paiement_moi.php?mois=10">Octobre</a></td>
				<td><a href="paiement_moi.php?mois=11">Novembre</a></td>
				<td><a href="paiement_moi.php?mois=12">Decembre</a></td>
				<!-- <td><a href="vente_fac_total.php">Annuaire</a></td> -->
			</tr>
</table>



	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

