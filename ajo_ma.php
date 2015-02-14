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
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="materiel.php" method="post">';

	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">AJOUT UNE MATERIELE</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DESIGNATION</th>
					<td>
						<input type="text" name="lib_m" size="20" class="text header1 ui-corner-all" value="Materiele" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">REFERENCE</th>
					<td>
						<input type="text" name="type_m" size="20" class="text header1 ui-corner-all" value="PEU IMPORTE" />
					</td>
			</tr>';
	/*echo '<tr>
				<th class="header3 ldroite">FOURNISSEUR</th>
					<td>
						<select name="id_fo" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_fo'].'">'.$ligne['nom_fo'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';*/
	echo '<tr>
				<th class="header3 ldroite">PRIX-ACHAT</th>
					<td>
						<input type="text" name="prix_achat" size="20" class="text header1 ui-corner-all" value="0" />
					</td>
			</tr>';
			
echo '<tr>
<td></td>
<td>
<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons"  />
<input type=hidden name="role1" value="ajouter" />
</form>
		<a href="materiel.php">
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

