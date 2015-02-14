<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');


?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat=pg_query($connexion, "SELECT * from boutiques where id_bo<>1");
?>
<div id="colTwo">
	<table style="width:20%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="ctr_ajo.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>" method="post">
	<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">FAIRE UNE TRANSFERT</h5></th></tr>
	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_tr" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d-m-Y H:i:s')) ?>" />
			</td>
	</tr>
	<tr>
		<?php
		echo '<tr>
				<th class="header3 ldroite">AGENCE</th>
					<td>
						<select name="id_bo" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_bo'].'">'.$ligne['nom_bo'].'  '.$ligne['adr_bo'].' </option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';
		?>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
		<td style="text-align: right;">
			<input type="submit" name="valider" value="Valider" id="myb" class="ui-state-active ui-corner-all boutons" />
			<input type=hidden name="role1" value="ajouter" />
			<input type=hidden name="nom_bo" value="<?php echo $ligne['nom_bo']?>">
			<input type=hidden name="adr_bo" value="<?php echo $ligne['adr_bo']?>">

			</form></td>	
			

		<td><a href="vente_tr_moi.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a></td>
	</tr>
	
</table>	
</div>

	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
