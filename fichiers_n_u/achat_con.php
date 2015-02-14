<?php
include_once('header.php');
include_once('connection.php');
	$id_co=isset($_GET['id_co'])?$_GET['id_co']:$_POST['id_co'];
	$nom_cl=isset($_GET['nom_cl'])?$_GET['nom_cl']:$_POST['nom_cl'];
	$prenom_cl=isset($_GET['prenom_cl'])?$_GET['prenom_cl']:$_POST['prenom_cl'];
	$date2=isset($_GET['date2'])?$_GET['date2']:$_POST['date2'];
$som=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>CONTENU COMMANDES</strong></em></h1>
		<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_cco.php');
			if ($role1=='ajouter')
				include_once('insert_cco.php');
			if ($role1=='supprimer')
				include_once('delete_cco.php');
$resultat1=pg_query($connexion, "SELECT ccommandes.*, lib_ar, type_ar,prix_vente,(prix_vente*qt_ar) as montant 
from ccommandes join articles using(id_ar) where id_co=$id_co");
$resultat2=pg_query($connexion, "SELECT nom_cl, prenom_cl, date2 
from commandes join clients using(id_cl) where id_co=$id_co");
$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar 
from articles where id_ar not in (select id_ar from ccommandes where id_co=$id_co)");
$resultat4=pg_query($connexion, "SELECT * from commandes where id_co=$id_co ");
$ligne=pg_fetch_assoc($resultat4);
$etat_co=$ligne['etat_co'];
echo '<table cellpadding="10" cellspacing="0" border="1" align="left">';
echo '<tr>';
echo '<th>Client </th>';
echo '<td>'.$nom_cl.'	'.$prenom_cl.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>Date de livraison </th>';
echo '<td>'.$date2.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table cellpadding="10" cellspacing="0" border="1" align="center">';
echo '<tr><th colspan="2">PRODUIT</th><th>QUANTITE</th><th>PRIX-UNITAIRE</th><th>MONTANT</th><th>ACTION</th></tr>';
while ($ligne=pg_fetch_assoc($resultat1))
 {
 	echo '<tr>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['qt_ar'].'</td>';
	echo '<td>'.$ligne['prix_vente'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['montant'].'<sup>F</sup></td>';
	
	if($ligne['etat']==0) {
	echo '<td><a href="retire_co.php?id_co='.$ligne['id_co'].
										'&id_ar='.$ligne['id_ar'].
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&date2='.$date2.
										 '"><input type="button" name="mod" value="Retirer" /></a></td>';
	}
	else { echo '<td>livré</td>';}
	
	echo '</tr>';
	$som=$som+$ligne['montant'];
	
	}
?>
<tr>
<td colspan="3" align="center" class="prix"><strong>PRIX TOTAL</strong></td>
<td colspan="3" align="center" class="som"><strong><?php echo $som.'<sup>F</sup>' ?></strong></td>
</tr>
<?php if($etat_co!=2){ ?>
<tr><td colspan="6"><a href="mod_cont_co.php?id_co=<?php echo $id_co?>
										&nom_cl=<?php echo $nom_cl?>
										&prenom_cl=<?php echo $prenom_cl?>
										&date2=<?php echo $date2?>">
										<input type="button" name="mod" value="modifier" /></a></td></tr>
<?php } ?>
</table>
<hr align="right" size="2" width="100%" noshade="noshade" />
<?php if($etat_co!=2){ ?>
	<h2 align="left"><em><strong> AJOUT DE NOUVEAUX PRODUITS </strong></em></h2>								  
<form action="ccommande.php?id_co=<?php echo $id_co?>&nom_cl=<?php echo $nom_cl?>&prenom_cl=<?php echo $prenom_cl?>&date2=<?php echo $date2?>" method="post">
<table>
<tr>
<th>PRODUITS</th>
<th>QUANTITE</th>
</tr>
<tr>
<td><select name="id_ar" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat3))
	{
		echo '<option value="'.$ligne['id_ar'].'">';
		echo $ligne['lib_ar'].' type '.$ligne['type_ar'].'</option>';
	}
?>
</select></td>
<td>
	<input type="text" name="qt_ar" size="5" value="1">
	<input type="hidden" name="id_co" value="<?php echo $id_co?>">
	<input type="hidden" name="role1" value="ajouter">
</td>
</tr>
<tr><td><input type="submit" name="val" value="Valider" /></td></tr>
</table>
<?php } ?>
<hr align="left" size="2" width="100%" noshade>
<a href="commande.php"><input type="button" name="retour" value="Liste des Commandes" />

</form>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

