<?php
include_once('header.php');
include_once('connection.php');
	$id_ve=isset($_GET['id_ve'])?$_GET['id_ve']:$_POST['id_ve'];
	$client=isset($_GET['client'])?$_GET['client']:$_POST['client'];
	$date_ve=isset($_GET['date_ve'])?$_GET['date_ve']:$_POST['date_ve'];
	/*
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];
	*/

?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong> CONTENU VENTE </strong></em></h1>
	<!-- <a href="/html2pdf/pdf/facture.php?id_ve=<?php echo $id_ve ?>
												&client=<?php echo $client ?>
												&date_ve=<?php echo $date_ve ?>
												">PDF</a> -->
	<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_cve.php');
			if ($role1=='ajouter')
				include_once('insert_cve.php');
			if ($role1=='supprimer')
				include_once('delete_cve.php');
			if ($role1=='valider')
				include_once('update_val_cve.php');
			if ($role1=='payer')
				include_once('update_pay_ve.php');
$resultat=pg_query($connexion, "SELECT ventes_con.*, lib_ar, type_ar 
from ventes_con join articles using(id_ar) where id_ve=$id_ve");

$rvente=pg_query($connexion, "SELECT * from ventes where id_ve=$id_ve");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar 
from articles where id_ar not in (select id_ar from ventes_con where id_ve=$id_ve)");

$resultat4=pg_query($connexion, "SELECT * from ventes where id_ve=$id_ve ");
$ligne=pg_fetch_assoc($resultat4);
$lvente=pg_fetch_assoc($rvente);
$etat_fac=$ligne['etat_ve'];
echo '<table cellpadding="10" cellspacing="0" border="1" align="left">';
echo '<tr>';
echo '<th>CLIENT </th>';
echo '<td>'.$client.'</td>';
echo '</tr>';
echo '<tr>';
echo '<th>DATE</th>';
echo '<td>'.$date_ve.'</td>';
echo '</tr>';
//echo '<th>FACTURE N°</th>';
//echo '<td>'.$num.''.$id_ve.'</td>';
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table cellpadding="10" cellspacing="0" border="1" align="center">';
echo '<tr>
			<th>N°</th>
			
			<th colspan="2">DESIGNATION</th>
			<th>QUANTITE</th>
			<th>PRIX-UNITAIRE</th>
			<th>MONTANT</th>
			<th>ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
 	
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td align="center">'.number_format($ligne['qte_ar'],0,' ',' ').'</td>';
	echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	if($ligne['etat']==0) {
	echo '<td>
				<a href="retire_ve.php?id_ve='.$ligne['id_ve'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&client='.$client.
										 '&date_ve='.$date_ve.
										 '&somme='.$lvente['somme'].
										 '&payee='.$lvente['payee'].
				 						 '&reste='.$lvente['reste'].
										 '"><input type="button" name="mod" value="Retirer" /></a>
			</td>';
			
	}
	else { echo '<td>VALIDER</td>';}
	echo '</tr>';
	//$som=$som+$ligne['montant'];
	//$srp=$srp-$ligne['montant'];
	$i++;
	}
?>
<tr>
<td colspan="5" align="right" class="prix">
<strong><em><div style="text-align: center">PRIX TOTAL</div></em></strong></td>
<td colspan="2" align="right" class="som">
	<strong><em>
	<?php echo number_format($lvente['somme'],0,' ',' ').'<sup>F</sup>' ?>
	</em></strong></td>
</tr>

<tr>
<td colspan="5" align="center" class="prix"><strong>SOMME PAYEE</strong></td>
<td colspan="2" align="right" class="som">
<strong><?php echo number_format($lvente['payee'],0,' ',' ').'<sup>F</sup>' ?></strong></td>
</tr>

<tr>
<td colspan="4" align="center" class="prix"><strong>RESTE A PAYEE</strong></td>
<td colspan="2" align="right" class="som">
<strong><?php echo number_format($lvente['reste'],0,' ',' ').'<sup>F</sup>' ?></strong></td>

<td>
<a href="payee_ve.php?id_ve=<?php echo $id_ve?>
			&client=<?php echo $client?>
			&date_ve=<?php echo $date_ve?>
			&somme=<?php echo $lvente['somme']?>
			&payee=<?php echo $lvente['payee']?>
			&reste=<?php echo $lvente['reste']?>"><input type="submit" name="val" value="PAYEE" /></a>
</td>
</tr>

<?php if($etat_fac!=2){ ?>
<tr>
<td colspan="4" style="text-align: center; ">
					<a href="mod_cont_ve.php?id_ve=<?php echo $id_ve?>
					&client=<?php echo $client?>
					&date_ve=<?php echo $date_ve?>
					&somme=<?php echo $lvente['somme']?>
					&payee=<?php echo $lvente['payee']?>
					&reste=<?php echo $lvente['reste']?>">
<input type="button" name="mod" value="modifier" /></a></td>

<td colspan="3" style="text-align: center; ">

<a href="val_ve.php?id_ve=<?php echo $id_ve?>
			&client=<?php echo $client?>
			&date_ve=<?php echo $date_ve?>
			&somme=<?php echo $lvente['somme']?>
			&payee=<?php echo $lvente['payee']?>
			&reste=<?php echo $lvente['reste']?>"><input type="button" name="val" value="Valider vente" />
			</a></td>
</tr>
<?php } ?>
</table>
<hr align="center" size="2" width="100%" noshade="noshade" />
<?php if($etat_fac!=2){ ?>
	<h2 align="left"><em><strong> AJOUT DE NOUVEAUX PRODUITS </strong></em></h2>								  
<form action="ventes_con.php?id_ve=<?php echo $id_ve?>
					&client=<?php echo $client?>
					&date_ve=<?php echo $date_ve?>
					&somme=<?php echo $lvente['somme']?>
					&payee=<?php echo $lvente['payee']?>
					&reste=<?php echo $lvente['reste']?>" method="post">
<table>
<tr>
<th><em>PRODUIT</em></th>
<th><em>QUANTITE</em></th>
</tr>
<tr>
<td><select name="id_ar" size="0">
<?php
	while($ligne=pg_fetch_assoc($resultat3))
	{
		echo '<option value="'.$ligne['id_ar'].'">';
		echo $ligne['lib_ar'].'  '.$ligne['type_ar'].'</option>';
	}
?>
</select></td>
<td>
	<input type=text name="qte_ar" size="5" value="1">
	<input type=hidden name="id_ve" value="<?php echo $id_ve?>">
	<!-- <input type=hidden name="client" value="<?php echo $client?>">
	<input type=hidden name="date_ve" value="<?php echo $date_ve?>"> -->
	<input type=hidden name="role1" value="ajouter">
</td>
</tr>
<tr><td><input type="submit" name="val" value="Valider" /></td></tr>
</table>
<?php } ?>
<hr align="left" size="2" width="100%" noshade>
<a href="ventes2.php"><input type="button" name="retour" value="Liste des ventes" />
</form>
		
	</div>
	<div></a></div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

