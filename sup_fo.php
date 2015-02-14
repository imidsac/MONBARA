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
	
	<table style="width:60%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION D'UN FOURNISSEUR</h5></th></tr>
<tr>
<th class="header3 ldroite">NOM</th>
<td><?php echo $_GET['nom_fo'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">ADRESSE</th>
<td><?php echo $_GET['add_fo'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table><tr><td><form action="fourni.php" method="post">
	<input type=hidden name=id_fo value="<?php echo $_GET['id_fo']?>">
	<input type=hidden name=role1 value="supprimer">
<!-- <br>
<hr align="left" size="2" width="100%" noshade>
 -->
<input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
</form></td>
<td valign="top"><a href="fourni.php">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td>
</tr></table>	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

