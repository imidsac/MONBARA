<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$resultat1=pg_query($connexion, "SELECT * from fournisseur");
$resultat2=pg_query($connexion, "SELECT * from articles");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>ACHAT</strong></em></h1>
<form action="achat.php" method="post">
<table cellpadding="0" cellspacing="0" border="0" align="left">
	<tr><th>DATE:</th><td><input type="text" name="a_date" value="<?php echo (date('d-m-Y')) ?>" /></td></tr>
	<tr><th>PRODUITS</th>
<td><select name="id_ar" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat2))
	{
		echo '<option value="'.$ligne['id_ar'].'">';
		echo $ligne['lib_ar'].' type '.$ligne['type_ar'].'</option>';
	}
?>
</select></td>
</tr>
	<tr><th>QUANTITE:</th><td><input type="text" name="qt_ar" value="1" /></td></tr>
	<tr><th>FOURNISSEURS</th>
<td><select name="id_fo" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat1))
	{
		echo '<option value="'.$ligne['id_fo'].'">';
		echo $ligne['nom_fo'].'</option>';
	}
?>
</select></td>
<td></td>
</tr>
	<!-- <tr><th>PRIX-UNITAIRE:</th><td><input type="text" name="pu_ar" /></td></tr> -->
	<tr><th>SOMME-PAYE:</th><td><input type="text" name="debit" /></td></tr>
		
	<tr><td collspan="2"></td></tr>
	<tr><td><a href="achat.php"><input type="button" name="ANUL" value="Annuller" /></a></td>
	<td><input type="submit" name="valider" value="Valider" /></td>
	<td><input type=hidden name="role1" value="ajouter" /></td>
	</tr>
</table>	
	</form>	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
