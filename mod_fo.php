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
$nom_fo=$_GET['nom_fo'];
$add_fo=$_GET['add_fo'];
$tel1_fo=$_GET['tel1_fo'];
$tel2_fo=$_GET['tel2_fo'];
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="fourni.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFACTION D\'UN FOURNISSEUR</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">NOM</th>
					<td>
					<input type="text" name="nom_fo" size="20" class="text header1 ui-corner-all" value="'.$_GET['nom_fo'].'" />
					</td>
			</tr>';
	
	echo '<tr>
				<th class="header3 ldroite">TEL:</th>
					<td>
					<input type="text" name="tel1_fo" size="20" class="text header1 ui-corner-all" value="'.$_GET['tel1_fo'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th colspan="2" class="header3 lcentre">ADRESSE:</th>
					
			</tr>';
	echo '<tr>
				<td colspan="2">
						<input type="text" name="add_fo" size="60" class="text header1 ui-corner-all" value="'.$_GET['add_fo'].'" />
					</td>
			</tr>';
	echo '<tr>
				<td style="text-align: right; ">
					
					<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
					<input type="hidden" name="id_fo" value="'.$_GET['id_fo'].'" />
					<input type=hidden name="role1" value="modifier"/>
					</form></td>
			<td>
					<a href="fourni.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
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

