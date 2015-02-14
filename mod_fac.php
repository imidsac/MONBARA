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
$date_fac=$_GET['date_fac'];


$resultat=pg_query($connexion, "SELECT * from clients");
$id_cl=$_GET['id_cl'];
$nom_cl=$_GET['nom_cl'];
$prenom_cl=$_GET['prenom_cl'];
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="vente_fac_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE VENTE</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE</th>
					<td>
					<input type="text" class="text header1 ui-corner-all" name="date_fac" size="20" value="'.$_GET['date_fac'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">CLIENT(E)</th>
					<td class="lgauche"><select name="id_cl" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	if($ligne['id_cl']==$_GET['id_cl']) {
 		echo '<option value="'.$ligne['id_cl'].'" selected>';
		echo $ligne['nom_cl'].' '.$ligne['prenom_cl'].'</option>';
	}
	else {
			echo '<option value="'.$ligne['id_cl'].'">';
			echo $ligne['nom_cl'].' '.$ligne['prenom_cl'].'</option>';
	}
 }
   echo '</select></td></tr>';
	echo '<tr>
				<td style="text-align: right; ">
				
				<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
				<input type="hidden" name="id_fac" value="'.$_GET['id_fac'].'" />
				<input type=hidden name="role1" value="modifier"/>
				</form></td>
				
				<td><a href="vente_fac_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
				</a>
				</td>
			</tr>';
echo '</table>';

?>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
