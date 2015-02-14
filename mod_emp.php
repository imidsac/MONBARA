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
$nom_em=$_GET['nom_em'];
$prenom_em=$_GET['prenom_em'];
$add_em=$_GET['add_em'];
$lieu=$_GET['lieu'];
$tel1_em=$_GET['tel1_em'];
$compte_banc=$_GET['compte_banc'];
$montant=$_GET['montant'];

echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="employe.php?&annee='.$annee.'&bar='.$bar.'" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION D\'UN (E) EMPLOYE(E)</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">NOM</th>
					<td>
					<input type="text" name="nom_em" size="20" class="text header1 ui-corner-all" value="'.$_GET['nom_em'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">PRENOM</th>
					<td>
					<input type="text" name="prenom_em" size="20" class="text header1 ui-corner-all" value="'.$_GET['prenom_em'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">POSTE:</th>
					<td>
						<select name="lieu" id="myb" class="ui-state-active ui-corner-all boutons">';
 									echo '<option value="b"> Bureau </option>';
 									echo '<option value="a"> Atelier </option>';
 									echo '<option value="u"> Usine </option>';
 									echo '<option value="g"> gardien </option>';
 								
   					echo '</select>
   				</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">TEL1</th>
					<td>
					<input type="text" name="tel1_em" size="20" class="text header1 ui-corner-all" value="'.$_GET['tel1_em'].'" />
					</td>
			</tr>';
	/*echo '<tr>
				<th class="header3 ldroite">ADRESSE</th>
					<td>
					<input type="text" name="add_em" size="20" class="text header1 ui-corner-all" value="'.$_GET['add_em'].'" />
					</td>
			</tr>';*/
	
	echo '<tr>
				<th class="header3 ldroite">COMPTE-BANK</th>
					<td>
					<input type="text" name="compte_banc" size="20" class="text header1 ui-corner-all" value="'.$_GET['compte_banc'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">MONTANT</th>
					<td>
					<input type="text" name="montant" size="20" class="text header1 ui-corner-all" value="'.$_GET['montant'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th colspan="2" class="header3 lcentre">ADRESSE:</th>
					
			</tr>';
	echo '<tr>
				<td colspan="2">
						<input type="text" name="add_em" size="80" class="text header1 ui-corner-all" value="'.$_GET['add_em'].'" />
					</td>
			</tr>';
	echo '<tr>
				<td style="text-align: right; ">
				
				<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
				<input type="hidden" name="id_em" value="'.$_GET['id_em'].'" />
				<input type="hidden" name="role1" value="modifier" />
				</form></td>
			<td>
				<a href="employe.php?&annee='.$annee.'&bar='.$bar.'">
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

