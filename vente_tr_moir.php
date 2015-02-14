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
echo fan();
echo fmois_tr($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>
	
<?php
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';





echo '<form action="vente_tr_moir2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'" method="post">';
	echo '<tr><th class="header3 ldroite">RECHERCHE</th><td colspan="6"><input type="text" name="dater" size="80" class="text header1 ui-corner-all" /></td>';
	echo  '</tr>';
	echo '<tr>
	<td>
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	
	</form>
	<td>
	<a href="vente_tr_moi.php?&annee='.$annee.'&mois='.$mois.'&bar='.$bar.'"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
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

