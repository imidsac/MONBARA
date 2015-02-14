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
<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION UNE CHARGE</h5></th></tr>
<tr>
<th class="header3 ldroite">Designation</th>
<td><?php echo $_GET['lib_dep'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">Date</th>
<td><?php echo $_GET['date_dep'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table>
<tr>
<td><form action="depence.php?&mois=<?php echo $mois?>&annee=<?php echo $annee ?>&bar=<?php echo $bar?>" method="post">
	<input type=hidden name=id_dep value="<?php echo $_GET['id_dep']?>">
	<input type=hidden name=role1 value="supprimer">
<!-- <br>
<hr align="left" size="2" width="50%" noshade="noshade" style="color:#fff" /> -->

<input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />

</form></td>
<td valign="top"><a href="depence.php?&mois=<?php echo $mois?>&annee=<?php echo $annee ?>&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td>
</tr>
</table>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

