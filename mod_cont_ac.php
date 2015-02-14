<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_fo=$_GET['id_fo'];
	$id_ac=$_GET['id_ac'];
	$nom_fo=$_GET['nom_fo'];
	$date_2=$_GET['date_2'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><em><strong>MODIFICATION DE L'ACHAT</strong></em></h1>
<?php
$resultat1=pg_query($connexion, "SELECT achat_con.*, lib_ar, type_ar 
from achat_con join articles using(id_ar) where id_ac=$id_ac ORDER BY lib_ar desc");
$resultat2=pg_query($connexion,$requete);
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr >';
echo '<th class="header3 ldroite">FOURNISSEUR </th>';
echo '<td align="center">'.$nom_fo.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE DE LIVRAISON </th>';
echo '<td align="center">'.$date_2.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>

<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
<form action="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" method="post">

<tr class="header2 lgauche bw">
<th>N°</th>
<th colspan="2">PRODUITS </th>
<!-- <th>TYPE </th> -->
<th>Q.T </th>
<th>Q.T.LIVRAIS </th>
<th>PRIX-UNITAIRE </th>
<!-- <th>VALIDER </th> -->
</tr>
<?php
$i=1;
	while ($ligne=pg_fetch_assoc($resultat1))
	{
		$qt='qt_'.$ligne['id_ar'];
		$li='li_'.$ligne['id_ar'];
		$pu='pu_'.$ligne['id_ar'];
		echo '<tr class="'.ligneColor().' bw">';
		echo '<td>'.$i.'</td>';
		echo '<td>'.$ligne['lib_ar'].'</td>';
		echo '<td>'.$ligne['type_ar'].'</td>';
		echo '<td><input type=text name="'.$qt.'" size="5" value='.$ligne['qt_ar'].'></td>';
		echo '<td><input type=text name="'.$li.'" size="5" value='.$ligne['qte_livres'].'></td>';
		echo '<td><input type=text name="'.$pu.'" size="5" value='.$ligne['prix_achat'].'></td>';
		//echo '<td><input type="checkbox" name="'.$et.'" value="1" /></td>';
		echo '</tr>';
	$i++;
	}
?>
<!-- <br>
<hr align="left" size="2" width="100%"> -->

<tr class="header3 lgauche bw"><td><input type="submit" name="Val" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
<input type="hidden" name="id_ac" value="<?php echo $id_ac?>">
<!-- <input type="hidden" name="pu" value="<?php echo $pu?>"> -->
<input type="hidden" name="role1" value="modifier">
</form></td>
<td><a href="cachat.php?id_ac=<?php echo $_GET['id_ac']?>
						&id_fo=<?php echo $id_fo?>
						&nom_fo=<?php echo $nom_fo?>
						&date_2=<?php echo $date_2?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a></td>
<td colspan="4"></td>
</tr>
</table>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
