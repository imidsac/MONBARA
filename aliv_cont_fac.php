<?php
include_once('connection.php');
include_once('session.php');
include_once('header.php');
	$id_fac=$_GET['id_fac'];
	$id_ar=$_GET['id_ar'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$date_fac=$_GET['date_fac'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	/*$mois=$_GET['mois'];
	$annee=$_GET['annee'];*/
	$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><strong>ANNULATION DE LA LIVRAISON </strong></h1>
<?php
$resultat1=pg_query($connexion, "SELECT  facture_con.*,lib_ar, type_ar, (qte_ar-qte_livres) as reste
from facture_con join articles using(id_ar) where id_fac=$id_fac and qte_livres=qte_ar and id_ar=$id_ar ORDER BY lib_ar desc");

//$resultat2=pg_query($connexion, "SELECT   
//from facture_con where id_fac=$id_fac and id_ar=$id_ar ");

$resultat2=pg_query($connexion,$requete);
$res=$ligne['qte_ar']-$ligne['qte_livres'];
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">CLIENT </th>';
echo '<td align="center">'.$nom_cl.'  '.$prenom_cl.' </td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE </th>';
echo '<td align="center">'.$date_fac.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">FACTURE NÂ°</th>';
echo '<td class="ldroite crouge">'.$num.''.$id_fac.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>

<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
<form action="cfac.php?id_fac=<?php echo $_GET['id_fac']?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date_fac=<?php echo $date_fac?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>" method="post">

<tr class="header2 lgauche bw">
<th>NÂ°</th>
<th colspan="2">PRODUIT </th>
<!-- <th>TYPE </th> -->
<th>QUANTITE </th>
<th>QUANTITE LIVRAIS</th>
<!-- <th>QUANTITE RESTE A LIVRAIS</th> -->
<!-- <th>VALIDER </th> -->
</tr>
<?php
$i=1;
	while ($ligne=pg_fetch_assoc($resultat1))
	{
		$qtr='qt_'.$ligne['id_ar'];
		//$et='et_'.$ligne['id_ar'];
		$pu='pu_'.$ligne['id_ar'];
		echo '<tr class="'.ligneColor().' bw">';
		echo '<td>'.$i.'</td>';
		echo '<td>'.$ligne['lib_ar'].'</td>';
		echo '<td>'.$ligne['type_ar'].'</td>';
		echo '<td class=" lcentre">'.$ligne['qte_ar'].'</td>';
		echo '<td class=" lcentre">'.$ligne['qte_livres'].'</td>';
		//echo '<td class=" lcentre">'.$reste.'</td>';
		//echo '<td><input type=checkbox name="'.$et.'" value="1" ></td>';
		echo '</tr>';
	$i++;
	}
?>


<input type="hidden" name="id_fac" value="<?php echo $id_fac?>">
<input type="hidden" name="id_ar" value="<?php echo $id_ar?>">
<input type="hidden" name="role1" value="alivre">




<?php
echo '<br>';
?>

<!-- <hr align="left" size="2" width="100%"> -->

<tr class="header3 lgauche bw"><td><input type="submit" name="Val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
</form></td>
<td><a href="cfac.php?id_fac=<?php echo $_GET['id_fac']?>
						&nom_cl=<?php echo $nom_cl?>
						&prenom_cl=<?php echo $prenom_cl?>
						&date_fac=<?php echo $date_fac?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuler</button></a></td>
<td colspan="4"></td>
</tr>

</table>

</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
