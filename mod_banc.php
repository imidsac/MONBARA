<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
$resultat1=pg_query($connexion, "SELECT * from bamk");
$resultat2=pg_query($connexion, "SELECT * from nom_bank");
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>MODIFICATION D'UN VERSEMENT / RETRAIT </strong></em></h1>
<?php
$date_b=$_GET['date_b'];
$type=$_GET['type'];
$compte_banc=$_GET['compte_banc'];
$designation=$_GET['designation'];
$somme=$_GET['somme'];
$solde=$_GET['solde'];
$id_bk=$_GET['id_bk'];
echo '<form action="banc.php" method="post">';
echo '<table>';
	echo '<tr><th>DATE:</th><td><input type="text" name="date_b" value="'.$_GET['date_b'].'" /></td></tr>';
	echo '<tr><th>LEBELLE:</th><td><select name="type">';

	while($ligne=pg_fetch_assoc($resultat1))
	{
		//	if($ligne['type']=='v') 
	//		echo '<td>Versement</td>';
	// else ($ligne['type']=='r')
		//	echo '<td>Retrait</td>';
		echo '<option> '.$ligne['type'].'</option>';	
	}

echo '</select></td></tr>';
	echo '<tr><th>COMPTE-BANCAIRE:</th><td><input type="text" name="compte_banc" value="'.$_GET['compte_banc'].'" /></td></tr>';
	echo '<tr><th>BANQUE:</th><td><select name="id_bk">';

	while($ligne=pg_fetch_assoc($resultat2))
	{
		echo '<option> '.$ligne['designation'].'</option>';	
	}
echo '</td></tr>';
	echo '<tr><th>SOMME:</th><td><input type="text" name="somme" value="'.$_GET['somme'].'" /></td></tr>';
	//echo '<tr><th>SOLDE:</th><td><input type="text" name="solde" value="'.$_GET['solde'].'" /></td></tr>';
	echo '<tr><td><a href="banc.php"><input type="button" name="annuller" value="Annuller" /></a></td>
				 <td><input type="submit" name="valider" value="Valider" />
			<input type="hidden" name="id_b" value="'.$_GET['id_b'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</td></tr>';
echo '</table>';
echo '</form>';
?>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
