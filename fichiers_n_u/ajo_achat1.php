<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$resultat=pg_query($connexion, "SELECT id_fo, nom_fo  from fournisseur");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>FAIRE UN ACHAT</strong></em></h1>
<form action="commande.php" method="post">
<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><th>CHOISISEZ-FOURNISSEUR:</th><td><select name="id_fo" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat))
	{
		echo '<option value="'.$ligne['id_fo'].'">';
		echo $ligne['nom_fo'].'</option>';
	}
?>
</select></td></tr>
	
	<tr>
	<th>DATE-EDITION:</th><td><input type="text" name="a_date" value="<?php echo (date('d-m-Y')) ?>" /></td></tr>
	<!-- <tr><th>DATE_LIVRAISON:</th><td><input type="text" name="date2" /></td></tr> -->
	
	
	<tr><td collspan="2"></td></tr>
	<tr><td><a href="achat1.php"><input type="button" name="ANUL" value="Annuller" /></a></td>
	<td><input type="submit" name="valider" value="Valider" /></td>
	<td><input type=hidden name="role1" value="ajouter" /></td></tr>
	
</table>	
	</form>	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
