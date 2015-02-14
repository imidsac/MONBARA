<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
include('Conversion.php');
$lettre=new Conversion();
/*$mois=$_GET['mois'];*/
	$id_ac=isset($_GET['id_ac'])?$_GET['id_ac']:$_POST['id_ac'];
	$nom_fo=isset($_GET['nom_fo'])?$_GET['nom_fo']:$_POST['nom_fo'];
	$date_2=isset($_GET['date_2'])?$_GET['date_2']:$_POST['date_2'];
	$id_fo=isset($_GET['id_fo'])?$_GET['id_fo']:$_POST['id_fo'];
	/*
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];
	*/
//$som=0;
//$ssp=0;
//$srp=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>CONTENU ENTREE</strong></em></h1>
		<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_cac.php');
			if ($role1=='ajouter')
				include_once('insert_cac.php');
			if ($role1=='supprimer')
				include_once('delete_cac.php');
			if ($role1=='valider')
				include_once('update_val_cac.php');
			if ($role1=='annuler')
				include_once('update_anul_cac.php');
			if ($role1=='payer')
				include_once('update_pay_ac.php');
			if ($role1=='livre')
				include_once('update_liv_ac.php');
			if ($role1=='alivre')
				include_once('update_aliv_ac.php');
			
$resultat1=pg_query($connexion, "SELECT achat_con.*, lib_ar, type_ar
from achat_con join articles using(id_ar) where id_ac=$id_ac ORDER BY lib_ar desc");
$rachat=pg_query($connexion, "SELECT *,(date_1)::date as dte from achat where id_ac=$id_ac");
$resuldate=pg_query($connexion, "SELECT now()::date as dte1");
/*$resultat0=pg_query($connexion, "SELECT  id_ac, nom_fo, date_1, date_2, npayee as payee, 
sum(get_prix_ar(id_ar)*qt_ar) as somme,
sum(get_prix_ar(id_ar)*qt_ar)-npayee as reste 
from achat join fournisseur using(id_fo) join achat_con using(id_ac) 
where id_ac=$id_ac  group by id_ac, nom_fo, date_1, date_2, npayee order by date_1 desc");*/

$resultat2=pg_query($connexion, "SELECT nom_fo, date_2 
from achat join fournisseur using(id_fo) where id_ac=$id_ac");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar
from articles  where id_ar not in (select id_ar from achat_con where id_ac=$id_ac) order by lib_ar asc");

$rmois=pg_query($connexion, "SELECT sum(qt_ar-qte_livres) nb from achat_con where id_ac=$id_ac");
$rr=pg_fetch_assoc($rmois);

$resultat4=pg_query($connexion, "SELECT * from achat where id_ac=$id_ac ");

$ligne=pg_fetch_assoc($resultat4);
//$ligne0=pg_fetch_assoc($resultat0);
$lachat=pg_fetch_assoc($rachat);
$datej=pg_fetch_assoc($resuldate);
$etat_ac=$ligne['etat_ac'];
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
	echo '<tr>';
		echo '<th class="header3 ldroite">FOURNISSEUR </th>';
			echo '<td align="center">'.$nom_fo.'</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<th class="header3 ldroite">DATE DE LIVRAISON </th>';
			echo '<td align="center">'.$date_2.'</td>';
	echo '</tr>';
echo '</table>';
echo '<br>';
?>
<hr align="right" size="2" width="100%" noshade="noshade" class="header3 bw"/>
<?php if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000) { ?>
<?php if($etat_ac!='t'){ ?>
<h2 align="center"><strong> AJOUT DE NOUVEAUX PRODUITS </strong></h2>								  

<table>
<form action="cachat.php?id_ac=<?php echo $id_ac?>
	&id_fo=<?php echo $id_fo?>
	&nom_fo=<?php echo $nom_fo?>
	&annee=<?php echo $annee?>
	&mois=<?php echo $mois?>
	&bar=<?php echo $bar?>
	&date_2=<?php echo $date_2?>
	&somme=<?php echo $lachat['somme']?>
	&payee=<?php echo $lachat['payee']?>
	&reste=<?php echo $lachat['reste']?>" method="post">
	<tr>
		<th>PRODUITS</th>
		<th>QUANTITE</th>
		<th>PRIX-UNITAIRE</th>
	</tr>
	<tr>
		<td><select name="id_ar" size="0" id="myb" class="ui-state-active ui-corner-all boutons">
<?php
		while($ligne=pg_fetch_assoc($resultat3))
			{
				echo '<option value="'.$ligne['id_ar'].'">';
				echo $ligne['lib_ar'].'  
				'.$ligne['type_ar'].'   
				</option>';
			}
?>
			</select>
		</td>
		<td>
			<input type="text" name="qt_ar" size="15" value="1">
			<input type="hidden" name="id_ac" value="<?php echo $id_ac?>">
			<input type="hidden" name="role1" value="ajouter">
		</td>
		<td>
	<input type=text name="p_u" size="15" value="0">
</td>
	</tr>
	<tr>
		<td>
			<input type="submit" name="val" value="VALIDER" id="myb" class="ui-state-active ui-corner-all boutons" />
			</form>
		</td>
	</tr>


</table>
<?php } ?>
<?php } ?>
<hr align="right" size="2" noshade="noshade" class="header3 bw" />


<?php
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
	echo '<tr class="header3 bw">
<td colspan="10">
<a href="achat2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">LISTE DES ENTREES</button></a>	
</td>
</tr>';	
	echo '<tr class="header2 lgauche bw">
				<th>N°</th>
			<th colspan="2" class="lcentre">DESIGNATION</th>
			<!-- <th>TYPE</th> -->
			<th class="lcentre">Q.T</th>
			<th class="lcentre">Q.T-LIVRAIS</th>
			<th class="lcentre">Q.T-R.LIVRAIS</th>
			<th class="ldroite">PRIX-UNITAIRE</th>
			<th class="ldroite">MONTANT</th>';
			//if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
			 echo '<th colspan="2" class="lcentre">ACTION</th>'; 
			//}		
		echo '</tr>';
				$i=1;
				while ($ligne=pg_fetch_assoc($resultat1))
 				{
 					echo '<tr class="'.ligneColor().' bw">';
 					echo '<td>'.$i.'</td>';
					echo '<td>'.$ligne['lib_ar'].'</td>';
					echo '<td>'.$ligne['type_ar'].'</td>';
					echo '<td align="center">'.number_format($ligne['qt_ar'],0,' ',' ').'</td>';
					echo '<td align="center">'.number_format($ligne['qte_livres'],0,' ',' ').'</td>';
					echo '<td align="right">'.number_format($ligne['qt_ar']-$ligne['qte_livres'],0,' ',' ').'</td>';
					echo '<td align="right">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
					echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
					if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
					if($ligne['qt_ar']-$ligne['qte_livres']!=0){																																																																																													
	echo '<td class="lcentre">
	<a href="liv_cont_ac.php?id_ac='.$ligne['id_ac'].
										 '&id_ar='.$ligne['id_ar'].										
										 '&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 '&qte_livres='.$ligne['qte_livres'].
										 '&id_fo='.$id_fo.
										 '&nom_fo='.$nom_fo.
										 '&date_2='.$date_2.
										 '&somme='.$lachat['somme'].
										 '&payee='.$lachat['payee'].
										 '&reste='.$lachat['reste'].
				 						 '&annee='.$annee.
								         '&mois='.$mois.
								         '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">LIVRAIS</button></a>
										 </td>';	
	}}
	if($_SESSION['gid'] ==1000)  {
		if($ligne['qt_ar']-$ligne['qte_livres']==0){	
		echo '<td class="lcentre">
	<a href="aliv_cont_ac.php?id_ac='.$ligne['id_ac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 '&qte_livres='.$ligne['qte_livres'].
										 '&id_fo='.$id_fo.
										'&nom_fo='.$nom_fo.
										 '&date_2='.$date_2.
										 '&somme='.$lachat['somme'].
										 '&payee='.$lachat['payee'].
										 '&reste='.$lachat['reste'].
				 						 '&annee='.$annee.
								         '&mois='.$mois.
								         '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER LA LIVRAISON</button></a>
										 </td>';
		}
	}
   elseif($_SESSION['gid'] ==3) {
   	if($ligne['qt_ar']-$ligne['qte_livres']==0){	
		if($datej['dte1'] <= $lachat['dte']) {
			echo '<td class="lcentre">
	<a href="aliv_cont_ac.php?id_ac='.$ligne['id_ac'].
										'&id_ar='.$ligne['id_ar'].										
										'&lib_ar='.$ligne['lib_ar'].
										 '&type_ar='.$ligne['type_ar'].
										 '&qt_ar='.$ligne['qt_ar'].
										 '&qte_livres='.$ligne['qte_livres'].
										 '&id_fo='.$id_fo.
										'&nom_fo='.$nom_fo.
										 '&date_2='.$date_2.
										 '&somme='.$lachat['somme'].
										 '&payee='.$lachat['payee'].
										 '&reste='.$lachat['reste'].
				 						 '&annee='.$annee.
								         '&mois='.$mois.
								         '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER LA LIVRAISON</button></a>
										 </td>';
		}
		else { echo '<td></td>';}
		}
	}
	else { echo '<td></td>';}
	if($_SESSION['gid'] ==1000) {
		echo '<td>
								<a href="retire_ac.php?id_ac='.$ligne['id_ac'].
								'&id_ar='.$ligne['id_ar'].
								'&lib_ar='.$ligne['lib_ar'].
								'&type_ar='.$ligne['type_ar'].
								'&qt_ar='.$ligne['qt_ar'].
								'&id_fo='.$id_fo.
								'&nom_fo='.$nom_fo.
								'&date_2='.$date_2.
								'&somme='.$lachat['somme'].
								'&payee='.$lachat['payee'].
								'&reste='.$lachat['reste'].
								'&annee='.$annee.
								'&mois='.$mois.
								'&bar='.$bar.
								'"><button id="myb"  class="ui-state-active ui-corner-all boutons">RETIRER</button></a></td>';	
	}
   elseif($_SESSION['gid'] ==3) {
		if($datej['dte1'] <= $lachat['dte']) {
			echo '<td>
								<a href="retire_ac.php?id_ac='.$ligne['id_ac'].
								'&id_ar='.$ligne['id_ar'].
								'&lib_ar='.$ligne['lib_ar'].
								'&type_ar='.$ligne['type_ar'].
								'&qt_ar='.$ligne['qt_ar'].
								'&id_fo='.$id_fo.
								'&nom_fo='.$nom_fo.
								'&date_2='.$date_2.
								'&somme='.$lachat['somme'].
								'&payee='.$lachat['payee'].
								'&reste='.$lachat['reste'].
								'&annee='.$annee.
								'&mois='.$mois.
								'&bar='.$bar.
								'"><button id="myb"  class="ui-state-active ui-corner-all boutons">RETIRER</button></a></td>';
		}
		else { echo '<td></td>';}
	}
	else { echo '<td></td>';}
				$i++;
				//}
					//else { echo '<td>VALIDER</td>';}
	
	echo '</tr>';
	//$som=$som+$ligne['montant'];
	//$srp=$srp-$ligne['montant'];
				}
?>
		<tr class="header2 lgauche bw">
			<td colspan="5" align="center" class="prix">
				<strong>PRIX TOTAL</strong>
			</td>
			<td colspan="3" align="right" class="ldroite cnoire">
				<strong><?php echo number_format($lachat['somme'],0,' ',' ').'<sup>F</sup>' ?></strong>
			</td>
			<td></td>
			<td></td>
		</tr>

		<tr class="header2 bw">
			<td colspan="5" align="center" class="prix">
				<strong>SOMME PAYEE</strong>
			</td>
			<td colspan="3" align="right" class="ldroite cbleu">
				<strong><?php echo number_format($lachat['payee'],0,' ',' ').'<sup>F</sup>' ?></strong>
			</td>
			<td></td>
			<td></td>
		</tr>

		<tr class="header2 bw">
			<td colspan="5" align="center" class="prix">
				<strong>RESTE A PAYEE</strong>
			</td>
			<td colspan="3" align="right" class="ldroite crouge">
				<strong><?php echo number_format($lachat['reste'],0,' ',' ').'<sup>F</sup>' ?></strong>
			</td>
			<td>
			<!-- <?php if($lachat['reste']!=0){ ?>
				<a href="payee_ac.php?id_ac=<?php echo $id_ac?>
				&id_fo=<?php echo $id_fo?>
				&nom_fo=<?php echo $nom_fo?>
				&date_2=<?php echo $date_2?>
				&somme=<?php echo $lachat['somme']?>
				&payee=<?php echo $lachat['payee']?>
				&reste=<?php echo $lachat['reste']?>
				&mois=<?php echo $mois?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">PAYEE</button></a>
			<?php }?> -->			
			</td>
			<td></td>
		</tr>
		<tr><td colspan="10" align="center" class="header3 bw"><strong><?php echo $lettre->conversion($lachat['somme']).'Francs CFA'	 ?></strong></td></tr>
<?php if($etat_ac!='t'){ ?>
		<tr class="header3 bw">
			<td colspan="4" style="text-align: center; ">
				<a href="mod_cont_ac.php?id_ac=<?php echo $id_ac?>
				&id_fo=<?php echo $id_fo?>
				&nom_fo=<?php echo $nom_fo?>
				&date_2=<?php echo $date_2?>
				&somme=<?php echo $lachat['somme']?>
				&payee=<?php echo $lachat['payee']?>
				&reste=<?php echo $lachat['reste']?>
				&annee=<?php echo $annee?>
	            &mois=<?php echo $mois?>
	            &bar=<?php echo $bar?>
				<button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button>
				</a>
			</td>
			<td colspan="3" style="text-align: center; ">
			<? if($rr['nb']!=0) {?>
				<a href="val_ac.php?id_ac=<?php echo $id_ac?>
				&id_fo=<?php echo $id_fo?>
				&nom_fo=<?php echo $nom_fo?>
				&date_2=<?php echo $date_2?>
				&somme=<?php echo $lachat['somme']?>
				&payee=<?php echo $lachat['payee']?>
				&reste=<?php echo $lachat['reste']?>
				&annee=<?php echo $annee?>
	            &mois=<?php echo $mois?>
	            &bar=<?php echo $bar?>
				<button id="myb"  class="ui-state-active ui-corner-all boutons">TOUS LIVRAIS</button>
				</a>
				<? } ?>
				<? if($rr['nb']==0) { ?>
			<a href="anul_ac.php?id_ac=<?php echo $id_ac?>
            &id_fo=<?php echo $id_fo?>
			&nom_fo=<?php echo $nom_fo?>
			&date_2=<?php echo $date_2?>
			&somme=<?php echo $lachat['somme']?>
			&payee=<?php echo $lachat['payee']?>
			&reste=<?php echo $lachat['reste']?>
			&annee=<?php echo $annee?>
	        &mois=<?php echo $mois?>
	        &bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">ANNULER TOUTE LA LIVRAISON</button></a>
<? } ?>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
<?php } ?>
		<tr class="header3 bw">
<td colspan="10">
<a href="achat2.php?&annee=<?php echo $annee?>
	                &mois=<?php echo $mois?>
	                &bar=<?php echo $bar?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">LISTE DES ENTREES</button></a>	
</td>
</tr>
</table>

<!-- <a href="achat2.php?&mois=<?php echo $mois?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des achats</button></a>		 -->
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

