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
$date_trp=$_GET['date_trp'];


$resultat=pg_query($connexion, "SELECT * from banques order by nom_b,compte_banc");
$id_bo=$_GET['id_bo'];
$id_b=$_GET['id_b'];
$nom_b=$_GET['nom_b'];
$compte_banc=$_GET['compte_banc'];
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="paie_ag_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'&id_bo='.$_GET['id_bo'].'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UNE VERSEMENT</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE</th>
					<td>
					<input type="text" class="text header1 ui-corner-all" name="date_trp" size="20" value="'.$_GET['date_trp'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">MONTANT</th>
					<td>
					<input type="text" class="text header1 ui-corner-all" name="montant" size="20" value="'.$_GET['montant'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">MOTIF</th>
					<td>
					<input type="text" class="text header1 ui-corner-all" name="motif" size="20" value="'.$_GET['motif'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">COMPTE-BANK</th>
					<td class="lgauche"><select name="id_b" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	if($ligne['id_b']==$_GET['id_b']) {
 		echo '<option value="'.$ligne['id_b'].'" selected>';
		echo $ligne['nom_b'].' '.$ligne['compte_banc'].'</option>';
	}
	else {
			echo '<option value="'.$ligne['id_b'].'">';
			echo $ligne['nom_b'].' '.$ligne['compte_banc'].'</option>';
	}
 }
   echo '</select></td></tr>';
	echo '<tr>
				<td style="text-align: right; ">
				
				<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" />
				<input type="hidden" name="id_trp" value="'.$_GET['id_trp'].'" />
				<input type=hidden name="role1" value="modag"/>
				</form></td>
				
				<td><a href="paie_ag_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'&id_bo='.$_GET['id_bo'].'">
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
