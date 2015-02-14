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
	<h1><em><strong>MODIFICATION D'UNE CHARGE</strong></em></h1>
		<?php
$lib_dep=$_GET['lib_dep'];
$date_dep=$_GET['date_dep'];
$montant=$_GET['montant'];
$crencier=$_GET['crencier'];
$beneficiere=$_GET['beneficiere'];
$resultat=pg_query($connexion, "SELECT * from boutiques order by id_bo");
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="depence.php?&mois='.$mois.'&annee='.$annee.'&bar='.$bar.'" method="post" onsubmit="return checkForm();"">';
	
	echo '<tr>
				<th class="header3 ldroite">AGENCE</th>
					<td class="lgauche"><select name="id_bo" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	if($ligne['id_bo']==$_GET['id_bo']) {
 		echo '<option value="'.$ligne['id_bo'].'" selected>';
		echo $ligne['nom_bo'].'</option>';
	}
	else {
			echo '<option value="'.$ligne['id_bo'].'">';
			echo $ligne['nom_bo'].'</option>';
	}
 }
   echo '</select></td></tr>';
	echo '<tr>
				<th class="header3 ldroite">DESIGNATION</th>
					<td>
					<input type="text" name="lib_dep" size="20" class="text header1 ui-corner-all" value="'.$_GET['lib_dep'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE</th>
					<td>
					<input type="text" name="date_dep" size="20" class="text header1 ui-corner-all" value="'.$_GET['date_dep'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">CRENCIER</th>
					<td>
					<input type="text" name="crencier" size="20" class="text header1 ui-corner-all" value="'.$_GET['crencier'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">BENEFICIERE</th>
					<td>
					<input type="text" name="beneficiere" size="20" class="text header1 ui-corner-all" value="'.$_GET['beneficiere'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">MONTANT</th>
					<td>
					<input type="text" name="montant" size="20" class="text header1 ui-corner-all" value="'.$_GET['montant'].'" />
					</td>
			</tr>';
	echo '<tr>
				<td style="text-align: right; ">
				
				<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
				<input type="hidden" name="id_dep" value="'.$_GET['id_dep'].'" />
				<input type="hidden" name="role1" value="modifier" />
				</form></td>
			<td>
				<a href="depence.php?&mois='.$mois.'&annee='.$annee.'&bar='.$bar.'">
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

