<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>LISTE D'ACHATS</strong></em></h1>
		<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_achat.php');
			if ($role1=='ajouter')
				include_once('insert_achat.php');
			if ($role1=='supprimer')
				include_once('delete_achat.php');
$resultat=pg_query($connexion, "SELECT id_acha, id_ar, a_date, lib_ar, type_ar, qt_ar, nom_fo, prix_achat, debit, credit, 
(credit-debit) as solde 
from achat join fournisseur using(id_fo) join articles using(id_ar) order by a_date desc");
echo '<table cellpadding="5" cellspacing="0" border="1" align="center">';
echo '<tr><th>N°</th><th>DATE</th><th>DESIGNATION</th><th>REFERENCE</th><th>QTE</th><th>FOURNISSEURS</th>
<th>PRIX-UNITAIRE</th><th>DEBIT</th><th>CREDIT</th><th>SOLDE</th><th colspan="2">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['a_date'].'</td>';	
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['qt_ar'].'</td>';
	echo '<td>'.$ligne['nom_fo'].'</td>';
	echo '<td>'.$ligne['prix_achat'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['debit'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['credit'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['solde'].'<sup>F</sup></td>';
	echo '<td><a href="mod_acha.php?a_date='.$ligne['a_date'].
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 '&nom_fo='.$ligne['nom_fo'].
										 //'&pu_ar='.$ligne['pu_ar'].
										 '&debit='.$ligne['debit'].
										 //'&credit='.$ligne['credit'].
										 //'&solde='.$ligne['solde'].
										 '&id_acha='.$ligne['id_acha'].
										 '&id_ar='.$ligne['id_ar'].
										 '&id_fo='.$ligne['id_fo'].
										 '"><input type="button" name="mod" value="Modifier" /></a></td>';
										 
	echo '<td><a href="sup_acha.php?lib_ar='.$ligne['lib_ar'].
										'&type_ar='.$ligne['type_ar'].
										'&a_date='.$ligne['a_date'].
										'&qt_ar='.$ligne['qt_ar'].
										'&id_acha='.$ligne['id_acha'].
										 '"><input type="button" name="sup" value="Supprimer" /></a></td>';
	
	
	echo '</tr>';
	$i++;
	}
echo '<tr><td colspan="12"><a href="ajo_acha.php"><input type="button" name="ajout" value="Faire un achat" /></a></td></tr>';
echo '</table>';

?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

