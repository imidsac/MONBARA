<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>

<?php
include_once('connection.php');
include_once('header.php');
$id_tr=$_GET['id_tr'];
$id_bo=$_GET['id_bo'];
$nom_bo=$_GET['nom_bo'];
$prenom_bo=$_GET['prenom_bo'];
$date_tr=$_GET['date_tr'];
$reste=$_GET['reste'];
$somme=$_GET['somme'];
$payee=$_GET['payee'];
//$mois=$_GET['mois'];
$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat=pg_query($connexion, "SELECT * from banques order by nom_b,compte_banc");
?>
<div id="colTwo">
	<h1 align="center"><strong>PAIEMENT</strong></h1>

<?php
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';


echo '<tr>';
echo '<th class="header3 ldroite">AGENCE </th>';
echo '<td align="center">'.$nom_bo.'  </td>';
echo '</tr>';
echo '<tr>';
/*echo '<th class="header3 ldroite">DATE </th>';
echo '<td align="center">'.$date_tr.'</td>';
echo '</tr>';
echo '</tr>';
echo '<th class="header3 ldroite">transferts N°</th>';
echo '<td class="ldroite crouge"><strong>'.$num.''.$id_tr.'</strong></td>';
echo '</tr>';
echo '<tr>';*/
echo '<th class="header3 ldroite">SOMME-TOTAL </th>';
echo '<td class="ldroite cnoire"><strong>'.number_format($somme,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '<th class="header3 ldroite">SOMME-PAYEE </th>';
echo '<td class="ldroite cbleu"><strong>'.number_format($payee,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '<th class="header3 ldroite">SOMME-RESTE </th>';
echo '<td class="ldroite crouge"><strong>'.number_format($reste,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '</table>';
echo '<br>';
 if($reste!=0){ 
 ?>
<table align="center" style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<form action="paiement_moi.php?mois=<?php echo $mois?>" method="post">
	<tr>
		<th class="header3 ldroite">RESTE A PAYEE</th>
			<td>
			<input type="text" name="reste" size="20" class="text header1 ui-corner-all" value="<?php echo $_GET['reste']?>" />
			</td>
	</tr>
	<tr>
		<th class="header3 ldroite">MOTIFS</th>
			<td>
			<input type="text" name="motif" size="20" class="text header1 ui-corner-all" value="ESPECE" />
			</td>
	</tr>
	<?php
		echo '<tr>
				<th class="header3 ldroite">COMPTE-BANK</th>
					<td>
						<select name="id_b" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_b'].'">'.$ligne['nom_b'].'  '.$ligne['compte_banc'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';
		?>
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_trp" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	
	
	<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
	<input type=hidden name="id_bo" value="<?php echo $id_bo?>">
	<input type=hidden name="role1" value="payerag" />
	</form>	
	
	<a href="paiement_moi.php?mois=<?php echo $mois?>">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuler</button>
	</a>
	</td></tr>
	
</table>	
<?php } ?>

<?php

$resultat=pg_query($connexion, "SELECT nom_bo, sum(reste) as reste, sum(payee) as payee,sum(somme) as somme 
from transferts join boutiques using(id_bo) 
where id_bo=$id_bo group by nom_bo");
$resultat1=pg_query($connexion, "SELECT id_trp,date_trp,id_tr, motif, montant from trpaiement 
where id_bo=$id_bo
and extract(month from date_trp)=$mois");


echo '<table align="center" style="width:60%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th>DATE</th>
			<th>Numero transferts</th>
			<th>MOTIFS</th>
			<th>MONTANT</th>
			<th colspan="2" align="center">ACTION</th>
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat1))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['date_trp'].'</td>';
			echo '<td class="lcentre crouge">'.$ligne['id_tr'].'</td>';
			echo '<td>'.$ligne['motif'].'</td>';
			echo '<td class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td><a href="mod_paicl.php?date_trp='.$ligne['date_trp'].
										'&motif='.$ligne['motif'].
										 '&montant='.$ligne['montant'].
										 '&id_trp='.$ligne['id_trp'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
			if($_SESSION['gid'] == 1000 ) {	
			echo '<td><a href="sup_paicl.php?date_trp='.$ligne['date_trp'].
										'&motif='.$ligne['montant'].
										 '&id_trp='.$ligne['id_trp'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
			
			}
			else {echo '<td></td>';}			
			echo '</tr>';
			$i++;
			
}

echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="4"><div style="text-align: center"><strong>TOTAL</strong></div></td>';
			echo '<td align="right"><strong>'.number_format($payee,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td></td><td></td>';
			echo '</tr>';
echo '</table>';
?>

<hr align="right" size="2" noshade="noshade" />
<a href="paiement_moi.php?mois=<?php echo $mois?>" style="text-align: right; ">
<button id="myb"  class="ui-state-active ui-corner-all boutons">Retoure</button></a>
	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
