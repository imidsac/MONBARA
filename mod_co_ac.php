<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$mois=$_GET['mois'];

?>
<div id="content">
<?php
include_once('sidebar.php');
?>
<div id="colTwo">

<?php
$resultat=pg_query($connexion, "SELECT * from fournisseur");
$id_cl=$_GET['id_fo'];
$nom_cl=$_GET['nom_fo'];
$date1=$_GET['date_1'];
$date2=$_GET['date_2'];
//$etat_co=$_GET['etat_ac'];
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="achat2.php?&mois='.$mois.'&annee='.$annee.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE ENTREE</h5></th></tr>';
	echo '<tr><th class="header3 ldroite">FOURNISSEUR</th><td><select name="id_fo" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
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
				<th class="header3 ldroite">DATE-EDITION</th>
					<td>
						<input type="text" name="date_1" size="20" class="text header1 ui-corner-all" value="'.$_GET['date_1'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE-LIVRAISON</th>
					<td>
					<input type="text" name="date_2" size="20" class="text header1 ui-corner-all" value="'.$_GET['date_2'].'" />
					</td>
			</tr>';
	
	echo '<tr>
				 <td style="text-align: right; ">
				 	
				 	<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
			<input type="hidden" name="id_ac" value="'.$_GET['id_ac'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			<td><a href="achat2.php?&mois='.$mois.'&annee='.$annee.'&bar='.$bar.'">
				 	<button  class="ui-state-active ui-corner-all boutons">Annuller</button>
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
