<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');


$resultat=pg_query($connexion, "SELECT * from fournisseur where id_fo=0");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1><strong>AJOUT ACHAT</strong></h1>
<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="cachat_ajo.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>" method="post">

	<tr><th class="header3 ldroite">CHOISISEZ-FOURNISSEUR</th><td><select name="id_fo" size="0" id="myb" class="ui-state-active ui-corner-all boutons">
<?php
	while($ligne=pg_fetch_assoc($resultat))
	{
		echo '<option value="'.$ligne['id_fo'].'">';
		echo $ligne['nom_fo'].'</option>';
	}
?>
</select></td></tr>
	
	<tr>
		<th class="header3 ldroite">DATE-EDITION</th>
			<td>
				<input type="text" name="date_1" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">DATE-LIVRAISON</th>
			<td>
				<input type="text" name="date_2" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>
	
	
	<tr>
		<td collspan="2"></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: right;">
		<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
		<input type=hidden name="role1" value="ajouter" />
		<input type=hidden name="id_bo" value="<?php echo $uti?>">
		</form>	
		</td>
		<td><a href="achat2.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>">
		<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
		</a></td>
	</tr>
	
</table>	
	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
