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
	<a href="/html2pdf/pdf/produit.php">Liste des produits</a>
	<h1 align="center"><em><strong>LISTE DES PRODUITS</strong></em></h1>
		<?php
		$lib_ar=$_POST['lib_ar'];
		/*$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_pro.php');
			if ($role1=='ajouter')
				include_once('insert_pro.php');
			if ($role1=='supprimer')
				include_once('delete_pro.php');*/
$resultat=pg_query($connexion, "SELECT * from articles where lib_ar ilike '$_POST[$lib_ar%]' order by type_ar asc");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center" frame="border">';
echo '<tr>
			<td colspan="9"><a href="ajo_pro.php">
				<input type="button" name="ajout" value="Ajouter un produit" /></a></td>
		</tr>';
echo '<tr><th>N°</th>
		<th>ARTICLE</th>
		<th>REFERENCE</th>
		<th>STOCKS</th>
		<th>FOURNISSEURS</th>
		<th>PRIX-ACHAT</th>
		<th>PRIX-VENTE</th>
		<th colspan="2">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.number_format($ligne['stoc_ar'],0,' ',' ').'</td>';
	echo '<td>'.$ligne['nom_fo'].'</td>';
	echo '<td align="right">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td><a href="mod_pro.php?lib_ar='.$ligne['lib_ar'].
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
										 '"><input type="button" name="sup" value="Supprimer" /></a></td>';
	
	echo '</tr>';
	$i++;
	}
	
echo '<tr>
			<td colspan="9"><a href="ajo_pro.php">
				<input type="button" name="ajout" value="Ajouter un produit" /></a></td>
		</tr>';
echo '</table>';

?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

