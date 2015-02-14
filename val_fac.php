<?php
include_once('header.php');
include_once('connection.php');
	$id_fac=$_GET['id_fac'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$date_fac=$_GET['date_fac'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	
	//$som=0;
	$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat1=pg_query($connexion, "SELECT facture_con.*, lib_ar, type_ar,(qte_ar-qte_livres) as reste
from facture_con join articles using(id_ar) where id_fac=$id_fac ORDER BY lib_ar desc");
?>
<div id="colTwo">
	<h1 align="center"><strong>LIVRAISON TOTALE</strong></h1>

<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_cl.'  '.$prenom_cl.' </td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE </th>';
echo '<td align="center">'.$date_fac.'</td>';
echo '</tr>';
echo '</tr>';
echo '<th class="header3 ldroite">FACTURE N°</th>';
echo '<td class="ldroite crouge">'.$num.''.$id_fac.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>
<br>

<?php
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
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
	echo '<td>'.$ligne['qte_ar'].'</td>';
	echo '<td>'.$ligne['qte_livres'].'</td>';
	echo '<td>'.$ligne['reste'].'</td>';
	echo '<td>'.$ligne['prix_vente'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['montant'].'<sup>F</sup></td>';
	
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
<table><tr><td><form action="cfac.php?id_fac=<?php echo $_GET['id_fac']?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date_fac=<?php echo $date_fac?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>
						&reste=<?php echo $reste?>" method="post">
						
	<input type="hidden" name="id_fac" value="<?php echo $_GET['id_fac']?>">
	<input type="hidden" name="id_ar" value="<?php echo $ligne['id_ar']?>"> 
	
<!-- <br>
<hr align="left" size="2" width="100%" noshade>
 -->
<input type="submit" name="val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
<input type="hidden" name="role1" value="valider">
</form></td>

<td valign="top"><a href="cfac.php?id_fac=<?php echo $_GET['id_fac']?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date_fac=<?php echo $date_fac?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>"
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td></tr></table>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
