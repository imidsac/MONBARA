<?php
include_once('header.php');
include_once('connection.php');

?>

<div id="content">
	
	<?php
	
	include_once('sidebar.php');
	?>

	<div id="colTwo">
		<h1><strong>AJOUT D'UNE CHARGE</strong></h1>
<?php
$resultat=pg_query($connexion, "SELECT * from boutiques ORDER BY id_bo");
echo '<table style="width:60%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="depence.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post" onsubmit="return checkForm();">';

	echo '<tr>
      <th class="header3 ldroite">AGENCE</th>
     <td>
						<select name="id_bo" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_bo'].'">'.$ligne['nom_bo'].'</option>';
 								}
   					echo '</select>
   				</td>
    </tr>';
	echo '<tr><th class="header3 ldroite">DATE</th>
	<td><input type="text" name="date_dep" size="20" class="text header1 ui-corner-all" value="'.(date('d-m-Y H:i:s')).'" /></td></tr>';
	echo '<tr><th class="header3 ldroite">DESIGNATION</th>
	<td><input type="text" name="lib_dep" size="20" class="text header1 ui-corner-all" /></td></tr>';	
	echo '<tr><th class="header3 ldroite">CAISSIERE</th>
	<td><input type="text" name="crencier" size="20" class="text header1 ui-corner-all" /></td></tr>';
	echo '<tr><th class="header3 ldroite">BENEFICIERE</th>
	<td><input type="text" name="beneficiere" size="20" class="text header1 ui-corner-all" /></td></tr>';
	echo '<tr><th class="header3 ldroite">MONTANT</th>
	<td><input type="text" name="montant" size="20" class="text header1 ui-corner-all" value="0" /></td></tr>';
	
	
	echo '<tr>
	<td align="right">
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';" /></td>
	<td><input type=hidden name="role1" value="ajouter" />
	</form>
	
	<a href="depence.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
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

