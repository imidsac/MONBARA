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
$id_fac=$_GET['id_fac'];
$id_cl=$_GET['id_cl'];
$nom_cl=$_GET['nom_cl'];
$prenom_cl=$_GET['prenom_cl'];
$date_fac=$_GET['date_fac'];
$reste=$_GET['reste'];
$somme=$_GET['somme'];
$payee=$_GET['payee'];
$nb_achat=$_GET['nb_achat'];
//$mois=$_GET['mois'];
$num=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">
	<h1 align="center"><strong>PAIEMENT</strong></h1>

<?php

$role1=$_POST['role1'];
			if ($role1=='payercl')
				include_once('update_pai_cl.php');
echo '<table style="width:30%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';


echo '<tr>';
echo '<th class="header3 ldroite">CLIENT </th>';
echo '<td align="center">'.$nom_cl.'  '.$prenom_cl.' </td>';
echo '</tr>';
echo '<tr>';
/*echo '<th class="header3 ldroite">DATE </th>';
echo '<td align="center">'.$date_fac.'</td>';
echo '</tr>';
echo '</tr>';
echo '<th class="header3 ldroite">FACTURE N°</th>';
echo '<td class="ldroite crouge"><strong>'.$num.''.$id_fac.'</strong></td>';
echo '</tr>';
echo '<tr>';*/
echo '<th class="header3 ldroite">SOMME-TOTAL </th>';
echo '<td class="ldroite cnoire"><strong>'.number_format($somme,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">SOMME-PAYEE </th>';
echo '<td class="ldroite cbleu"><strong>'.number_format($payee,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">SOMME-RESTE </th>';
echo '<td class="ldroite crouge"><strong>'.number_format($reste,0,' ',' ').'</strong><sup>F</sup></td>';
echo '</tr>';
echo '<tr>';
echo '<th class="header3 ldroite">NB-ACHATS </th>';
echo '<td class="ldroite crouge"><strong>'.$nb_achat.' </strong>Fois</td>';
echo '</tr>';
echo '</table>';
echo '<br>';
?>

<?php if($reste!=0){ ?>
<table align="center" style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<form action="" method="post">
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
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_facp" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d/m/Y H:i:s')) ?>" />
			</td>
	</tr>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
	<td style="text-align: right;">
	
	
	<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
	<input type=hidden name="id_cl" value="<?php echo $id_cl?>">
	<input type=hidden name="id_bo" value="<?php echo $uti?>">
	<input type=hidden name="role1" value="payercl" />
	</form>	
	
	<a href="paiement_moi.php?mois=<?php echo $mois?>">
	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuler</button>
	</a>
	</td></tr>
	
</table>	
<br>
<?php } ?>

<?php

$resultat=pg_query($connexion, "SELECT id_cl,nom_cl, prenom_cl, sum(reste) as reste, sum(payee) as payee,sum(somme) as somme 
from facture join clients using(id_cl) 
where id_cl=$id_cl group by id_cl, nom_cl, prenom_cl");
$resultat1=pg_query($connexion, "SELECT id_facp,date_facp,id_fac, motif, montant 
from facpaiement where id_cl=$id_cl and id_bo=$uti 
and extract(month from date_facp)=$mois
order by date_facp");
echo '<table align="center" style="width:60%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header2 lgauche bw">
			<th>N°</th>
			<th>DATE</th>
			<th>Numero facture</th>
			<th>MOTIFS</th>
			<th>MONTANT</th>
			<th colspan="2" align="center">ACTION</th>
		</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat1))
{
			echo '<tr class="'.ligneColor().' bw">';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$ligne['date_facp'].'</td>';
			echo '<td class="lcentre crouge">'.$ligne['id_fac'].'</td>';
			echo '<td>'.$ligne['motif'].'</td>';
			echo '<td class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td><a href="mod_paicl.php?date_facp='.$ligne['date_facp'].
										'&motif='.$ligne['motif'].
										 '&montant='.$ligne['montant'].
										 '&id_facp='.$ligne['id_facp'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
			if($_SESSION['gid'] == 1000 ) {	
			echo '<td><a href="sup_paicl.php?date_facp='.$ligne['date_facp'].
										'&motif='.$ligne['montant'].
										 '&id_facp='.$ligne['id_facp'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
			
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
