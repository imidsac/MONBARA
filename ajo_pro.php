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
		<!-- <h1><strong>AJOUT UNE PRODUIT</strong></h1> -->
<?php
$resultat=pg_query($connexion, "SELECT * from articles");
echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="produit.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">AJOUT UNE PRODUIT</h5></th></tr>';
	
	echo '<tr>
				<th class="header3 ldroite">ARTICLES</th>
					<td>
						<select name="id_ar" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_ar'].'">'.$ligne['lib_ar'].' '.$ligne['type_ar'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';
	
	echo '<tr>
				<th class="header3 ldroite">PRIX-VENTE</th>
					<td>
						<input type="text" name="prix_vente" size="20" class="text header1 ui-corner-all" value="0" />
					</td>';
			


echo '<tr>
<td></td>
<td>
<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons"  />
<input type=hidden name="role1" value="ajouter" />
</form>
		<a href="produit.php">
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

