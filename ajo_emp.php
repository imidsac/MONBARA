<?php
include_once('header.php');
?>

<div id="content">
	
	<?php
	include_once('connection.php');
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<table style="width:40%" class="ui-widget ui-widget-content" cellspacing="0" cellpadding="10">
	<form action="employe.php?&annee=<?php echo $annee?>&bar=<?php echo $bar?>" method="post">
	<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">AJOUT UN(E) EMPLOYE(E)</h5></th></tr>
	<tr>
		<th class="header3 ldroite">NOM:</th>
		<td><input type="text" name="nom_em" size="20" class="text header1 ui-corner-all" /></td>
	</tr>
	<tr>
		<th class="header3 ldroite">PRENOM:</th>
		<td><input type="text" name="prenom_em" size="20" class="text header1 ui-corner-all" /></td>
	</tr>
	<tr>
				<th class="header3 ldroite">POSTE:</th>
					<td >
						<select name="lieu"  id="myb" class="ui-state-active ui-corner-all boutons">';
							
 									<option value="b"> Bureau </option>
 									<option value="a"> Atelier </option>
 									<option value="u"> Usine </option>
 									<option value="g"> gardien </option>
 								
   					</select>
   				</td>
			</tr>
	<tr>
		<th class="header3 ldroite">TEL:</th>
		<td><input type="text" name="tel1_em" size="20" class="text header1 ui-corner-all" value="00 00 00 00" /></td>
	</tr>
	<tr>
		<th class="header3 ldroite">COMPTE-BANK</th>
		<td><input type="text" name="compte_banc" size="20" class="text header1 ui-corner-all" value="INCONNU" /></td>
	</tr>
	<tr>
		<th class="header3 ldroite">MONTANT</th>
		<td><input type="text" name="montant" size="20" class="text header1 ui-corner-all" value="25000" /></td>
	</tr>
	<tr>
		<th colspan="2" class="header3 lcentre">ADRESSE</th>
	</tr>
	<tr>
		<td colspan="2">
			<input type="text" name="add_em" value="" size="80" class="text header1 ui-corner-all" />
		</td></tr>
	<tr>
	<td style="text-align: right;">
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	<td><input type=hidden name="role1" value="ajouter" />
	<input type=hidden name="id_bo" value="<?php echo $uti?>">
	</form>
	
	<a href="employe.php?&annee=<?php echo $annee?>&bar=<?php echo $bar?>"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
	</td>
	</tr>
</table>	
		
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

