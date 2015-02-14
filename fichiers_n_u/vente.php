<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>VENTE SIMPLE</strong></em></h1>
		<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_vente.php');
			if ($role1=='ajouter')
				include_once('insert_vente.php');
			if ($role1=='supprimer')
				include_once('delete_vente.php');
$resultat=pg_query($connexion, "SELECT id_ve,date_ve, lib_ar, type_ar, qt_ar, prix_vente, debit, credit, (credit-debit) as solde 
from ventes join articles using(id_ar) order by date_ve desc");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center" frame="border">';
echo '<tr><th>N°</th><th>DATE</th><th>DESIGNATION</th><th>REFERENCE</th><th>QTE</th><th>P.U</th><th>DEBIT</th><th>CREDIT</th><th>SOLDE</th><th colspan="2">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['date_ve'].'</td>';	
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['qt_ar'].'</td>';
	echo '<td>'.$ligne['prix_vente'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['debit'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['credit'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['solde'].'<sup>F</sup></td>';
	echo '<td><a href="mod_vente.php?date_ve='.$ligne['date_ve'].
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 //'&pu_ar='.$ligne['pu_ar'].
										 '&debit='.$ligne['debit'].
										// '&credit='.$ligne['credit'].
										 '&id_ve='.$ligne['id_ve'].
										 '"><input type="button" name="mod" value="Modifier" /></a></td>';
										 
	echo '<td><a href="sup_vente.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										'&date_ve='.$ligne['date_ve'].
										'&qt_ar='.$ligne['qt_ar'].
										'&id_ve='.$ligne['id_ve'].
										 '"><input type="button" name="sup" value="Supprimer" /></a></td>';
	
	echo '</tr>';
	$i++;
	}
echo '<tr><td colspan="11"><a href="ajo_vente.php"><input type="button" name="ajout" value="Faire une vente" /></a></td></tr>';
echo '</table>';

?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

