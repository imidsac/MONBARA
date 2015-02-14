<?php
include_once('header.php');
include_once('session.php');

?>

<div id="content">
	
	<?php
	include_once('connection.php');
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	
	<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION D'UNE TRANSFERTS</h5></th></tr>
<tr>
<th class="header3 ldroite">AGENCE</th>
<td><?php echo $_GET['nom_bo'].' '.$_GET['prenom_bo'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">DATE</th>
<td><?php echo $_GET['date_tr'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table>
<tr>
<td>
<form action="vente_tr_moi.php?&mois=<?php echo $mois?>&annee=<?php echo $annee?>&bar=<?php echo $bar?>" method="post">
	<input type=hidden name=id_tr value="<?php echo $_GET['id_tr']?>">
	<input type=hidden name=role1 value="supprimer">
	<input type="submit" name="val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
</form>
</td>

<td valign="top"><a href="vente_tr_moi.php?&mois=<?php echo $mois?>&annee=<?php echo $annee?>&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a></td></tr>

</table>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

