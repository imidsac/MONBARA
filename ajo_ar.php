<?php
include_once('header.php');
include_once('connection.php');
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
<?php
$resultat=pg_query($connexion, "SELECT * from boutiques");
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="article.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">AJOUT UNE PRODUIT</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DESIGNATION</th>
					<td>
						<input type="text" name="lib_ar" size="20" class="text header1 ui-corner-all" value="Article" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">REFERENCE</th>
					<td>
						<input type="text" name="type_ar" size="20" class="text header1 ui-corner-all" value="L16" />
					</td>
			</tr>';
	
	echo '<tr>
				<th class="header3 ldroite">PRIX-VENTE</th>
					<td>
						<input type="text" name="prix_vente" size="20" class="text header1 ui-corner-all" value="0" />
					</td>';
	echo '<tr>
				<th colspan="2" class="header3 lcentre">IMFORMATION SUPLEMENTAIRE SUR L\'ARTICLE</th>
					</tr>';
	echo '<tr>
					<td colspan="2">
						<input type="text" name="info" value="" size="60" class="text header1 ui-corner-all" />
					</td></tr>';

echo '<tr>
<td></td>
<td>
<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons"  />
<input type=hidden name="role1" value="ajouter" />
</form>
		<a href="article.php">
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

