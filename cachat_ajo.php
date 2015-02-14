<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	/*$id_ac=isset($_GET['id_ac'])?$_GET['id_ac']:$_POST['id_ac'];
	$nom_fo=isset($_GET['nom_fo'])?$_GET['nom_fo']:$_POST['nom_fo'];
	$date_2=isset($_GET['date_2'])?$_GET['date_2']:$_POST['date_2'];
	$reste=isset($_GET['reste'])?$_GET['reste']:$_POST['reste'];
	$payee=isset($_GET['payee'])?$_GET['payee']:$_POST['payee'];
	$somme=isset($_GET['somme'])?$_GET['somme']:$_POST['somme'];*/
//$som=0;
//$ssp=0;
//$srp=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	
	$id_fo=$_POST['id_fo'];
	$date_1=$_POST['date_1'];
	$date_2=$_POST['date_2'];
	//$mois=$_GET['mois'];
	include_once('insert_ac.php');
	//$rfourni=pg_query($connexion, "SELECT * from achat 
	//where id_fo=$id_fo and date_1='$date_1' and date_2='$date_2'");
	$rfourni=pg_query($connexion, "SELECT max(id_ac) as id_ac from achat");
	$lfourni=pg_fetch_assoc($rfourni);
	
	$rfo=pg_query($connexion, "SELECT nom_fo from fournisseur where id_fo=$id_fo");
	$lfo=pg_fetch_assoc($rfo);
	$id_ac=$lfourni['id_ac'];
	$nom_fo=$lfo['nom_fo'];
	//$somme=0;
	//$payee=0;
	//$reste=0;
	
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>CONTENU ACHAT</strong></em></h1>
		<?php
		//$role1=$_POST['role1'];
			
			//if ($role1=='ajouter')
				include_once('insert_cac.php');
				
			
$resultat1=pg_query($connexion, "SELECT achat_con.*, lib_ar, type_ar
from achat_con join articles using(id_ar) where id_ac=$id_ac");
$rachat=pg_query($connexion, "SELECT * from achat where id_ac=$id_ac");

/*$resultat0=pg_query($connexion, "SELECT  id_ac, nom_fo, date_1, date_2, npayee as payee, 
sum(get_prix_ar(id_ar)*qt_ar) as somme,
sum(get_prix_ar(id_ar)*qt_ar)-npayee as reste 
from achat join fournisseur using(id_fo) join achat_con using(id_ac) 
where id_ac=$id_ac  group by id_ac, nom_fo, date_1, date_2, npayee order by date_1 desc");*/

$resultat2=pg_query($connexion, "SELECT nom_fo, date_2 
from achat join fournisseur using(id_fo) where id_ac=$id_ac");

$resultat3=pg_query($connexion, "SELECT id_ar, lib_ar, type_ar 
from articles  order by lib_ar,type_ar asc ");

//$resultat4=pg_query($connexion, "SELECT * from achat where id_ac=$id_ac ");


$ligne=pg_fetch_assoc($resultat4);
$ligne0=pg_fetch_assoc($resultat0);
$lachat=pg_fetch_assoc($rachat);
//$etat_co=$ligne['etat_ac'];
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
while ($ligne=pg_fetch_assoc($resultat1))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.number_format($ligne['qt_ar'],0,' ',' ').'</td>';
	echo '<td>'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td>'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	if($ligne['etat']==0) {
	echo '<td>
				<a href="retire_ac.php?id_ac='.$ligne['id_ac'].
				'&id_ar='.$ligne['id_ar'].
				'&lib_ar='.$ligne['lib_ar'].
				'&type_ar='.$ligne['type_ar'].
				'&qt_ar='.$ligne['qt_ar'].
				'&id_fo='.$id_fo.
				'&nom_fo='.$nom_fo.
				'&date_2='.$date_2.
				'&somme='.$somme.
				'&payee='.$payee.
				'&reste='.$reste.
				'"><input type="button" name="mod" value="RETIRER" /></a></td>';
				$i++;
	}
	else { echo '<td>VALIDER</td>';}
	
	echo '</tr>';
	//$som=$som+$ligne['montant'];
	//$srp=$srp-$ligne['montant'];
	}
?>
<tr class="header2 lgauche bw">
	<td colspan="5" align="center" class="prix">
		<strong>PRIX TOTAL</strong>
	</td>
	<td colspan="3" align="center" class="ldroite crouge">
		<strong><?php echo number_format($lachat['somme'],0,' ',' ').'<sup>F</sup>' ?></strong>
	</td>
	<td></td>
	<td></td>
</tr>

<tr class="header2 bw">
	<td colspan="5" align="center" class="prix">
		<strong>SOMME PAYEE</strong>
	</td>
	<td colspan="3" align="center" class="ldroite cbleu">
		<strong><?php echo number_format($lachat['payee'],0,' ',' ').'<sup>F</sup>' ?></strong>
	</td>
	<td></td>
	<td></td>
</tr>

<tr class="header2 bw">
	<td colspan="5" align="center" class="prix">
		<strong>RESTE A PAYEE</strong>
	</td>
	<td colspan="3" align="center" class="ldroite crouge">
		<strong><?php echo number_format($lachat['reste'],0,' ',' ').'<sup>F</sup>' ?></strong>
	</td>
	<td>
		<!-- <a href="payee_ac.php?id_ac=<?php echo $id_ac?>
			&id_fo=<?php echo $id_fo?>
			&nom_fo=<?php echo $nom_fo?>
			&date_2=<?php echo $date_2?>
			&reste=<?php echo $reste?>
			&payee=<?php echo $payee?>
			&somme=<?php echo $somme?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">PAYEE</button></a> -->
	</td>
	<td></td>
</tr>

<?php //if($etat_ac!=2){ ?>
<tr>
	<td colspan="4" style="text-align: center; ">
		<!-- <a href="mod_cont_ac.php?id_ac=<?php echo $id_ac?>
			&id_fo=<?php echo $id_fo?>
			&nom_fo=<?php echo $nom_fo?>
			&date_2=<?php echo $date_2?>
			&somme=<?php echo $somme?>
			&payee=<?php echo $payee?>
			&reste=<?php echo $reste?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button>
		</a> -->
	</td>
	<td colspan="3" style="text-align: center; ">
	<!-- <a href="val_ac.php?id_ac=<?php echo $id_ac?>
			&id_fo=<?php echo $id_fo?>
			&nom_fo=<?php echo $nom_fo?>
			&date_2=<?php echo $date_2?>
			&somme=<?php echo $somme?>
			&payee=<?php echo $payee?>
			&reste=<?php echo $reste?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">VALIDER ACHAT</button>
		</a> -->
	</td>
</tr>

<?php //} ?>
</table>
<hr align="right" size="2" width="100%" noshade="noshade" class="header3 bw" />
<?php //if($etat_ac!=2){ ?>
	<h2 align="center"><em><strong> AJOUT DE NOUVEAUX PRODUITS </strong></em></h2>	
	
	<table>							  
<form action="cachat.php?id_ac=<?php echo $id_ac?>
								&id_fo=<?php echo $id_fo?>
								&nom_fo=<?php echo $nom_fo?>
								&date_2=<?php echo $date_2?>
								&annee=<?php echo $annee?>
								&mois=<?php echo $mois?>
	                            &bar=<?php echo $bar?>
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
						echo $ligne['lib_ar'].'  '.$ligne['type_ar'].'</option>';
					}
			?>
			</select>
		</td>
		<td>
			<input type="text" name="qt_ar" size="15" value="1">
			<input type="hidden" name="id_ac" value="<?php echo $id_ac?>">
			 <input type="hidden" name="id_fo" value="<?php echo $id_fo?>">
			<input type="hidden" name="date_1" value="<?php echo $date_1?>">
			<input type="hidden" name="date_2" value="<?php echo $date_2?>">
			<input type="hidden" name="somme" value="<?php echo $somme?>">
			<input type="hidden" name="payee" value="<?php echo $payee?>">
			<input type="hidden" name="reste" value="<?php echo $reste?>"> 
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
<!-- <?php// } ?> -->
<hr align="right" size="2" noshade="noshade" class="header3 bw"/>
<a href="achat2.php?&annee=<?php echo $annee?>
	                &mois=<?php echo $mois?>
	                &bar=<?php echo $bar?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">LISTE DES ACHATS</button></a>		


		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

