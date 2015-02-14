<?php
include_once('header.php');
include_once('connection.php');
	$id_ve=$_GET['id_ve'];
	$client=$_GET['client'];
	$date_ve=$_GET['date_ve'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	//$som=0;
	//$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat1=pg_query($connexion, "SELECT ventes_con.*, lib_ar, type_ar
from ventes_con join articles using(id_ar) where id_ve=$id_ve");
?>
<div id="colTwo">
	<h1 align="center"><em><strong>VALIDATION VENTE </strong></em></h1>

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
echo '</table>';
echo '<br>';
?>
<br>

<?php
echo '<table cellpadding="10" cellspacing="0" border="1" align="center">';
echo '<tr>
			<th>N°</th>
			<th colspan="2">PRODUIT</th>
			<th>QUANTITE</th>
			<th>PRIX-UNITAIRE</th>
			<th>MONTANT</th>
			<!-- <th>ACTION</th> -->
		</tr>';
		$i=1;
while ($ligne=pg_fetch_assoc($resultat1))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['qte_ar'].'</td>';
	echo '<td>'.$ligne['prix_vente'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['montant'].'<sup>F</sup></td>';
	
	//$som=$som+$ligne['montant'];
	$i++;
}

?>
<tr>
	<td colspan="5" align="center" class="prix">
		<strong>PRIX TOTAL</strong>
	</td>
	<td colspan="" align="center" class="som">
		<strong><?php echo number_format($somme,0,' ',' ').'<sup>F</sup>' ?></strong>
	</td>
</tr>

</table>
<br>
<h3 align="left"><strong>Voulez vous vraiment valider ?</strong></h3>
<form action="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
						&client=<?php echo $client?>
						&date_ve=<?php echo $date_ve?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>" method="post">
	<input type="hidden" name="id_ve" value="<?php echo $_GET['id_ve']?>">
	<!-- <input type="hidden" name="id_ar" value="<?php echo $ligne['id_ar']?>"> -->
	
<br>
<hr align="left" size="2" width="100%" noshade>
<a href="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
						&client=<?php echo $client?>
						&date_ve=<?php echo $date_ve?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>">
<input type="button" name="anull" value="Anuller" /></a>
<input type="submit" name="val" value="Valider" />
<input type="hidden" name="role1" value="valider">
</form>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
