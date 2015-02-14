<?php
include_once('header.php');
include_once('session.php');
	$id_fo=$_GET['id_fo'];
	$nom_fo=$_GET['nom_fo'];
	$date_2=$_GET['date_2'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><strong>RETRAIT DE L'ARTICLE DE L'ACHAT </strong></h1>

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
<td><?php echo $_GET['qt_ar'] ?></td>
</tr>
</table>
<br>
<h3 align="center"><strong>Voulez vous vraiment supprimer ?</strong></h3>
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
	<input type="hidden" name="id_ar" value="<?php echo $_GET['id_ar']?>">
	<input type="hidden" name="role1" value="supprimer">
<!-- <br>
<hr align="left" size="2" width="100%" noshade> -->
<input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
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
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td></tr></table>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
