<?php
include_once('connection.php');
include_once('session.php');
include_once('header.php');
//$nom_bo=$_GET['nom_bo'];

	//$id_tr=isset($_GET['id_tr'])?$_GET['id_tr']:$_POST['id_tr'];
	$nom_bo=isset($_GET['nom_bo'])?$_GET['nom_bo']:$_POST['nom_bo'];
	$adr_bo=isset($_GET['adr_bo'])?$_GET['adr_bo']:$_POST['adr_bo'];
	$date_tr=isset($_GET['date_tr'])?$_GET['date_tr']:$_POST['date_tr'];
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];
	
	
	//$nom_bo=$_POST['nom_bo'];
	//$adr_bo=$_POST['adr_bo'];
	
	$date_tr=$_POST['date_tr'];
	include_once('insert_tr.php');
	$rfac=pg_query($connexion, "SELECT max(id_tr) as id_tr from transferts");
	$lfac=pg_fetch_assoc($rfac);
	$id_tr=$lfac['id_tr'];
	$rclients=pg_query($connexion, "SELECT transferts.*,nom_bo,adr_bo 
	from transferts join boutiques using(id_bo) where id_tr=$id_tr");
	$lcl=pg_fetch_assoc($rclients);
	$nom_bo=$lcl['nom_bo'];
	
$num=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>
	<div id="colTwo">
	<h1 align="center"><strong> CONTENU TRANSFERTS </strong></h1>
	
	<?php
		//$role1=$_POST['role1'];
		//	if ($role1=='modifier')
		//		include_once('update_ctr.php');
		//	if ($role1=='ajouter')
				include_once('insert_ctr.php');
		//	if ($role1=='supprimer')
		//		include_once('delete_ctr.php');
		//	if ($role1=='valider')
		//		include_once('update_val_ctr.php');
		//	if ($role1=='payer')
		//		include_once('update_pay_fac.php');
$resultat=pg_query($connexion, "SELECT transferts_con.*, type_ar,lib_ar
from transferts_con join articles using(id_ar) 
where id_tr=$id_tr ORDER BY lib_ar, type_ar desc");

$rfac=pg_query($connexion, "SELECT * from transferts where id_tr=$id_tr");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar,prix_vente
from articles  
where id_ar not in (select id_ar from transferts_con 
where id_tr=$id_tr) order by lib_ar,type_ar asc");

$resultat4=pg_query($connexion, "SELECT * from transferts where id_tr=$id_tr ");
$ligne=pg_fetch_assoc($resultat4);
$lfac=pg_fetch_assoc($rfac);
$etat_tr=$ligne['etat_tr'];
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_bo.'  '.$ligne['adr_bo'].'</td>'; 
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE</th>';
echo '<td align="center">'.$date_tr.'</td>';
echo '</tr>';
echo '<th class="header3 ldroite">TRANSFERTS N°</th>';
echo '<td class="ldroite crouge"><strong>'.$num.''.$id_tr.'</strong></td>';
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			
			<th colspan="2" class="lgauche">DESIGNATION</th>
			<!-- <th>TYPE</th> -->
			<th class="lcentre">Q.T</th>
			<th class="lcentre">Q.T-LIVRAIS</th>
			<th class="lcentre">Q.T-R.LIVRAIS</th>
			<th class="ldroite">PRIX-UNITAIRE</th>
			<th class="ldroite">MONTANT</th>
			 <th colspan="2" class="lcentre">ACTION</th> 
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
 	echo '<td>'.$ligne['qte_ar'].'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['prix_vente'].'<sup>F</sup></td>';
	echo '<td>'.$ligne['montant'].'<sup>F</sup></td>';
	if($ligne['etat']==0) {
	echo '<td><a href="retire_fac.php?id_tr='.$ligne['id_tr'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&client='.$client.
										 '&date_tr='.$date_tr.
										 '&somme='.$lfac['somme'].
										 '&payee='.$lfac['payee'].
				 						 '&reste='.$lfac['reste'].
										 '"><input type="button" name="mod" value="RETIRER" /></a></td>';
	}
	else { echo '<td>VALIDER</td>';}
	echo '</tr>';
	//$som=$som+$ligne['montant'];
	//$srp=$srp-$ligne['montant'];
	$i++;
	}
?>
<tr class="header2 lgauche bw">
<td colspan="5" align="right" class="prix"><strong><em><div style="text-align: center">PRIX TOTAL</div></em></strong></td>
<td colspan=3" align="right" class="ldroite crouge"><strong><em>
<?php echo   number_format($lfac['somme'],0,' ',' ').'<sup>F</sup>' ?></em></strong></td>
<td></td>
<td></td>
</tr>

<tr class="header2 bw">
<td colspan="5" align="center" class="prix"><strong>SOMME PAYEE</strong></td>
<td colspan="3" align="right" class="ldroite cbleu">
<strong><?php echo number_format($lfac['payee'],0,' ',' ').'<sup>F</sup>' ?></strong></td>
<td></td>
<td></td>
</tr>

<tr class="header2 bw">
<td colspan="5" align="center" class="prix"><strong>RESTE A PAYEE</strong></td>
<td colspan="3" align="right" class="ldroite crouge">
<strong><?php echo number_format($lfac['reste'],0,' ',' ').'<sup>F</sup>' ?></strong></td>
<td>

</td>
<td></td>
</tr>


<tr>
<td colspan="4" style="text-align: center; ">
</td>

<td colspan="3" style="text-align: center; ">
	
</td>
<td></td>
</tr>
</table>
<hr align="center" size="2" width="100%" noshade="noshade" class="header3 bw"/>
<?php if($etat_tr!=2){ ?>
	<h2 align="center"><strong> SELECTIONNEZ DES NOUVEAUX PRODUITS </strong></h2>								  
<form action="ctr.php?id_tr=<?php echo $id_tr?>
			&nom_bo=<?php echo $nom_bo?>
			&adr_bo=<?php echo $adr_bo?>
			&date_tr=<?php echo $date_tr?>
			&somme=<?php echo $lfac['somme']?>
			&payee=<?php echo $lfac['payee']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>
			&reste=<?php echo $lfac['reste']?>" 
			method="post">
<table>
<tr>
<th><em>PRODUIT</em></th>
<th><em>QUANTITE</em></th>
<th><em>PRIX-UNITAIRE</em></th>
</tr>
<tr>
<td><select name="id_ar" size="0" id="myb" class="ui-state-active ui-corner-all boutons">
<?php
	while($ligne=pg_fetch_assoc($resultat3))
	{
		echo '<option value="'.$ligne['id_ar'].'">';
		echo $ligne['lib_ar'].'  
			'.$ligne['type_ar'].'
		    '.$ligne['prix_vente'].'
		    </option>';
	}
?>
</select></td>
<td>
	<input type=text name="qte_ar" size="15" value="1">
	<input type=hidden name="id_tr" value="<?php echo $id_tr?>">
	<input type=hidden name="role1" value="ajouter">
</td>
<td>
	<input type=text name="p_u" size="15" value="0">
</td>
</tr>
<tr><td><input type="submit" name="val" value="VALIDER" id="myb" class="ui-state-active ui-corner-all boutons" /></td></tr>
</table>
<?php } ?>
</form>
<hr align="left" size="2" width="100%" noshade class="header3 bw">
<a href="vente_tr_moi.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des transfertss</button></a>

		
	</div>
	<!-- <div></a></div> -->
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

