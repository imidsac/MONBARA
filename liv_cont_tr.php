<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_tr=$_GET['id_tr'];
	$id_ar=$_GET['id_ar'];
	$nom_bo=$_GET['nom_bo'];
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
	<h1 align="center"><strong>LIVRAISON DE L'ARTICLES</strong></h1>
<?php
$resultat1=pg_query($connexion, "SELECT  transferts_con.*,lib_ar, type_ar, (qte_ar-qte_livres) as reste
from transferts_con join articles using(id_ar) 
where id_tr=$id_tr and qte_ar-qte_livres!=0 and id_ar=$id_ar ORDER BY lib_ar desc");

//$resultat2=pg_query($connexion, "SELECT   
//from transferts_con where id_tr=$id_tr and id_ar=$id_ar ");

//$resultat2=pg_query($connexion,$requete);
//$res=$ligne['qte_ar']-$ligne['qte_livres'];
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_bo.' </td>';
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
						&prenom_bo=<?php echo $prenom_bo?>
						&date_tr=<?php echo $date_tr?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" method="post">

<tr class="header2 lgauche bw">
<th>NÂ°</th>
<th colspan="2">PRODUIT </th>
<!-- <th>TYPE </th> -->
<th>QUANTITE </th>
<th>QUANTITE LIVRAIS</th>
<th>QUANTITE RESTE LIVRAIS</th>
<!-- <th>VALIDER /th> -->
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
		echo '<td class=" lcentre"><input type=text name="reste" size="5" value='.$ligne['reste'].'></td>';
		//echo '<td><input type=checkbox name="'.$et.'" value="1" ></td>';
		echo '</tr>';
	$i++;
	}
?>


<input type="hidden" name="id_tr" value="<?php echo $id_tr?>">
<input type="hidden" name="id_ar" value="<?php echo $id_ar?>">
<input type="hidden" name="role1" value="livre">




<?php
echo '<br>';
?>

<!-- <hr align="left" size="2" width="100%"> -->

<tr class="header3 lgauche bw"><td><input type="submit" name="Val" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
</form></td>
<td><a href="ctr.php?id_tr=<?php echo $_GET['id_tr']?>
						&nom_bo=<?php echo $nom_bo?>
						&prenom_bo=<?php echo $prenom_bo?>
						&date_tr=<?php echo $date_tr?>
						&somme=<?php echo $somme?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
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
