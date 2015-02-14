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
$date_tr=$_GET['date_tr'];


$resultat=pg_query($connexion, "SELECT * from boutiques where id_bo<>1");
$id_bo=$_GET['id_bo'];
$nom_bo=$_GET['nom_bo'];
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="vente_tr_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE TRANSFERTS</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE</th>
					<td>
					<input type="text" class="text header1 ui-corner-all" name="date_tr" size="20" value="'.$_GET['date_tr'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">AGENCE</th>
					<td class="lgauche"><select name="id_bo" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	if($ligne['id_bo']==$_GET['id_bo']) {
 		echo '<option value="'.$ligne['id_bo'].'" selected>';
		echo $ligne['nom_bo'].' </option>';
	}
	else {
			echo '<option value="'.$ligne['id_bo'].'">';
			echo $ligne['nom_bo'].' </option>';
	}
 }
   echo '</select></td></tr>';
	echo '<tr>
				<td style="text-align: right; ">
				
				<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
				<input type="hidden" name="id_tr" value="'.$_GET['id_tr'].'" />
				<input type=hidden name="role1" value="modifier"/>
				</form></td>
				
				<td><a href="vente_tr_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'">
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
