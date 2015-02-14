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
		$resultat=pg_query($connexion, "SELECT * from villes order by nom_pays");
$nom_bo=$_GET['nom_bo'];
$tel_bo=$_GET['tel_bo'];
$id_vi=$_GET['id_vi'];
$nom_ville=$_GET['nom_ville'];

echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="agence.php?&annee='.$annee.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE AGENCE</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">NOM-AGENCE:</th>
					<td class="lgauche">
					<input type="text" name="nom_bo" size="20" class="text header1 ui-corner-all" value="'.$_GET['nom_bo'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">PAYS:</th>
					<td class="lgauche"><select name="id_vi" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {

 	if($ligne['id_vi']==$_GET['id_vi']) {
 		echo '<option value="'.$ligne['id_vi'].'" selected>';
		echo $ligne['nom_pays'].'</option>';
	}
	else {
			echo '<option value="'.$ligne['id_vi'].'">';
			echo $ligne['nom_pays'].'</option>';
	}
 }
   echo '</select></td></tr>';
	echo '<tr>
				<th class="header3 ldroite">TEL:</th>
				<td class="lgauche">
				<input type="text" name="tel_bo"  size="20" class="text header1 ui-corner-all" value="'.$_GET['tel_bo'].'" />
				</td>
			</tr>';
			
	echo '<tr>
				<th colspan="2" class="header3 lcentre">ADRESSE:</th>
					
			</tr>';
	echo '<tr>
				<td colspan="2">
						<input type="text" name="adr_bo" size="60" class="text header1 ui-corner-all" value="'.$_GET['adr_bo'].'" />
					</td>
			</tr>';
	


	echo '<tr>
	
			<td style="text-align: right; ">
			
			<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons"/>
			<input type="hidden" name="id_bo" value="'.$_GET['id_bo'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			
			<td><a href="agence.php?&annee='.$annee.'&bar='.$bar.'">
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

