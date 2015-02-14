<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<form action="fourni.php" method="post">
	<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">AJOUT UN FOURNISSEUR</h5></th></tr>
	<tr>
		<th class="header3 ldroite">NOM</th>
			<td><input type="text" name="nom_fo" size="20" class="text header1 ui-corner-all" value="NOM SOCIETE" /></td>
	</tr>
	<tr>
		<th class="header3 ldroite">TEL:</th>
			<td><input type="text" name="tel1_fo" size="20" class="text header1 ui-corner-all" value="00 00 00 00" /></td>
	</tr>
	<tr>
				<th colspan="2" class="header3 lcentre">ADRESSE:</th>
					
	</tr>
	<tr>
				<td colspan="2">
						<input type="text" name="add_fo" size="60" class="text header1 ui-corner-all" value="" />
					</td>
	</tr>
	
	
	<!-- <tr>
		<td collspan="2"></td>
	</tr> -->
	<tr>
	<td style="text-align: right;">
		
		<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
		<input type=hidden name="role1" value="ajouter" />
		</form>
		
		<a href="fourni.php">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
		</a>				
		</td>
	</tr>
</table>	
	
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

