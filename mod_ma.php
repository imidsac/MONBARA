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
		$resultat=pg_query($connexion, "SELECT * from fournisseur");
$lib_m=$_GET['lib_m'];
$type_m=$_GET['type_m'];
$prix_achat=$_GET['prix_achat'];
$id_fo=$_GET['id_fo'];
$nom_fo=$_GET['nom_fo'];

echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="materiel.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE MATERIELE</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DESIGNATION</th>
					<td class="lgauche">
					<input type="text" name="lib_m" size="20" class="text header1 ui-corner-all" value="'.$_GET['lib_m'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">REFERENCE</th>
				<td class="lgauche">
				<input type="text" name="type_m"  size="20" class="text header1 ui-corner-all" value="'.$_GET['type_m'].'" />
				</td>
			</tr>';
	/*echo '<tr>
				<th class="header3 ldroite">STOCK</th>
					<td class="lgauche">
					<input type="text" name="stoc_m"  size="8" class="text header1 ui-corner-all" 
					value="'.$_GET['stoc_m'].'" />
					</td>
			</tr>';*/
	echo '<tr>
				<th class="header3 ldroite">FOURNISSEUR</th>
					<td class="lgauche"><select name="id_fo" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	//echo '<option value="'.$ligne['id_fo'].'">'.$_GET['nom_fo'].'</option>';
 	if($ligne['id_fo']==$_GET['id_fo']) {
 		echo '<option value="'.$ligne['id_fo'].'" selected>';
		echo $ligne['nom_fo'].'</option>';
	}
	else {
			echo '<option value="'.$ligne['id_fo'].'">';
			echo $ligne['nom_fo'].'</option>';
	}
 }
   echo '</select></td></tr>';
   echo '<tr>
   			<th class="header3 ldroite">PRIX-ACHAT</th>
   				<td class="lgauche">
   				<input type="text" name="prix_achat"  size="8" class="text header1 ui-corner-all" 
   				value="'.$_GET['prix_achat'].'" />
   				</td>
   		</tr>';

	echo '<tr>
				<td></td>
			<td style="text-align: right; ">
			
			<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
			<input type="hidden" name="id_m" value="'.$_GET['id_m'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			
			<td><a href="materiel.php">
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

