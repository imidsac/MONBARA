<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_fo=$_GET['id_fo'];
	$id_ac=$_GET['id_ac'];
	$nom_fo=$_GET['nom_fo'];
	$date_2=$_GET['date_2'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	
?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat1=pg_query($connexion, "SELECT achat_con.*, lib_ar, type_ar, (qt_ar-qte_livres) as reste
from achat_con join articles using(id_ar) where id_ac=$id_ac ORDER BY lib_ar desc");
?>
<div id="colTwo">
	<h1 align="center"><em><strong>LIVRAISON TOTALE</strong></em></h1>

<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">FOURNISSEUR </th>';
echo '<td align="center">'.$nom_fo.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE DE LIVRAISON </th>';
echo '<td align="center">'.$date_2.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>
<br>

<?php
echo '<table  align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th colspan="2">PRODUIT</th>
			<th>Q.T</th>
			<th>Q.T-LIVRAIS</th>
			<th>Q.T-R.LIVRAIS</th>
			<th>PRIX-UNITAIRE</th>
			<th>MONTANT</th>
			<!-- <th>ACTION</th> -->
		</tr>';
		$i=1;
while ($ligne=pg_fetch_assoc($resultat1))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.number_format($ligne['qt_ar'],0,' ',' ').'</td>';
	echo '<td>'.number_format($ligne['qte_livres'],0,' ',' ').'</td>';
	echo '<td>'.number_format($ligne['reste'],0,' ',' ').'</td>';
	echo '<td>'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td>'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	//$som=$som+$ligne['montant'];
	$i++;
}

?>
<tr class="header2 lgauche bw">
	<td colspan="7" align="center" class="prix">
		<strong>PRIX TOTAL</strong>
	</td>
	<td colspan="" align="center" class="som">
		<strong><?php echo number_format($somme,0,' ',' ').'<sup>F</sup>' ?></strong>
	</td>
</tr>

</table>
<br>
<h3 align="left"><strong>Voulez vous vraiment valider ?</strong></h3>
<table><tr><td><form action="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" method="post">
	<input type="hidden" name="id_ac" value="<?php echo $_GET['id_ac']?>">
	<!-- <input type="hidden" name="id_ar" value="<?php echo $ligne['id_ar']?>"> -->
	
<!-- <br>
<hr align="left" size="2" width="100%" noshade> -->

<input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
<input type="hidden" name="role1" value="valider">
</form></td>
<td valign="top"><a href="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a></td></tr></table>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
