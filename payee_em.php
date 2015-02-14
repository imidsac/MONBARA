<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
include_once('update_pay_em.php');
	$id_em=$_GET['id_em'];
	$id_ep=$_GET['id_ep'];
	$nom_em=$_GET['nom_em'];
	$prenom_em=$_GET['prenom_em'];
	$emontant=$_GET['emontant'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$mois=$_GET['mois'];
?>
<div id="content">
<?php
include_once('sidebar.php');

	
	$resul=pg_query($connexion, "SELECT id_ep, id_em,nom_em, prenom_em, emontant, payee, (emontant-payee) as reste 
from epaiement join employer using(id_em) 
where id_em=$id_em 
and annee=f_annee() 
and mois=$mois order by nom_em, prenom_em");
$resuletat=pg_fetch_assoc($resul);
$resultat=pg_query($connexion, "SELECT date_tep, motif, montant from tepaiement 
											where id_em=$id_em 
											and extract(month from date_tep)=$mois
											and id_bo=$uti order by date_tep desc ");
											
$resultat1=pg_query($connexion, "SELECT  extract(month from now()::date) as dte1");
$datej=pg_fetch_assoc($resultat1);
?>
<div id="colTwo">
	<h1 align="center"><strong>PAIEMENT</strong></h1>

<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<tr>';
echo '<th class="header3 ldroite">EMPLOYE </th>';
echo '<td class="lcentre">'.$resuletat['nom_em'].'	'.$resuletat['prenom_em'].'</td>';
echo '</tr>';
/*echo '<tr>';
echo '<th>DATE DE LIVRAISON </th>';
echo '<td>'.$date2.'</td>';
echo '</tr>';*/
echo '<tr>';
echo '<th class="header3 ldroite">SALAIRE DE BASE </th>';
echo '<td class="lcentre crouge"><strong>'.number_format($resuletat['emontant'],0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>


<?php if($datej['dte1'] <= $mois) { ?>
<table align="center" style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="" method="post">	
	<tr>
		<th class="header3 ldroite">RESTE A PAYEE</th>
			<td>
			<input type="text" name="reste" size="20" class="text header1 ui-corner-all" value="<?php echo $resuletat['reste']?>" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">MOTIFS</th>
			<td>
			<input type="text" name="motif" size="20" class="text header1 ui-corner-all" 
			value="ESPECE" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_tep" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>


	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display ='none';" /></td>
	<input type="hidden" name="id_em" value="<?php echo $id_em?>">
	<input type="hidden" name="id_ep" value="<?php echo $id_ep?>">
	<input type="hidden" name="mois" value="<?php echo $mois?>"> 
	<input type="hidden" name="id_bo" value="<?php echo $uti?>">
	<td><input type="hidden" name="role1" value="payer" />
	</form>
	
	<a href="epaiement_moi.php?id_ep=<?php echo $_GET['id_ep']?>
						&id_em=<?php echo $id_em?>
						&nom_em=<?php echo $nom_em?>
						&prenom_em=<?php echo $prenom_em?>
						&emontant=<?php echo $emontant?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
	</a>		
	</td></tr>
	
</table>	

<?php } ?>

<?php
echo '<table align="center" style="width:40%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw"><th colspan="4" align="center">'.$nom_mois.'</th></tr>';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th>DATE</th>
			<th>MOTIFS</th>
			<th align="right">MONTANT</th>
			
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['date_tep'].'</td>';
			echo '<td>'.$ligne['motif'].'</td>';
			echo '<td class="ldroite crouge">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			
			echo '</tr>';
			$i++;
			
}
echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="3"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($resuletat['payee'],0,' ',' ').'</strong><sup>F</sup></td>'; 
			
			echo '</tr>';
echo '</table>';
?>

<?php if($datej['dte1'] <= $mois) { ?>
<!-- <table align="center" style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="" method="post">	
	<tr>
		<th class="header3 ldroite">RESTE A PAYEE</th>
			<td>
			<input type="text" name="reste" size="20" class="text header1 ui-corner-all" value="<?php echo $resuletat['reste']?>" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">MOTIFS</th>
			<td>
			<input type="text" name="motif" size="20" class="text header1 ui-corner-all" 
			value="ESPECE" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_tep" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>


	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	<input type="hidden" name="id_em" value="<?php echo $id_em?>">
	<input type="hidden" name="id_ep" value="<?php echo $id_ep?>">
	<input type="hidden" name="mois" value="<?php echo $mois?>"> 
	<input type="hidden" name="id_bo" value="<?php echo $uti?>">
	<td><input type="hidden" name="role1" value="payer" />
	</form>
	
	<a href="epaiement_moi.php?id_ep=<?php echo $_GET['id_ep']?>
						&id_em=<?php echo $id_em?>
						&nom_em=<?php echo $nom_em?>
						&prenom_em=<?php echo $prenom_em?>
						&emontant=<?php echo $emontant?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&mois=<?php echo $mois?>">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
	</a>		
	</td></tr>
	
</table>	

<?php } ?> -->
<hr align="right" size="2" noshade="noshade" />
<a href="epaiement_moi.php?id_ep=<?php echo $_GET['id_ep']?>
						&id_em=<?php echo $id_em?>
						&nom_em=<?php echo $nom_em?>
						&prenom_em=<?php echo $prenom_em?>
						&emontant=<?php echo $emontant?>
						&payee=<?php echo $payee?>
						&reste=<?php echo $reste?>
						&annee=<?php echo $annee?>
						&mois=<?php echo $mois?>
						&bar=<?php echo $bar?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Retoure</button></a>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
