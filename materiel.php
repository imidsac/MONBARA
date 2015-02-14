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
				include_once('update_ma.php');
			if ($role1=='ajouter')
				include_once('insert_ma.php');
			if ($role1=='supprimer')
				include_once('delete_ma.php');
$resultat=pg_query($connexion, "SELECT id_m,lib_m, type_m, stoc_m, 
prix_achat
from materiels order by lib_m, type_m,prix_achat asc");
if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000) {
echo '<a href="#"><button id="myb"  class="ui-state-active ui-corner-all boutons">Liste des materiels(PDF)</button></a>';
echo '<table align="center" style="width:50%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MATERIELS</h5></th></tr>';
echo '<tr class="header3 bw">
       <td colspan="9">';
      if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo	'<a href="ajo_ma.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un materiel</button></a>';
		}		
echo '</td>';
			
		echo '</tr>';
echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th class="lgauche">MATERIELS</th>
		<th class="lgauche">REFERENCES</th>';
echo	'<th class="ldroite">STOCKS</th>';
echo	'<th class="ldroite">PRIX-ACHAT</th>';
if($_SESSION['gid'] == 1000) {
echo	'<th colspan="2" class="lcentre">ACTION</th>';	
}
echo	'</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_m'].'</td>';
	echo '<td>'.$ligne['type_m'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['stoc_m'],0,' ',' ').'</td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
	if($_SESSION['gid'] == 1000) {
	echo '<td><a href="mod_ma.php?lib_m='.$ligne['lib_m'].
										'&type_m='.$ligne['type_m'].
										//'&stoc_m='.$ligne['stoc_m'].
										 '&id_m='.$ligne['id_m'].
										 '&id_fo='.$ligne['id_fo'].
										 '&nom_fo='.$ligne['nom_fo'].
										 '&prix_achat='.$ligne['prix_achat'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
		//if($_SESSION['privilege'] == "admin") {								 
	echo '<td><a href="sup_ma.php?lib_m='.$ligne['lib_m'].
										'&type_m='.$ligne['type_m'].
										 '&id_m='.$ligne['id_m'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	 }
	echo '</tr>';
	$i++;
	}
	
echo '<tr class="header3 bw">
			<td colspan="9">';
			if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo		'<a href="ajo_ma.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un materiel</button></a>';
				}
echo		'</td>
			</tr>';
echo '</table>';
}
else {
echo '<table align="center">
<tr>
<tr></tr>
<td align="center" class="titre00"><blink>Vous n\'avez pas le droit</blink></td>
</tr>

<tr><td align="center" class="titre00"><blink>pour acceder le contenu!!!</blink></td></tr>

</table>';
}
?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

