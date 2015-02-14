<?php
include('header.php');
include_once('session.php');
include('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
		<?php
		if (isset($_POST['role1'])){
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_client.php');
			if ($role1=='ajouter')
				include_once('insert_client.php');
			if ($role1=='supprimer')
				include_once('delete_client.php');}
$resultat=pg_query($connexion, "SELECT * from clients where id_bo=$uti order by nom_cl,prenom_cl");
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw">
		<th colspan="9">
		<h5 align="center" class="titre1">LISTE DES CLIENTS FIDELES</h5></th></tr>';
if($_SESSION['gid'] == 1000 || $_SESSION['gid'] == 3 ) {
echo '<tr class="header3 bw">
	<td colspan="9">
			<a href="ajo_client.php?&annee='.$annee.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un client</button></a>
	</td>
	</tr>';
}
echo '<tr class="header2 bw">
	<th>N°</th>
	<th>NOM</th>
	<th>PRENOM</th>
	<th>ADRESSE</th>
	<th >CONTACTS</th>
	<th colspan="3">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['nom_cl'].'</td>';
	echo '<td>'.$ligne['prenom_cl'].'</td>';
	echo '<td>'.$ligne['add_cl'].'</td>';
	echo '<td>'.$ligne['tel1_cl'].'</td>';
	//echo '<td>'.$ligne['tel2_cl'].'</td>';
	if($_SESSION['gid'] == 1000 || $_SESSION['gid'] == 3 ) {
	echo '<td><a href="mod_client.php?nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										 '&add_cl='.$ligne['add_cl'].
										 '&id_cl='.$ligne['id_cl'].
										 '&tel1_cl='.$ligne['tel1_cl'].
										 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
	}
	if($_SESSION['gid'] == 1000 ) {
	echo '<td><a href="sup_client.php?nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										'&annee='.$annee.
				 						 '&bar='.$bar.
										 '&id_cl='.$ligne['id_cl'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	
	}	
		
	echo '<td><a href="trace_client.php?nom_cl='.$ligne['nom_cl'].
										'&prenom_cl='.$ligne['prenom_cl'].
										 '&add_cl='.$ligne['add_cl'].
										 '&id_cl='.$ligne['id_cl'].
										 '&tel1_cl='.$ligne['tel1_cl'].
										 '&annee='.$annee.
				 						 '&bar='.$bar.
										 '&id_cl='.$ligne['id_cl'].'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Traces</button></a></td>';	
	
	
	echo '</tr>';
	$i++;
	}
	
	if($_SESSION['gid'] == 1000 || $_SESSION['gid'] == 3 ) {
echo '<tr class="header3 bw">
	<td colspan="9">
			<a href="ajo_client.php?&annee='.$annee.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Ajouter un client</button></a>
	</td>
	</tr>';
	}
echo '</table>';

?>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

