<?php
include_once('header.php');
include_once('connection.php');
	$id_co=$_GET['id_co'];
	$id_cl=$_GET['id_cl'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$date2=$_GET['date2'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	//$som=0;
	//$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat1=pg_query($connexion, "SELECT ccommandes.*, lib_ar, type_ar
from ccommandes join articles using(id_ar) where id_co=$id_co");
?>
<div id="colTwo">
	<h1 align="center"><em><strong>VALIDATION COMMANDE </strong></em></h1>

<?php
echo '<table cellpadding="10" cellspacing="0" border="1" align="left">';
echo '<tr>';
echo '<th>CLIENT </th>';
echo '<td>'.$nom_cl.'	'.$prenom_cl.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>DATE DE LIVRAISON </th>';
echo '<td>'.$date2.'</td>';
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
	echo '<td>'.number_format($ligne['qt_ar'],0,' ',' ').'</td>';
	echo '<td>'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td>'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
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
<form action="ccommande.php?id_co=<?php echo $_GET['id_co']?>
						&id_cl=<?php echo $id_cl?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date2=<?php echo $date2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>" method="post">
	<input type="hidden" name="id_co" value="<?php echo $_GET['id_co']?>">
	<!-- <input type="hidden" name="id_ar" value="<?php echo $ligne['id_ar']?>"> -->
	
<br>
<hr align="left" size="2" width="100%" noshade>
<a href="ccommande.php?id_co=<?php echo $_GET['id_co']?>
						&id_cl=<?php echo $id_cl?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date2=<?php echo $date2?>
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
