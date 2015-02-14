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
$lib_ar=$_GET['lib_ar'];
$type_ar=$_GET['type_ar'];
$info=$_GET['info'];
$prix_vente=$_GET['prix_vente'];

echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="article.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UN ARTICLE</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DESIGNATION</th>
					<td class="lgauche">
					<input type="text" name="lib_ar" size="20" class="text header1 ui-corner-all" value="'.$_GET['lib_ar'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">REFERENCE</th>
				<td class="lgauche">
				<input type="text" name="type_ar"  size="20" class="text header1 ui-corner-all" value="'.$_GET['type_ar'].'" />
				</td>
			</tr>';
	/*echo '<tr>
				<th class="header3 ldroite">STOCK</th>
					<td class="lgauche">
					<input type="text" name="stoc_ar"  size="8" class="text header1 ui-corner-all" 
					value="'.$_GET['stoc_ar'].'" />
					</td>
			</tr>';*/
	
	echo '<tr>
				<th class="header3 ldroite">PRIX-VENTE</th>
				<td class="lgauche">
				<input type="text" name="prix_vente"  size="20" class="text header1 ui-corner-all" value="'.$_GET['prix_vente'].'" />
				</td>
			</tr>';
   echo '<tr>
				<th colspan="2" class="header3 lcentre">IMFORMATION SUPLEMENTAIRE SUR L\'ARTICLE</th>
					</tr>';   
	echo '<tr>
					<td colspan="2">
						<input type="text" name="info" value="'.$_GET['info'].'" size="60" class="text header1 ui-corner-all" />
					</td></tr>';	
	
	echo '<tr>
			<td style="text-align: right; ">
			
			<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
			<input type="hidden" name="id_ar" value="'.$_GET['id_ar'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			
			<td><a href="article.php">
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

