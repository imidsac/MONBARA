<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<a href="/html2pdf/pdf/produit2.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des produits(PDF)</button></a>
	<h1 align="center"><strong>LISTE DES PRODUITS</strong></h1>
		<?php
		
		/*$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_pro.php');
			if ($role1=='ajouter')
				include_once('insert_pro.php');
			if ($role1=='supprimer')
				include_once('delete_pro.php');*/
$resultat=pg_query($connexion, "SELECT id_fo,id_ar,lib_ar, type_ar, stoc_ar, 
nom_fo,prix_achat, prix_vente 
from articles join fournisseur using(id_fo) where lib_ar ilike '$_POST[lib_ar]%' order by lib_ar asc");
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw">
			<td colspan="9">';
	if($_SESSION['privilege'] == "admin") {
	echo	'<a href="ajo_pro.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un produit</button></a>';
				}
	echo	'<a href="produitr.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Rechercher</button></a>
			</td>
</tr>';	

/*echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';*/
echo '<form action="produitr2.php" method="post">';

	echo '<tr><th class="header3 ldroite">RECHERCHE</th><td colspan="6"><input type="text" name="lib_ar" size="80" class="text header1 ui-corner-all" /></td>';
	echo  '</tr>';
	echo '<tr>
	<td>
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	</form>
	<td>
	<a href="produit.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
	</td>
	</tr>';
/*echo '</table>';*/

echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th class="lgauche">ARTICLE</th>
		<th class="lgauche">REFERENCE</th>';
		//if($_SESSION['privilege'] == "admin") {
echo	'<th class="lgauche">FOURNISSEURS</th>';
	//	}
echo	'<th class="ldroite">STOCKS</th>';
		//if($_SESSION['privilege'] == "admin") {
echo	'<th class="ldroite">PRIX-ACHAT</th>';
		//}
echo	'<th class="ldroite">PRIX-VENTE</th>';
		//if($_SESSION['privilege'] == "admin") {
echo	'<th colspan="2" class="lcentre">ACTION</th>';
		//}		
echo	'</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	//if($_SESSION['privilege'] == "admin") {
	echo '<td>'.$ligne['nom_fo'].'</td>';
	//}
	echo '<td class="ldroite cnoire">'.number_format($ligne['stoc_ar'],0,' ',' ').'</td>';
	//if($_SESSION['privilege'] == "admin") {
	echo '<td class="ldroite crouge">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	//}
	echo '<td class="ldroite cbleu">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	
	echo '<td><a href="mod_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										//'&stoc_ar='.$ligne['stoc_ar'].
										 '&id_ar='.$ligne['id_ar'].
										 '&id_fo='.$ligne['id_fo'].
										 '&nom_fo='.$ligne['nom_fo'].
										 '&prix_achat='.$ligne['prix_achat'].
										 '&prix_vente='.$ligne['prix_vente'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
	if($_SESSION['privilege'] == "admin") {									 
	echo '<td><a href="sup_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										 '&id_ar='.$ligne['id_ar'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	}
	echo '</tr>';
	$i++;
	}
	
echo '<tr class="header3 bw">
			<td colspan="9">';
			//if($_SESSION['privilege'] == "admin") {
echo		'<a href="ajo_pro.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un produit</button></a>';
				//}
echo		'</td>
			</tr>';
echo '</table>';

?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

