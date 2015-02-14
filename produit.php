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
	<a href="/html2pdf/pdf/produit2.php" title="Inventaire en format pdf"> 
		<img src="images/pdf/pdf.png" width="6%" height="10%" alt="" align="right" border="0" />	
	</a>
	
		<?php
		if (isset($_POST['role1'])){
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_pro.php');
			if ($role1=='ajouter')
				include_once('insert_pro.php');
			if ($role1=='supprimer')
				include_once('delete_pro.php');}
$resultat=pg_query($connexion, "SELECT id_pr, lib_ar,type_ar,nom_bo,pvente,stoc_ar 
from produits join articles using(id_ar) join boutiques using(id_bo) where id_bo=$uti 
order by stoc_ar desc");

echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">LISTE DES PRODUITS</h5></th></tr>';
echo '<tr class="header3 bw">
       <td colspan="8">';
//echo	'<a href="ajo_pro.php">
	//			<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un produit</button></a>';
//echo  '<a href="produitr.php">
//				<button id="myb"  class="ui-state-active ui-corner-all boutons">Recherche article</button></a></td>
//			</tr>';
echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th class="lgauche">ARTICLE</th>
		<th class="lgauche">REFERENCE</th>';
//echo	'<th class="lgauche">AGENCE</th>';
echo	'<th class="ldroite">STOCKS</th>';	
echo	'<th class="ldroite">PRIX-VENTE</th>';
if( $_SESSION['gid'] ==1000) {	
echo	'<th colspan="2" class="lcentre">ACTION</th>';
 }	
echo	'</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	//echo '<td>'.$ligne['nom_bo'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['stoc_ar'],0,' ',' ').'</td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['pvente'],0,' ',' ').'<sup>F</sup></td>';
	if( $_SESSION['gid'] ==1000) {	
	echo '<td><a href="mod_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										 '&id_pr='.$ligne['id_pr'].
										 '&pvente='.$ligne['pvente'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
									 
	echo '<td><a href="sup_pro.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										 '&id_pr='.$ligne['id_pr'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	 }
	echo '</tr>';
	$i++;
	}
	
echo '<tr class="header3 bw">
			<td colspan="8">';
//echo		'<a href="ajo_pro.php">
//				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un produit</button></a>';
echo		'</td>
			</tr>';
echo '</table>';

?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<!-- <?php
include_once('footer.php');
?> -->

