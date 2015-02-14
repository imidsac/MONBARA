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
	<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION D'ARTICLE</h5></th></tr>
<tr>
<th class="header3 ldroite">Article</th>
<td><?php echo $_GET['lib_ar'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">Type</th>
<td><?php echo $_GET['type_ar'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table><tr><td><form action="article.php" method="post">
	<input type=hidden name=id_ar value="<?php echo $_GET['id_ar']?>">
	<input type=hidden name=role1 value="supprimer">
<!-- <br>
<hr align="left" size="2" width="100%" noshade> -->

</a>
<input type="submit" name="val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
</form></td>
	<td valign="top"><a href="article.php">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></td></tr></table>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

