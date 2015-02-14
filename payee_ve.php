<?php
include_once('header.php');
include_once('connection.php');
$id_ve=$_GET['id_ve'];
$client=$_GET['client'];
$date_ve=$_GET['date_ve'];
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
<form action="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
						&client=<?php echo $client?>
						&date_ve=<?php echo $date_ve?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>" method="post">
<?php
echo '<table cellpadding="10" cellspacing="0" border="1" align="left">';
echo '<tr>';
echo '<th>CLIENT </th>';
echo '<td>'.$client.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>DATE </th>';
echo '<td>'.$date_ve.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>SOMME-TOTAL </th>';
echo '<td align="right">'.number_format($somme,0,' ',' ').'<sup>F</sup></td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>

 <?php

$resultat=pg_query($connexion, "SELECT * from vpaiement where id_ve=$id_ve");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center">';
echo '<tr>
			<th>N°</th>
			<th>DATE</th>
			<th>MOTIFS</th>
			<th>MONTANT</th>
			
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['date_vp'].'</td>';
			echo '<td>'.$ligne['motif'].'</td>';
			echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			
			echo '</tr>';
			$i++;
			
}
echo '<tr>';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right">'.number_format($payee,0,' ',' ').'<sup>F</sup></td>'; 
			
			echo '</tr>';
echo '</table>';
?> 

<?php if($reste!=0){ ?>
<table cellpadding="0" cellspacing="0" border="0" align="center">
	
	<tr>
		<th>RESTE A PAYEE:</th>
			<td>
			<input type="text" name="reste" size="13" value="<?php echo $_GET['reste']?>" />
			</td>
	</tr>
	 <tr>
		<th>MOTIFS:</th>
			<td>
			<input type="text" name="motif" size="13" value="ESPECE" />
			</td>
	</tr>
	<tr>
		<th>DATE:</th>
			<td>
				<input type="text" name="date_vp" size="13" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr> 

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	<a href="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
						&client=<?php echo $client?>
						&date_ve=<?php echo $date_ve?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>">
	<input type="button" name="ANUL" value="Annuller" />
	</a>
	
	<input type="submit" name="valider" value="Valider" /></td>
	<input type=hidden name="id_ve" value="<?php echo $id_ve?>">
	<td><input type=hidden name="role1" value="payer" /></td></tr>
	
</table>	
<?php } ?>
<hr align="right" size="2" noshade="noshade" />
<a href="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
						&client=<?php echo $client?>
						&date_ve=<?php echo $date_ve?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>" style="text-align: right; ">
<input type="button" name="retour" value="Retoure" style="text-align: right; " /></a> 

	</form>	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
