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
				include_once('update_fo.php');
			if ($role1=='ajouter')
				include_once('insert_fo.php');
			if ($role1=='supprimer')
				include_once('delete_fo.php');
$resultat=pg_query($connexion, "SELECT * from fournisseur where id_fo<>0 order by nom_fo");
if($_SESSION['gid'] ==1000 || $_SESSION['gid'] ==5) {
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">FOURNISSEURS</h5></th></tr>';
echo '<tr class="header2 bw">
	<th>N°</th>
	<th>NOM</th>
	<th>ADRESSE</th>
	<th >CONTACTS</th>
	<th colspan="2">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['nom_fo'].'</td>';
	echo '<td>'.$ligne['add_fo'].'</td>';
	echo '<td>'.$ligne['tel1_fo'].'</td>';
	//echo '<td>'.$ligne['tel2_fo'].'</td>';
	//echo '<td>'.$ligne['email'].'</td>';
	echo '<td><a href="mod_fo.php?nom_fo='.$ligne['nom_fo'].
										 '&add_fo='.$ligne['add_fo'].
										 '&id_fo='.$ligne['id_fo'].
										 '&tel1_fo='.$ligne['tel1_fo'].
										 '&tel2_fo='.$ligne['tel2_fo'].
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
	if($_SESSION['gid'] == 1000) {									 
	echo '<td><a href="sup_fo.php?nom_fo='.$ligne['nom_fo'].
										 '&add_fo='.$ligne['add_fo'].
										 '&id_fo='.$ligne['id_fo'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	}
	echo '</tr>';
	$i++;
	}
echo '<tr class="header3 bw"><td colspan="8"><a href="ajo_fo.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un fournisseur</button></a></td></tr>';
echo '</table>';
}
else {
echo '<table align="center">
<tr></tr>
<tr>
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

