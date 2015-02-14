<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$id_fo=$_GET['id_fo'];
$id_ac=$_GET['id_ac'];
$nom_fo=$_GET['nom_fo'];
$date_2=$_GET['date_2'];
$reste=$_GET['reste'];
$somme=$_GET['somme'];
$payee=$_GET['payee'];

?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>PAIEMENT</strong></em></h1>


<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">FOURNISSEUR </th>';
echo '<td>'.$nom_fo.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE DE LIVRAISON </th>';
echo '<td>'.$date_2.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">SOMME-TOTAL </th>';
echo '<td class="ldroite crouge"><strong>'.number_format($somme,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';

echo '</table>';
echo '<br>';
?>

<?php

$resultat=pg_query($connexion, "SELECT date_fp,motif,montant 
from fpaiement where id_fo=$id_fo and id_ac=$id_ac ");
echo '<table align="center" style="width:40%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th>DATE</th>
			<th>MOTIFS</th>
			<th>MONTANT</th>
			
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['date_fp'].'</td>';
			echo '<td>'.$ligne['motif'].'</td>';
			echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			
			echo '</tr>';
			$i++;
			
}
echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($payee,0,' ',' ').'</strong><sup>F</sup></td>'; 
			
			echo '</tr>';
echo '</table>';
?>

<!-- <hr align="left" size="2" width="100%" noshade="noshade" /> -->
<?php if($reste!=0){ ?>
<table align="center" style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<form action="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" method="post">
	<tr>
		<th class="header3 ldroite">RESTE A PAYEE</th>
			<td>
			<input type="text" name="reste" size="20" class="text header1 ui-corner-all" 
			value="<?php echo $_GET['reste']?>" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">MOTIFS</th>
			<td>
			<input type="text" name="motif" size="20" class="text header1 ui-corner-all" 
			value="ESPECE" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_fp" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
	<input type="hidden" name="id_ac" value="<?php echo $id_ac?>">
	<input type="hidden" name="id_fo" value="<?php echo $id_fo?>">
	<input type="hidden" name="id_bo" value="<?php echo $uti?>">
	<input type="hidden" name="role1" value="payer" />
	</form></td>	
	<td><a href="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
	</a></td>
	</tr>
	
<?php } ?>
</table>	
<hr align="right" size="2" noshade="noshade" />		
<a href="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Retoure</button></a>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
