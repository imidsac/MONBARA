<?php
include_once('header.php');
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>SUPPRESSION D'UN ACHAT</strong></em></h1>
	
	<table>
<tr>
<th>Date:</th>
<td><?php echo $_GET['a_date'] ?></td>
</tr>
<tr>
<th>Produit:</th>
<td><?php echo $_GET['lib_ar'] ?></td>
</tr>
<tr>
<th>Type:</th>
<td><?php echo $_GET['type_ar'] ?></td>
</tr>
<tr>
<th>Quantité:</th>
<td><?php echo $_GET['qt_ar'] ?></td>
</tr>
</table>
<br>
<h3>Voulez vous vraiment supprimer ?</h3>
<form action="achat.php" method="post">
	<input type=hidden name=id_acha value="<?php echo $_GET['id_acha']?>">
	<input type=hidden name=role1 value="supprimer">
<br>
<hr align="left" size="2" width="100%" noshade>
<a href="achat.php">
<input type="button" name="anull" value="Anuller" /></a>
<input type="submit" name="val" value="Valider" />
</form>

</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
