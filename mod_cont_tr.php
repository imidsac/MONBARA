<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_tr=$_GET['id_tr'];
	$nom_bo=$_GET['nom_bo'];
	$adr_bo=$_GET['adr_bo'];
	$prenom_bo=$_GET['prenom_bo'];
	$date_tr=$_GET['date_tr'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><strong>MODIFICATION DE LA TRANSFERTS</strong></h1>
<?php
$resultat1=pg_query($connexion, "SELECT  transferts_con.*,lib_ar, type_ar 
from transferts_con join articles using(id_ar) where id_tr=$id_tr ORDER BY lib_ar,type_ar desc");
//$resultat1=pg_query($connexion,$requete);
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_bo.' '.$adr_bo.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE </th>';
echo '<td align="center">'.$date_tr.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">TRANSFERTS N°</th>';
echo '<td class="ldroite crouge">'.$num.''.$id_tr.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>

<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">
<form action="ctr.php?id_tr=<?php echo $_GET['id_tr']?>
						&nom_bo=<?php echo $nom_bo?>
						&adr_bo=<?php echo $adr_bo?>
						&date_tr=<?php echo $date_tr?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" method="post">

<tr class="header2 lgauche bw">
<th>N°</th>
<th colspan="2">PRODUIT </th>
<!-- <th>TYPE </th> -->
<th>Q.T </th>
<th>Q.T.LIVRAIS </th>
<!-- <th>Q.T.R.LIVRAI </th> -->
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
		echo '<td><input type=text name="'.$qt.'" size="5" value='.$ligne['qte_ar'].'></td>';
		echo '<td><input type=text name="'.$li.'" size="5" value='.$ligne['qte_livres'].'></td>';
		//echo '<td><input type=text name="'.$qtrl.'" size="5" value='.$ligne['qte_ar'].'></td>';
		echo '<td><input type=text name="'.$pu.'" size="5" value='.$ligne['prix_vente'].'></td>';
		//echo '<td><input type=checkbox name="'.$et.'" value="1" ></td>';
		echo '</tr>';
	$i++;
	}
?>



<?php
echo '<br>';
?>

<!-- <hr align="left" size="2" width="100%"> -->

<tr class="header3 lgauche bw"><td><input type="submit" name="Val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
<input type="hidden" name="id_tr" value="<?php echo $id_tr?>">
<input type="hidden" name="id_ar" value="<?php echo $ligne['id_ar']?>">
<input type="hidden" name="qte_ar" value="<?php echo $ligne['qte_ar']?>">
<input type="hidden" name="qte_livres" value="<?php echo $ligne['qte_livres']?>">
<input type="hidden" name="prix_vente" value="<?php echo $ligne['prix_vente']?>">
<input type="hidden" name="role1" value="modifier">

</form></td>
<td><a href="ctr.php?id_tr=<?php echo $_GET['id_tr']?>
						&nom_bo=<?php echo $nom_bo?>
						&adr_bo=<?php echo $adr_bo?>
						&date_tr=<?php echo $date_tr?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuler</button></a></td>
<td colspan="5"></td>
</tr>

</table>

</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
