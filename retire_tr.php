<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
?>
<div id="content">
<?php
include_once('sidebar.php');
	$id_tr=$_GET['id_tr'];
	$nom_bo=$_GET['nom_bo'];
	$adr_bo=$_GET['adr_bo'];
	$prenom_bo=$_GET['prenom_bo'];
	$date_tr=$_GET['date_tr'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$num=0;
?>
<div id="colTwo">
	<h1 align="center"><strong>RETRAIT DE L'ARTICLE DE VENTE </strong></h1>

<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_bo.'  '.$adr_bo.' </td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE</th>';
echo '<td align="center">'.$date_tr.'</td>';
echo '</tr>';
echo '<th class="header3 ldroite">TRANSFERTS N°</th>';
echo '<td class="ldroite crouge">'.$num.''.$id_tr.'</td>';
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
<table><tr><td><form action="ctr.php?id_tr=<?php echo $_GET['id_tr']?>
							&nom_bo=<?php echo $nom_bo?>
							&adr_bo=<?php echo $adr_bo?>
							&date_tr=<?php echo $date_tr?>
							&somme=<?php echo $somme?>
							&payee=<?php echo $payee?>
							&reste=<?php echo $reste?>
							&annee=<?php echo $annee?>
						    &mois=<?php echo $mois?>
						    &bar=<?php echo $bar?>" method="post">
	<input type="hidden" name="id_tr" value="<?php echo $_GET['id_tr']?>">
	<input type="hidden" name="id_ar" value="<?php echo $_GET['id_ar']?>">
	<input type="hidden" name="role1" value="supprimer">
<!-- <br>
<hr align="left" size="2" width="100%" noshade> -->

<input type="submit" name="val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
</form></td>
<td valign="top"><a href="ctr.php?id_tr=<?php echo $_GET['id_tr']?>
							&nom_bo=<?php echo $nom_bo?>
			                &adr_bo=<?php echo $adr_bo?>
							&date_tr=<?php echo $date_tr?>
							&somme=<?php echo $somme?>
							&payee=<?php echo $payee?>
							&reste=<?php echo $reste?>
							&annee=<?php echo $annee?>
						    &mois=<?php echo $mois?>
						    &bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td>
</tr></table>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
