<?php
include_once('header.php');
$connexion=pg_connect("dbname=dbquin host=localhost user=etudiant1 password=alfarouk");
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>LISTE DES ACHATS</strong></em></h1>
		<?php
		$som=0;
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_fac.php');
			if ($role1=='ajouter')
				include_once('insert_fac.php');
			if ($role1=='supprimer')
				include_once('delete_fac.php');
$resultat=pg_query($connexion, "SELECT debit,nom_fo, a_date, etat_a from achat join fournisseur using(id_fo) order by a_date desc");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center" frame="border">';
echo '<tr><th>N°</th><th>DATE</th><th>FOURNISSEUR</th><th>SOMME</th><th>ETAT</th><th colspan="2">ACTION</th><th>CONTENUE</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['a_date'].'</td>';
	echo '<td>'.$ligne['nom_fo'].'</td>';
	echo '<td>'.$ligne['debit'].'<sup>F</sup></td>';
	if($ligne['etat_a']=='0') 
			echo '<td>Non Livrée</td>';
	if($ligne['etat_a']=='1')
			echo '<td>Partielment Livrée</td>';
	if($ligne['etat_a']=='2')
			echo '<td>Totalment Livrée</td>';
	echo '<td><a href="mod_achat1.php?a_date='.$ligne['a_date'].
										'&nom_fo='.$ligne['nom_fo'].
										 '&debit='.$ligne['debit'].
										 '&id_acha='.$ligne['id_acha'].
										 '"><input type="button" name="mod" value="Modifier" /></a></td>';
										 
	echo '<td><a href="sup_achat1.php?client='.$ligne['nom_fo'].
										'&a_date='.$ligne['a_date'].
										 '&id_acha='.$ligne['id_acha'].'"><input type="button" name="sup" value="Supprimer" /></a></td>';
										 
	echo '<td><a href="co_achat.php?id_acha='.$ligne['id_acha'].
												'&nom_fo='.$ligne['nom_fo'].
												'&a_date='.$ligne['a_date'].
												'"><input type="button" name="cont" value="CONTENUE" /></a></td>';	
	
	echo '</tr>';
	$i++;
	}
echo '<tr><td colspan="8"><a href="ajo_achat1.php"><input type="button" name="ajout" value="Ajouter une facture" /></a></td></tr>';
echo '</table>';

?>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

