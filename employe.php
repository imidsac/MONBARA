<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	
		<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_emp.php');
			if ($role1=='ajouter')
				include_once('insert_emp.php');
			if ($role1=='supprimer')
				include_once('delete_emp.php');
$resultat=pg_query($connexion, "SELECT * from employer where id_bo=$uti order by nom_em, prenom_em, montant");
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw">
		<th colspan="10">
		<h5 align="center" class="titre1">LESTE DES EMPLOYES</h5></th></tr>';
if($_SESSION['gid'] == 5 || $_SESSION['gid'] ==1000) {
echo '<tr class="header3 bw">
			<td colspan="5">
				<a href="ajo_emp.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un employé</button>
				</a>
			</td>';
			}
			 echo ' <td colspan="5" align="right">
				<a href="epaiement.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Paiement des employés</button>
				</a> 
			</td> 
		</tr>';
		

echo '<tr class="header2 bw">
			<th>N°</th>
			<th align="left">NOM</th>
			<th align="left">PRENOM</th>
			<th>ADRESSE</th>
			<th align="left">POSTE</th>
			<th align="center">CONTACTS</th>
			<th align="right">COMPTE-BANK</th>
			<th align="right">SALAIRE DE BASE</th>';
			if($_SESSION['gid'] == 5 || $_SESSION['gid'] ==1000) {
				
			echo '<th colspan="2">ACTION</th></tr>';
			}
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['nom_em'].'</td>';
	echo '<td>'.$ligne['prenom_em'].'</td>';
	echo '<td>'.$ligne['add_em'].'</td>';
	if($ligne['lieu']=='b') 
		echo '<td class="lgauche cbleu">Bureau</td>';
   elseif($ligne['lieu']=='a') 
		echo '<td class="lgauche cbleu">Atelier</td>';
	elseif($ligne['lieu']=='g') 
		echo '<td class="lgauche crouge">Gardien</td>';
	elseif($ligne['lieu']=='u') 
		echo '<td class="lgauche crouge">Usine</td>';
	else 
		echo '<td class="lgauche crouge">Inconnu</td>';
	echo '<td class="lcentre">'.$ligne['tel1_em'].'</td>';
	echo '<td class="ldroite cnoire">'.$ligne['compte_banc'].'</td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	if($_SESSION['gid'] == 5 || $_SESSION['gid'] ==1000 ) {
	echo '<td><a href="mod_emp.php?nom_em='.$ligne['nom_em'].
										'&prenom_em='.$ligne['prenom_em'].
										 '&add_em='.$ligne['add_em'].
										 '&lieu='.$ligne['lieu'].
										 '&id_em='.$ligne['id_em'].
										 '&tel1_em='.$ligne['tel1_em'].
										 '&compte_banc='.$ligne['compte_banc'].
										 '&montant='.$ligne['montant'].
										 '&annee='.$annee.
										 '&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
   }	
	
	if($_SESSION['gid'] ==1000 ) {									 
	echo '<td><a href="sup_emp.php?nom_em='.$ligne['nom_em'].
										'&prenom_em='.$ligne['prenom_em'].
										 '&id_em='.$ligne['id_em'].
										 '&annee='.$annee.
										 '&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	}
	echo '</tr>';
	$i++;
	}
	if($_SESSION['gid'] ==5 || $_SESSION['gid'] ==1000) {
echo '<tr class="header3 bw">
			<td colspan="5">
				<a href="ajo_emp.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un employé</button>
				</a>
			</td>';
			}
			  echo '<td colspan="5" align="right">
				<a href="epaiement.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Paiement des employés</button>
				</a> 
			</td> 
		</tr>';
		
echo '</table>';

?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

