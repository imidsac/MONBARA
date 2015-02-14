<?php
include_once('header.php');
include_once('session.php');
$id_cl=$_GET['id_cl'];
	$id_co=$_GET['id_co'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$date2=$_GET['date2'];
	$date2=$_GET['date2'];
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
	<h1 align="center"><em><strong>RETRAIT DE L'ARTICLE DE LA COMMANDE </strong></em></h1>

<?php
echo '<table cellpadding="10" cellspacing="0" border="1" align="left">';
echo '<tr>';
echo '<th>Client </th>';
echo '<td>'.$nom_cl.'	'.$prenom_cl.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>Date de livraison </th>';
echo '<td>'.$date2.'</td>';
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
<form action="ccommande.php?id_co=<?php echo $_GET['id_co']?>
						&id_cl=<?php echo $id_cl?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date2=<?php echo $date2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>" method="post">
	<input type="hidden" name="id_co" value="<?php echo $_GET['id_co']?>">
	<input type="hidden" name="id_ar" value="<?php echo $_GET['id_ar']?>">
	<input type="hidden" name="role1" value="supprimer" />
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
</form>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
