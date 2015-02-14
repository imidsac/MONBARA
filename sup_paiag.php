<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$mois=$_GET['mois'];
$id_bo=$_GET['id_bo'];
$id_b=$_GET['id_b'];
$nom_b=$_GET['nom_b'];
$compte_banc=$_GET['compte_banc'];
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	
	<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SUPPRESSION D'UNE VERSEMENT</h5></th></tr>
<tr>
<th class="header3 ldroite">DATE</th>
<td><?php echo $_GET['date_trp'] ?></td>
</tr>
<tr>
<th class="header3 ldroite">MOTIF</th>
<td><?php echo $motif ?></td>
</tr>
<th class="header3 ldroite">COMPTE-BANK</th>
<td><?php echo $nom_b. ':  ' .$compte_banc ?></td>
</tr>
<tr>
<th class="header3 ldroite">MONTANT</th>
<td><?php echo $nom_b=number_format($_GET['montant'],0,' ',' '); ?><sup>F</sup></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<table><tr><td>
<form action="paie_ag_moi.php?&mois=<?php echo $mois?>
	                          &id_bo=<?php echo $id_bo ?>
	                          &annee=<?php echo $annee?>
	                          &bar=<?php echo $bar?>" method="post">
	<input type=hidden name=id_trp value="<?php echo $_GET['id_trp']?>">
	<input type=hidden name=role1 value="supag">
<!-- <br>
<hr align="left" size="2" width="100%" noshade>
 --><input type="submit" name="val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
</form></td>
<td valign="top"><a href="paie_ag_moi.php?&mois=<?php echo $mois?>&id_bo=<?php echo $id_bo?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Anuller</button></a>
</td>
</tr></table>	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

