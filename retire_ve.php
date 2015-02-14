<?php
include_once('header.php');
?>
<div id="content">
<?php
include_once('sidebar.php');
	$id_ve=$_GET['id_ve'];
	$client=$_GET['client'];
	$date_ve=$_GET['date_ve'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$num=0;
?>
<div id="colTwo">
	<h1 align="center"><em><strong>RETRAIT DE L'ARTICLE DE VENTE </strong></em></h1>

<?php
echo '<table cellpadding="10" cellspacing="0" border="1">';
echo '<tr>';
echo '<th>CLIENT </th>';
echo '<td>'.$client.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>DATE</th>';
echo '<td>'.$date_ve.'</td>';
echo '</tr>';
//echo '<th>FACTURE N°</th>';
//echo '<td>'.$num.''.$id_ve.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<th>Produit:</th>
<td><?php echo $_GET['lib_ar'] ?></td>
</tr>
<tr>
<th>Type:</th>
<td><?php echo $_GET['type_ar'] ?></td>
</tr>
<tr>
<th>Quantité:</th>
<td><?php echo $_GET['qte_ar'] ?></td>
</tr>
</table>
<br>
<h3 align="center"><strong>Voulez vous vraiment supprimer ?</strong></h3>
<form action="ventes_con.php?id_ve=<?php echo $_GET['id_ve']?>
							&client=<?php echo $client?>
							&date_ve=<?php echo $date_ve?>
							&somme=<?php echo $somme?>
							&payee=<?php echo $payee?>
							&reste=<?php echo $reste?>" method="post">
	<input type="hidden" name="id_ve" value="<?php echo $_GET['id_ve']?>">
	<input type="hidden" name="id_ar" value="<?php echo $_GET['id_ar']?>">
	<input type="hidden" name="role1" value="supprimer">
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
</form>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
