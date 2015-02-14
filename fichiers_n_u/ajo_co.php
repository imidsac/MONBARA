<?php
include_once('header.php');
include_once('connection.php');
$resultat=pg_query($connexion, "SELECT * from clients");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>AJOUT UNE COMMANDE</strong></em></h1>
<form action="ccommande_ajo.php" method="post">
<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><th>CHOISISEZ-CLIENT:</th><td><select name="id_cl" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat))
	{
		echo '<option value="'.$ligne['id_cl'].'">';
		echo $ligne['nom_cl'].'  '.$ligne['prenom_cl'].'</option>';
	}
?>
</select></td></tr>
	
	<tr>
		<th>DATE-EDITION:</th>
			<td><input type="text" name="date1" size="13" value="<?php echo (date('d-m-Y H:i:s')) ?>" /></td>
	</tr>
	<tr>
		<th>DATE_LIVRAISON:</th>
			<td><input type="text" name="date2" size="13" value="<?php echo (date('d-m-Y H:i:s')) ?>" /></td>
	</tr>
	
	
	<tr><td collspan="2"></td></tr>
	<tr><td><!-- <a href="commande.php"><input type="button" name="ANUL" value="Annuller" /></a> --></td>
	<td style="text-align: right;">
	<a href="commande.php"><input type="button" name="ANUL" value="Annuller" /></a>
	
	<input type="submit" name="valider" value="Valider" /></td>
	<td><input type=hidden name="role1" value="ajouter" /></td></tr>
	
</table>	
	</form>	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
