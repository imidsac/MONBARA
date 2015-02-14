<?php
include_once('header.php');
include_once('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="client.php?&bar=<?php echo $bar?>" method="post">
	<tr class="header3 bw"><th colspan="2"><h5 align="center" class="titre1">AJOUT UN(E) CLIENT(E)</h5></th></tr>
	<tr>
		<th class="header3 ldroite">NOM:</th>
		<td><input type="text" name="nom_cl" size="20" class="text header1 ui-corner-all" /></td>
	</tr>
	<tr>
		<th class="header3 ldroite">PRENOM:</th>
		<td><input type="text" name="prenom_cl" size="20" class="text header1 ui-corner-all" /></td>
	</tr>
	<!-- <tr>
		<th class="header3 ldroite">ADRESSE</th>
		<td><input type="text" name="add_cl" size="20" class="text header1 ui-corner-all" value="Ouolofobougou" /></td>
	</tr> -->
	<tr>
		<th class="header3 ldroite">TEL:</th>
		<td><input type="text" name="tel1_cl" size="20" class="text header1 ui-corner-all" value="00 00 00 00" /></td>
	</tr>
	<!-- <tr>
		<th class="header3 ldroite">TEL2</th>
		<td><input type="text" name="tel2_cl" size="20" class="text header1 ui-corner-all" value="00 00 00 00" /></td>
	</tr> -->
	<tr>
		<th colspan="2" class="header3 lcentre">ADRESSE</th>
	</tr>
	<tr>
		<td colspan="2">
			<input type="text" name="add_cl" value="" size="60" class="text header1 ui-corner-all" />
		</td></tr>
	
	
	<tr>
	<td style="text-align: right;">
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	<input type=hidden name="role1" value="ajouter" />
	<input type=hidden name="id_bo" value="<?php echo $uti?>">
	</form>	
	
		<td><a href="client.php?&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
		</a>	</td>
			</tr>
	
</table>	
	
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

