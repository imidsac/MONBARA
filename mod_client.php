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
$nom_cl=$_GET['nom_cl'];
$prenom_cl=$_GET['prenom_cl'];
$add_cl=$_GET['add_cl'];
$tel1_cl=$_GET['tel1_cl'];
$tel2_cl=$_GET['tel2_cl'];

echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="client.php?&annee='.$annee.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UN (E) CLIENT(E)</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">NOM</th>
					<td>
						<input type="text" name="nom_cl" size="20" class="text header1 ui-corner-all" value="'.$_GET['nom_cl'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">PRENOM</th>
					<td>
						<input type="text" name="prenom_cl" size="20" class="text header1 ui-corner-all" value="'.$_GET['prenom_cl'].'" />
					</td>
			</tr>';
	/*echo '<tr>
				<th class="header3 ldroite">ADRESSE</th>
					<td>
						<input type="text" name="add_cl" size="20" class="text header1 ui-corner-all" value="'.$_GET['add_cl'].'" />
					</td>
			</tr>';*/
	echo '<tr>
				<th class="header3 ldroite">TEL1</th>
					<td>
						<input type="text" name="tel1_cl" size="20" class="text header1 ui-corner-all" value="'.$_GET['tel1_cl'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th colspan="2" class="header3 lcentre">ADRESSE:</th>
					
			</tr>';
	echo '<tr>
				<td colspan="2">
						<input type="text" name="add_cl" size="60" class="text header1 ui-corner-all" value="'.$_GET['add_cl'].'" />
					</td>
			</tr>';
	echo '<tr>
				 <td style="text-align: right; ">
				 	
				 	<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
			<input type="hidden" name="id_cl" value="'.$_GET['id_cl'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			<td>
			<a href="client.php?&annee='.$annee.'&bar='.$bar.'">
				 	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
				 	</a>
			</td></tr>';
echo '</table>';

?>
	
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

