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
				include_once('update_ag.php');
			if ($role1=='ajouter')
				include_once('insert_ag.php');
			if ($role1=='supprimer')
				include_once('delete_ag.php');
$resultat=pg_query($connexion, "SELECT id_bo,id_vi,nom_pays,nom_bo,adr_bo,tel_bo 
from boutiques join villes using(id_vi) where id_bo<>1 order by nom_pays, nom_bo");
if($_SESSION['id_bo'] == 1 ) {
if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==3 || $_SESSION['gid'] ==4) {
echo '<table align="center" style="width:95%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">AGENCES DISPONIBLES</h5></th></tr>';
echo '<tr class="header3 bw">
       <td colspan="9">';
       if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo	'<a href="ajo_ag.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un agence</button></a>';
			}	
echo '</td>';
			
		echo '</tr>';
echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th class="lgauche">PAYS</th>
		';
		//if($_SESSION['privilege'] == "admin") {
echo	'<th class="lgauche">AGENCES</th>';
		//}
echo	'<th class="lcentre">ADRESSES</th>';
		//if($_SESSION['privilege'] == "admin") {
//echo	'<th class="ldroite">PRIX-ACHAT</th>';
		//}
echo	'<th class="lcentre">CONTACTS</th>';
		//if($_SESSION['privilege'] == "admin") {
echo	'<th colspan="3" class="lcentre">ACTION</th>';
		//}		
echo	'</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['nom_pays'].'</td>';
	//echo '<td>'.$ligne['nom_ville'].'</td>';
	echo '<td>'.$ligne['nom_bo'].'</td>';
	echo '<td class="lcentre cnoire">'.$ligne['adr_bo'].'</td>';
	echo '<td class="lcentre cbleu">'.$ligne['tel_bo'].'</td>';
	if($_SESSION['gid'] == 1000 || $_SESSION['gid'] == 3 ) {
	echo '<td><a href="mod_ag.php?nom_bo='.$ligne['nom_bo'].
										'&tel_bo='.$ligne['tel_bo'].
										 '&id_bo='.$ligne['id_bo'].
										 '&id_vi='.$ligne['id_vi'].
										 '&nom_pays='.$ligne['nom_pays'].
										 '&adr_bo='.$ligne['adr_bo'].
										 '&annee='.$annee.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
	}
	if($_SESSION['gid'] == 1000 ) {							 
	echo '<td><a href="sup_ag.php?nom_bo='.$ligne['nom_bo'].
										'&tel_bo='.$ligne['tel_bo'].
										 '&id_bo='.$ligne['id_bo'].
										 '&adr_bo='.$ligne['adr_bo'].
										 '&annee='.$annee.
										 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	/*echo '<td><a href="accueil3.php?nom_bo='.$ligne['nom_bo'].
										'&tel_bo='.$ligne['tel_bo'].
										 '&id_bo='.$ligne['id_bo'].
										 '&adr_bo='.$ligne['adr_bo'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Accees</button></a></td>';*/
	 }
	 echo '<td><a href="trace_ag.php?nom_bo='.$ligne['nom_bo'].
										 '&adr_bo='.$ligne['adr_bo'].
										 '&id_bo='.$ligne['id_bo'].
										 '&tel_bo='.$ligne['tel_bo'].
										 '&annee='.$annee.
										 '&bar='.$bar.
										 '&id_bo='.$ligne['id_bo'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Traces</button></a></td>';	
	echo '</tr>';
	$i++;
	}
	
echo '<tr class="header3 bw">
			<td colspan="9">';
			if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
echo		'<a href="ajo_ag.php?&annee='.$annee.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un agence</button></a>';
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

<!-- <?php
include_once('footer.php');
?> -->

