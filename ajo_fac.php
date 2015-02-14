<?php
include_once('header.php');
include_once('connection.php');


?>
<div id="content">
<?php
include_once('sidebar.php');
$resultat=pg_query($connexion, "SELECT * from clients where id_bo=$uti order by nom_cl");
?>
<div id="colTwo">
	<h1><strong>FAIRE UNE VENTE</strong></h1>
	<table style="width:20%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
<form action="cfac_ajo.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>" method="post" onsubmit="return checkForm();">

	<tr>
		<th class="header3 ldroite">DATE</th>
			<td>
				<input type="text" name="date_fac" size="20" class="text header1 ui-corner-all" value="<?php echo (date('d-m-Y H:i:s')) ?>" />
			</td>
	</tr>
	<tr>
		<?php
		echo '<tr>
				<th class="header3 ldroite">CLIENT</th>
					<td>
						<select name="id_cl" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat))
 								{
 									echo '<option value="'.$ligne['id_cl'].'">'.$ligne['nom_cl'].'  '.$ligne['prenom_cl'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';
		?>

	<tr><td collspan="2"></td></tr>
	<tr>
		<td></td>
		<td style="text-align: right;">
			<input type="submit" name="valider" value="Valider" id="submit" class="ui-state-active ui-corner-all boutons" />
			<input type=hidden name="role1" value="ajouter" />
			<input type=hidden name="id_bo" value="<?php echo $uti?>">
			<input type=hidden name="nom_cl" value="<?php echo $ligne['nom_cl']?>">
			<input type=hidden name="prenom_cl" value="<?php echo $ligne['prenom_cl']?>">
			<input type=hidden name="add_cl" value="<?php echo $ligne['add_cl']?>">
			<input type=hidden name="tel1_cl" value="<?php echo $ligne['tel1_cl']?>">
			</form></td>	
			

		<td><a href="vente_fac_moi.php?&annee=<?php echo $annee?>&mois=<?php echo $mois?>&bar=<?php echo $bar?>">
			<button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a></td>
	</tr>
	
</table>	
	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
