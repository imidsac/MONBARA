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
$resultat=pg_query($connexion, "SELECT * from ctjournal where extract(month from date_ctj)=$mois");
$date_ctj=$_GET['date_ctj'];
$crencier1=$_GET['crencier1'];
$crencier2=$_GET['crencier2'];
$montant=$_GET['montant'];
$type_ctj=$_GET['type_ctj'];


echo '<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">';
echo '<form action="client.php" method="post">';
	echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MODIFICATION FONT/VCB</h5></th></tr>';
	echo '<tr>
				<th class="header3 ldroite">DATE</th>
					<td>
						<input type="text" name="date_ctj" size="20" class="text header1 ui-corner-all" value="'.$_GET['date_ctj'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">TYPE</th>
					<td class="lgauche"><select name="type_ctj" id="myb" class="ui-state-active ui-corner-all boutons">';
while ($ligne=pg_fetch_assoc($resultat))
 {
 	if($ligne['type_ctj']==$_GET['type_ctj']) {
 		if($_GET['type_ctj']=='v') {
 		
 		echo '<option value="v"> FONT </option>';
		}
		else { echo '<option value="r"> VCB </option>';}
	}
	else {
			echo '<option value="'.$ligne['type_ctj'].'">';
			echo $ligne['type_ctj'].'</option>';
	}
 }
   echo '</select></td></tr>';
	//echo '<tr>
	echo '<tr>
				<th class="header3 ldroite">CRENCIER</th>
					<td>
						<input type="text" name="crencier1" size="20" class="text header1 ui-corner-all" value="'.$_GET['crencier1'].'" />
					</td>
			</tr>';
	echo '<tr>
				<th class="header3 ldroite">PORTEUR</th>
					<td>
						<input type="text" name="crencier2" size="20" class="text header1 ui-corner-all" value="'.$_GET['crencier2'].'" />
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
			<input type="hidden" name="id_ctj" value="'.$_GET['id_ctj'].'" />
			<input type=hidden name="role1" value="modifier"/>
			</form></td>
			<td>
			<a href="vcb_font.php?&mois='.$mois.'">
				 	<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button>
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

