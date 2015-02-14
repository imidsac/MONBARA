<style type="text/Css">
<!--
/*.test1
{
    border: solid 1px #FF0000;
    background: #FFFFFF;
    border-collapse: collapse;
}
.gris { color:#989898;}
#entete { top:0px; height:30px; width:80px; background:#efefef}
.petitet { color:#ffffff; font-size:5%}

table
{
    width:  100%;
    border: solid 1px #5544DD;
}

th
{
    text-align: center;
    border: solid 1px #113300;
    background: #EEFFEE;
}

td
{
    text-align: left;
    border: solid 1px #55DD44;
}

td.col1
{
    border: solid 1px red;
    text-align: right;
}*/
-->
</style>
<page style="font-size: 14px" >
   <?php
   $id_fac=$_GET['id_fac'];
	$client=$_GET['client'];
	$date_fac=$_GET['date_fac'];
	/*$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];*/
$som=0;
$num=0;
//include_once('connection.php');
$connexion=pg_connect("dbname=dbquin2 host=localhost user=etudiant1 password=alfarouk");
?>

<div id="content">
	
	

	<div id="colTwo">
	<h1 class="gris"><em><strong>QUINCAILLERIE SISSOKO ET FRERES</strong></em></h1>
	<br/>
    <p align="left">Vente de Matériaux de Construction<br/>
    Fer à Béton - Ciment - Fer - Tôle et Divers<br/>
    N° Fiscal: 084107735-N<br/>
    BP 480 - Tél: 20 29 28 04 - Cell: 76 15 09 63<br>
    Ouolofobougou Nouveau Marché - Rue 42 - Porte 620 - 626<br/>
    Bamako - Mali</p>
    <br/>
    <br/>
		<?php	
$resultat=pg_query($connexion, "SELECT facture_con.*, type_ar,lib_ar
from facture_con join articles using(id_ar) where id_fac=$id_fac");

//$rfac=pg_query($connexion, "SELECT * from facture where id_fac=$id_fac");


$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar 
from articles where id_ar not in (select id_ar from facture_con where id_fac=$id_fac)");
//$lfac=pg_fetch_assoc($rfac);
echo '<table cellpadding="35" cellspacing="0" border="1">';
echo '<tr>';
echo '<th>CLIENT </th>';
//echo '<td>'.$ligne['nom_cl'].'  '.$ligne['prenom_cl'].'</td>';
echo '<td>'.$client.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>DATE</th>';
//echo '<td>'.$ligne['date2'].'</td>';
echo '<td>'.$date_fac.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>FACTURE N°</th>';
echo '<td align="center">'.$num.' '.$id_fac.'</td>';
echo '</tr>';
echo '</table>';
echo '<br/>';

echo '<table cellpadding="5" cellspacing="0" border="1">';
echo '<tr><th>QUANTITE</th><th colspan="2">DESIGNATION</th><th>PRIX-UNITAIRE</th><th>MONTANT</th></tr>';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td align="center">'.$ligne['qte_ar'].'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	//echo '<td>livré</td>';
	echo '</tr>';
	
	$som=$som+$ligne['montant'];
	
	}
?>
<tr>
<td colspan="4" align="center" class="prix"><strong><em>PRIX TOTAL</em></strong></td> 
<td align="right" class="som"><strong><em><?php echo number_format($som,0,' ',' ').'<sup>F</sup>' ?>
</em></strong></td>
</tr>
</table>

<!-- <strong align="left">Client</strong>
<strong align="center">Fournisseur</strong>
 --></div>
	<div style="clear: both;">&nbsp;</div>
</div>




</page>