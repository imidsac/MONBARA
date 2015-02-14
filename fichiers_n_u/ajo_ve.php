<?php
include_once('header.php');
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>VENTE</strong></em></h1>
<form action="ventes_con_ajo.php" method="post">
<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr>
		<th>DATE:</th>
			<td>
				<input type="text" name="date_ve" size="13" value="<?php echo (date('d-m-Y  H:i:s')) ?>" />
			</td>
	</tr>
	<tr>
		<th>CLIENT:</th>
			<td>
			<input type="text" name="client" size="13" value="<?php echo (INCONU) ?>" />
			</td>
	</tr>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	<a href="ventes2.php">
	<input type="button" name="ANUL" value="Annuller" />
	</a>
	
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
