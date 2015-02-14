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
<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION D'UN(E) VCB/FONT</h5></th></tr>
<tr>
<th class="header3 ldroite">TYPE</th>
<?php 
	if($_GET['type_ctj']=='v') {
		echo '<td class="lgauche cbleu">FONT</td>';
		}
	else {
		echo '<td class="lgauche crouge">VCB</td>';
		}
	?>
</tr>
<tr>
<th class="header3 ldroite">DATE</th>
<td><?php echo $_GET['date_ctj'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">CRENCIER</th>
<td><?php echo $_GET['crencier1'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">PORTEUR</th>
<td><?php echo $_GET['crencier2'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">MONTANT</th>
<td class=" crouge"><?php echo $_GET['montant'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table><tr><td><form action="vcb_font.php?&mois=<?php echo $mois?>&annee=<?php echo $annee?>&bar=<?php echo $bar?>" method="post">
	<input type=hidden name=id_ctj value="<?php echo $_GET['id_ctj']?>">
	<input type=hidden name=role1 value="supprimer">
<!-- <br>
<hr align="left" size="2" width="100%" noshade>
 --><input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
</form></td>
<td valign="top"><a href="vcb_font.php?&mois=<?php echo $mois?>&annee=<?php echo $annee?>&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a>
</td>
</tr></table>	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

