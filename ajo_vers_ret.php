<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$resultat1=pg_query($connexion, "SELECT * from verait");
$resultat2=pg_query($connexion, "SELECT distinct id_b,nom_b,compte_banc from banques");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>VERSEMENT / RETRAIT</strong></em></h1>
<form action="banc.php" method="post">
<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><th>DATE:</th><td><input type="text" name="date_vr" value="<?php echo (date('d-m-Y')) ?>" /></td></tr>
	<tr><th>LIBELLE:</th>
<td><select name="type">
<?php
	while($ligne=pg_fetch_assoc($resultat1))
	{
		if($ligne['type']=='v') 
		 echo 'Versement';
	 else
			echo '<td>Retrait</td>';
		//echo '<option> '.$ligne['type'].'</option>';	
	}
?>
</select></td>
	</tr>
	<!-- <tr><th>COMPTE-BANCAIRE:</th><td><input type="text" name="compte_banc" /></td></tr> -->
	<tr><th>NOM-BANQUE:</th><td><select name="id_b">
<?php
	while($ligne=pg_fetch_assoc($resultat2))
	{
		echo '<option> '.$ligne['designation'].'	'.$ligne['compte_banc'].'</option>';	
	}
?></td></tr>
	<tr><th>SOMME:</th><td><input type="text" name="somme" /></td></tr>
	
	<tr><td collspan="2"></td></tr>
	<tr><td><a href="banc.php"><input type="button" name="ANUL" value="Annuller" /></a></td>
	<td><input type="submit" name="valider" value="Valider" /></td>
	<td><input type="hidden" name="role1" value="ajouter" /></td></tr>
	
</table>	
	</form>	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
