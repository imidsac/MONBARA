<style type="text/Css">
<!--
.test1
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
}
-->
</style>
<page style="font-size: 14px">
   <?php
$connexion=pg_connect("dbname=dbquin2 host=localhost user=etudiant1 password=alfarouk");
?>
<div id="content">
	<div id="colTwo">
	<h1 align="center" class="gris"><em><strong>QUINCAILLERIE SISSOKO ET FRERES</strong></em></h1>
	<br>
    <p align="center">Vente de Matériaux de Construction<br>
    Fer à Béton - Ciment - Fer - Tôle et Divers<br>
    N° Fiscal: 084107735-N<br>
    BP 480 - Tél: 20 29 28 04 - Cell: 76 15 09 63<br>
    Ouolofobougou Nouveau Marché - Rue 42 - Porte 620 - 626<br>
    Bamako - Mali</p>
    <br>
    <br>
		<?php
		
$resultat=pg_query($connexion, "SELECT id_fo,id_ar,lib_ar, type_ar, stoc_ar, 
nom_fo,prix_achat, prix_vente 
from articles join fournisseur using(id_fo) order by type_ar asc");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center" frame="border">';

echo '<tr><th>N°</th>
		<th>ARTICLE</th>
		<th>REFERENCE</th>
		<th>STOCKS</th>
		<th>FOURNISSEURS</th>
		<th>PRIX-ACHAT</th>
		<th>PRIX-VENTE</th>
		<!-- <th colspan="2">ACTION</th> --></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td align="right">'.number_format($ligne['stoc_ar'],0,' ',' ').'</td>';
	echo '<td>'.$ligne['nom_fo'].'</td>';
	echo '<td align="right">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	/*echo '<td><a href="mod_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										'&stoc_ar='.$ligne['stoc_ar'].
										 '&id_ar='.$ligne['id_ar'].
										 '&id_fo='.$ligne['id_fo'].
										 '&nom_fo='.$ligne['nom_fo'].
										 '&prix_achat='.$ligne['prix_achat'].
										 '&prix_vente='.$ligne['prix_vente'].
										 '"><input type="button" name="mod" value="Modifier" /></a></td>';
										 
	echo '<td><a href="sup_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										 '&id_ar='.$ligne['id_ar'].
										 '"><input type="button" name="sup" value="Supprimer" /></a></td>';*/
	
	echo '</tr>';
	$i++;
	}

echo '</table>';

?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>




</page>