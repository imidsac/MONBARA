<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
include('Conversion.php');
$id_fac=isset($_GET['id_fac'])?$_GET['id_fac']:$_POST['id_fac'];
	$nom_cl=isset($_GET['nom_cl'])?$_GET['nom_cl']:$_POST['nom_cl'];
	$prenom_cl=isset($_GET['prenom_cl'])?$_GET['prenom_cl']:$_POST['prenom_cl'];
	$add_cl=isset($_GET['add_cl'])?$_GET['add_cl']:$_POST['add_cl'];
	$tel1_cl=isset($_GET['tel1_cl'])?$_GET['tel1_cl']:$_POST['tel1_cl'];
	$date_fac=isset($_GET['date_fac'])?$_GET['date_fac']:$_POST['date_fac'];
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];
	$rclients=pg_query($connexion, "SELECT facture.*,nom_cl,prenom_cl,add_cl,tel1_cl 
	from facture join clients using(id_cl) where id_fac=$id_fac");
	$lcl=pg_fetch_assoc($rclients);
	$nom_cl=$lcl['nom_cl'];
	$prenom_cl=$lcl['prenom_cl'];
	$add_cl=$lcl['add_cl'];
	$tel1_cl=$lcl['tel1_cl'];
$num=0;

$lettre=new Conversion();
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');




	?>
	<div id="colTwo">
	
	<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_cfac.php');
			if ($role1=='ajouter')
				include_once('insert_cfac.php');
			if ($role1=='supprimer')
				include_once('delete_cfac.php');
			if ($role1=='valider')
				include_once('update_val_cfac.php');
			if ($role1=='annuler')
				include_once('update_anul_cfac.php');
			if ($role1=='payer')
				include_once('update_pay_fac.php');
			if ($role1=='livre')
				include_once('update_liv_cfac.php');
			if ($role1=='alivre')
				include_once('update_aliv_cfac.php');
$resultat=pg_query($connexion, "SELECT facture_con.*, type_ar,lib_ar
from facture_con join articles using(id_ar) 
where id_fac=$id_fac ORDER BY lib_ar, type_ar desc");
$resultat1=pg_query($connexion, "SELECT now()::date as dte1");
$rtr=pg_query($connexion, "SELECT *,(date_fac)::date as dte from facture where id_fac=$id_fac");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar,prix_vente
from articles  
where id_ar not in (select id_ar from facture_con 
where id_fac=$id_fac) order by lib_ar,type_ar asc");

$rmois=pg_query($connexion, "SELECT sum(qte_ar-qte_livres) as nb from facture_con where id_fac=$id_fac");
$rr=pg_fetch_assoc($rmois);
$nbar=pg_query($connexion, "select count(*) as ar from facture_con where id_fac=$id_fac");
$rar=pg_fetch_assoc($nbar);
$datej=pg_fetch_assoc($resultat1);
$resultat4=pg_query($connexion, "SELECT * from facture where id_fac=$id_fac ");
$ligne=pg_fetch_assoc($resultat4);
$etat_fac=$ligne['etat_fac'];
$ltr=pg_fetch_assoc($rtr);


echo '<h1 align="center"><strong> CONTENU VENTE </strong></h1>';
if($etat_fac=='t' || $_SESSION['gid'] == 1000){
	echo '<a href="html2pdf/pdf/facture3.php?id_fac='.$ligne['id_fac'].
												'&date_fac='.$ligne['date_fac'].
												'&nom_cl='.$nom_cl.
												'&prenom_cl='.$prenom_cl.
												'&add_cl='.$add_cl.
												'&tel1_cl='.$tel1_cl.
										 		'&date_fac='.$date_fac.
												'&somme='.$ligne['somme'].
												'&payee='.$ligne['payee'].
												'&reste='.$ligne['reste'].
												'" title="facture en format pdf">
												<img src="images/pdf/pdf.png" width="6%" height="10%" alt="" align="right" border="0" />												
												</a>';
}
if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo '<a href="ajo_fac.php?&bar='.$bar.'&mois='.$mois.'&annee='.$annee.'" title="Une nouvelle vente">
				<img src="images/pdf/vente1.png" width="6%" height="10%" alt="" align="right" border="0" />
				</a>';
}

echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">CLIENT </th>';
echo '<td align="center">'.$nom_cl.'  '.$prenom_cl.' </td>'; 
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">DATE</th>';
echo '<td align="center">'.$date_fac.'</td>';
echo '</tr>';
echo '<th class="header3 ldroite">facture N</th>';
echo '<td class="lcentre crouge"><strong>'.$num.''.$id_fac.'</strong></td>';
echo '</tr>';
echo '</table>';
echo '<br>';

//echo pg_result_error_field($res1, PGSQL_DIAG_SQLSTATE);
?>
<hr align="center" size="2" width="100%" noshade="noshade" class="header3 bw" />
<?php if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000) { ?>
<?php if($etat_fac!='t'){ ?>
	<h2 align="center"><strong> SELECTIONNEZ DES DE NOUVEAUX PRODUITS </strong></h2>								  

<table>
<form action="cfac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&date_fac=<?php echo $date_fac?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $_GET['bar']?>
			&reste=<?php echo $ltr['reste']?>" 
			method="post">
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
<tr><td><input type="submit" name="val" value="VALIDER" id="myb" class="ui-state-active ui-corner-all boutons" onclick="this.style.display ='none';"/></td></tr>
</form>
</table>
<?php } ?>
<?php } ?>

<hr align="left" size="2" width="100%" noshade  class="header3 bw">

<?php
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw">
<td colspan="10">
<a href="vente_fac_moi.php?&mois='.$mois.'&annee='.$annee.'&bar='.$bar.'">';?>
		
<button id="myb" type="button" class="ui-state-active ui-corner-all boutons"  onclick="this.style.display ='none';">LISTE DE VENTES</button>
<?php echo '
</a>
</td>
</tr>';

echo '<tr class="header2 lgauche bw">
			<th>N</th>
			<th colspan="2" class="lcentre">DESIGNATION</th>
			<th class="ldroite">Q.T</th>
			<th class="ldroite">Q.T-LIVRAIS</th>
			<th class="ldroite">Q.T-R.LIVRAIS</th>
			<th class="ldroite">PRIX-UNITAIRE</th>
			<th class="ldroite">MONTANT</th>';
			//if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
			echo ' <th colspan="2" class="lcentre">ACTION</th>'; 
			//}
		echo '</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td align="right">'.number_format($ligne['qte_ar'],0,' ',' ').'</td>';
	echo '<td align="right">'.number_format($ligne['qte_livres'],0,' ',' ').'</td>';
	echo '<td align="right">'.number_format($ligne['qte_ar']-$ligne['qte_livres'],0,' ',' ').'</td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
	if($ligne['qte_ar']-$ligne['qte_livres']!=0){																																																																																													
	echo '<td class="lcentre"><a href="liv_cont_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&qte_livres='.$ligne['qte_livres'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&add_cl='.$add_cl.
										 '&tel1_cl='.$tel1_cl.
										 '&date_fac='.$date_fac.
										 '&somme='.$ltr['somme'].
										 '&payee='.$ltr['payee'].
										 '&reste='.$ltr['reste'].
				 						 '&mois='.$mois.
				 						 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">LIVRAIS</button></a>
										 </td>';	
	}
	}
	if($_SESSION['gid'] ==1000)  {
		if($ligne['qte_ar']-$ligne['qte_livres']==0){	
		echo '<td class="lcentre">
	<a href="aliv_cont_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&qte_ar='.$ligne['qte_livres'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&date_fac='.$date_fac.
										 '&add_cl='.$add_cl.
										 '&tel1_cl='.$tel1_cl.
										 '&somme='.$ltr['somme'].
										 '&payee='.$ltr['payee'].
										 '&reste='.$ltr['reste'].
				 						 '&mois='.$mois.
				 						 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER LA LIVRAISON</button></a>
										 </td>';
		}
	}
   elseif($_SESSION['gid'] ==3) {
   	if($ligne['qte_ar']-$ligne['qte_livres']==0){	
		if($datej['dte1'] <= $ltr['dte']) {
			echo '<td class="lcentre">
	<a href="aliv_cont_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&qte_ar='.$ligne['qte_livres'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&date_fac='.$date_fac.
										 '&add_cl='.$add_cl.
										 '&tel1_cl='.$tel1_cl.
										 '&somme='.$ltr['somme'].
										 '&payee='.$ltr['payee'].
										 '&reste='.$ltr['reste'].
				 						 '&mois='.$mois.
				 						 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER LA LIVRAISON</button></a>
										 </td>';
		}
		else { echo '<td></td>';}
		}
	}
	else { echo '<td></td>';}
	if($_SESSION['gid'] ==1000) {
		echo '<td class="lcentre"><a href="retire_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&add_cl='.$add_cl.
										 '&tel1_cl='.$tel1_cl.
										 '&date_fac='.$date_fac.
										 '&somme='.$ltr['somme'].
										 '&payee='.$ltr['payee'].
				 						 '&reste='.$ltr['reste'].
				 						 '&mois='.$mois.
				 						 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">RETIRER</button></a></td>';	
	}
   elseif($_SESSION['gid'] ==3) {
		if($datej['dte1'] <= $ltr['dte']) {
			echo '<td class="lcentre"><a href="retire_fac.php?id_fac='.$ligne['id_fac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qte_ar='.$ligne['qte_ar'].
										 '&nom_cl='.$nom_cl.
										 '&prenom_cl='.$prenom_cl.
										 '&add_cl='.$add_cl.
										 '&tel1_cl='.$tel1_cl.
										 '&date_fac='.$date_fac.
										 '&somme='.$ltr['somme'].
										 '&payee='.$ltr['payee'].
				 						 '&reste='.$ltr['reste'].
				 						 '&mois='.$mois.
				 						 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">RETIRER</button></a></td>';
		}
		else { echo '<td></td>';}
	}
	else { echo '<td></td>';}
		
	echo '</tr>';
	//$som=$som+$ligne['montant'];
	//$srp=$srp-$ligne['montant'];
	$i++;
	}
?>
<tr class="header2 lgauche bw">
<td colspan="5" align="right" class="prix"><strong><em><div style="text-align: center">PRIX TOTAL</div></em></strong></td>
<td colspan="3" align="right" class="ldroite cnoire"><strong><em>
<?php echo   number_format($ltr['somme'],0,' ',' ').'<sup>F</sup>' ?></em></strong></td>
<td></td>
<td></td>

</tr>

<tr class="header2 bw">
<td colspan="5" align="center" class="prix"><strong>ACCOMPTE</strong></td>
<td colspan="3" align="right" class="ldroite cbleu">
<strong><?php echo number_format($ltr['payee'],0,' ',' ').'<sup>F</sup>' ?></strong></td>
<td></td>
<td></td>

</tr>

<tr class="header2 bw">
<td colspan="5" align="center" class="prix"><strong>RESTE A PAYEE</strong></td>
<td colspan="3" align="right" class="ldroite crouge">
<strong><?php echo number_format($ltr['reste'],0,' ',' ').'<sup>F</sup>' ?></strong></td>
<td>
</td>
<td></td>

</tr>
<tr><td colspan="10" align="center" class="header3 bw"><strong><?php echo $lettre->conversion($ltr['somme']).'Francs CFA' ?></strong></td>
<!-- <td class="header3 bw"></td>
<td class="header3 bw"></td>
<td class="header3 bw"></td> -->
</tr>
<?php if($_SESSION['gid'] == 1000 ){ ?>
<tr class="header3 bw">
<?php if($rar['ar']!=0) {?>
<td colspan="5" style="text-align"> 
<a href="mod_cont_fac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&add_cl=<?php echo $add_cl?>
			&tel1_cl=<?php echo $tel1_cl?>
			&date_fac=<?php echo $date_fac?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button></a></td>	
<td colspan="3" style="text-align: center; ">
<?php if($rr['nb']!=0) {?>
	<a href="val_fac.php?&id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&date_fac=<?php echo $date_fac?>
			&id_ar=<?php echo $ligne['id_ar']?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">TOUS LIVRAIS</button></a></td>
<?php } ?>
<td>
<?php if($rr['nb']==0) {?>
	<a href="anul_fac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&date_fac=<?php echo $date_fac?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER TOUTE LA LIVRAISON</button></a>
<?php } ?>
</td>
<td></td>
<?php } ?>
</tr>
<?php } ?>
<?php if($_SESSION['gid'] == 3 && $etat_fac!='t'){ ?>
<tr class="header3 bw">
<?php if($rar['ar']!=0) {?>
<td colspan="5" style="text-align: center; ">
<?php if($rr['nb']!=0) {?>
<a href="mod_cont_fac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&add_cl=<?php echo $add_cl?>
			&tel1_cl=<?php echo $tel1_cl?>
			&date_fac=<?php echo $date_fac?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button></a>
<?php } ?>
</td>	
<td colspan="3" style="text-align: center; ">
<?php if($rr['nb']!=0) {?>
	<a href="val_fac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&date_fac=<?php echo $date_fac?>
			&id_ar=<?php echo $ligne['id_ar']?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">TOUS LIVRAIS</button></a>
<?php } ?>
</td>
<td>
<?php if($rr['nb']==0) {?>
	<a href="anul_fac.php?id_fac=<?php echo $id_fac?>
			&nom_cl=<?php echo $nom_cl?>
			&prenom_cl=<?php echo $prenom_cl?>
			&date_fac=<?php echo $date_fac?>
			&somme=<?php echo $ltr['somme']?>
			&payee=<?php echo $ltr['payee']?>
			&reste=<?php echo $ltr['reste']?>
			&annee=<?php echo $annee?>
			&mois=<?php echo $mois?>
			&bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER TOUTE LA LIVRAISON</button></a>
<?php } ?>
</td>
<td></td>
<?php } ?>
</tr>
<?php } ?>

<tr class="header3 bw">
<td colspan="10">
<a href="vente_fac_moi.php?&mois=<?php echo $mois?>&annee=<?php echo $annee?>&bar=<?php echo $bar?>">
		
<button id="myb"  class="ui-state-active ui-corner-all boutons">LISTE DE VENTES</button>
</a>
</td>
</tr>
</table>

<!-- <a href="vente_fac_moi.php?&mois=<?php echo $mois?>">
		
<button id="myb"  class="ui-state-active ui-corner-all boutons">LISTE DE VENTES</button>
</a> -->
  
		
	</div>
	<!-- <div></a></div> -->
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

