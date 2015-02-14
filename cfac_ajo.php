<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

//$nom_cl=$_GET['nom_cl'];
/*
	$id_fac=isset($_GET['id_fac'])?$_GET['id_fac']:$_POST['id_fac'];
	$client=isset($_GET['client'])?$_GET['client']:$_POST['client'];
	$date_fac=isset($_GET['date_fac'])?$_GET['date_fac']:$_POST['date_fac'];
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];
	*/
	$client=$_POST['client'];
	$nom_cl=$_POST['nom_cl'];
	$prenom_cl=$_POST['prenom_cl'];
	$add_cl=$_POST['add_cl'];
	$tel1_cl=$_POST['tel1_cl'];
	$date_fac=$_POST['date_fac'];
	include_once('insert_fac.php');
	$rfac=pg_query($connexion, "SELECT max(id_fac) as id_fac from facture");
	$lfac=pg_fetch_assoc($rfac);
	$id_fac=$lfac['id_fac'];
	$rclients=pg_query($connexion, "SELECT facture.*,nom_cl,prenom_cl,add_cl,tel1_cl 
	from facture join clients using(id_cl) where id_fac=$id_fac");
	$lcl=pg_fetch_assoc($rclients);
	$nom_cl=$lcl['nom_cl'];
	$prenom_cl=$lcl['prenom_cl'];
	$add_cl=$lcl['add_cl'];
	$tel1_cl=$lcl['tel1_cl'];
	
$num=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>
	<div id="colTwo">
	<h1 align="center"><strong> CONTENU VENTE </strong></h1>
	<!-- <a href="/html2pdf/pdf/facture.php?id_fac=<?php echo $id_fac ?>
												&client=<?php echo $client ?>
												&date_fac=<?php echo $date_fac ?>
												">PDF</a> -->
	<?php
		//$role1=$_POST['role1'];
		//	if ($role1=='modifier')
		//		include_once('update_cfac.php');
		//	if ($role1=='ajouter')
				include_once('insert_cfac.php');
		//	if ($role1=='supprimer')
		//		include_once('delete_cfac.php');
		//	if ($role1=='valider')
		//		include_once('update_val_cfac.php');
		//	if ($role1=='payer')
		//		include_once('update_pay_fac.php');
$resultat=pg_query($connexion, "SELECT facture_con.*, type_ar,lib_ar
from facture_con join articles using(id_ar) 
where id_fac=$id_fac ORDER BY lib_ar, type_ar desc");

$rfac=pg_query($connexion, "SELECT * from facture where id_fac=$id_fac");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar,prix_vente
from articles  
where id_ar not in (select id_ar from facture_con 
where id_fac=$id_fac) order by lib_ar,type_ar asc");

$resultat4=pg_query($connexion, "SELECT * from facture where id_fac=$id_fac ");
$ligne=pg_fetch_assoc($resultat4);
$lfac=pg_fetch_assoc($rfac);
$etat_fac=$ligne['etat_fac'];
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">CLIENT </th>';
echo '<td align="center">'.$nom_cl.'  '.$prenom_cl.'</td>'; 
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE</th>';
echo '<td align="center">'.$date_fac.'</td>';
echo '</tr>';
echo '<th class="header3 ldroite">FACTURE N°</th>';
echo '<td class="ldroite crouge"><strong>'.$num.''.$id_fac.'</strong></td>';
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
	echo '<td><a href="retire_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&client='.$client.
										 '&date_fac='.$date_fac.
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
<?php if($etat_fac!=2){ ?>
	<h2 align="center"><strong> SELECTIONNEZ DES NOUVEAUX PRODUITS </strong></h2>								  
<form action="cfac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&add_cl=<?php echo $add_cl?>
			&tel1_cl=<?php echo $tel1_cl?>
			&date_fac=<?php echo $date_fac?>
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
	<input type=hidden name="id_fac" value="<?php echo $id_fac?>">
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
<a href="vente_fac_moi.php?&&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des factures</button></a>

		
	</div>
	<!-- <div></a></div> -->
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

