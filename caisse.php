<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$som_s=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
		<?php
		echo '<div id="colTwoh">';
$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_client.php');
			if ($role1=='ajouter')
				include_once('insert_vcb_fon.php');
			if ($role1=='supprimer')
				include_once('delete_client.php');
$resultat=pg_query($connexion, "SELECT * from cjournal where id_bo=$uti");
$resultat1=pg_query($connexion, "SELECT *  from banques order by nom_b, compte_banc, solde");
echo '<table style="width:100%">';
	echo '<form action="" method="post">';
	echo '<tr>';
		echo '<td align="left" style="width:80%">';
			echo '<table cellpadding="10" cellspacing="0" align="left" class="ui-widget ui-widget-content" style="width:80%">';
			//echo '<a href="#"><button id="myb"  class="ui-state-active ui-corner-all boutons">Payements</button></a>';
			echo '<tr class="header3 bw">
		<th colspan="3">
		<h5 align="center" class="titre1">ETAT DE CAISSE</h5></th></tr>';
echo '<tr class="header2 bw">
	
	<th align="center">FONT</th>
	<th align="center">PAIEMENT</th>
	<th align="center" >TOTAL</th> 
	</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	//echo '<td>'.$i.'</td>';
	echo '<td class="lcentre cbleu">'.number_format($ligne['font'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="lcentre cbleu">'.number_format($ligne['entree'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="lcentre crouge">'.number_format($ligne['font']+$ligne['entree'],0,' ',' ').'<sup>F</sup></td>';
	//echo '<td>'.$ligne['total'].'</td>';
	//$som_s=$som_s+$ligne['solde'];	
	//$i++;
	}
	
			echo '</table>';
		echo '</td>';

		echo '<td align="left" style="width:50%">';
		if($_SESSION['gid'] == 4 || $_SESSION['gid'] ==1000) {
			echo '<table cellpadding="10" cellspacing="0" align="left" class="ui-widget ui-widget-content" style="width:50%">';
						
			echo '<th colspan="2" class="header2 bw"><h1><strong>VCB/FONT</strong></h1></th>';
			echo '<tr>
				<th class="header3 ldroite">DATE:</th>
					<td>
						<input type="text" name="date_ctj" size="20" class="text header1 ui-corner-all" value="'.(date('d-m-Y H:i:s')).'" />
					</td>
			</tr>';
				/*echo '<tr align="right">
				<th class="header3 ldroite">COMPTE-BANC</th>
					<td>
						<select name="id_b" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat1))
 								{
 									echo '<option value="'.$ligne['id_b'].'">'.$ligne['nom_b'].'  '.$ligne['compte_banc'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';*/
   		echo '<tr>
				<th class="header3 ldroite">TYPE:</th>
					<td>
						<select name="type_ctj" id="myb" class="ui-state-active ui-corner-all boutons">';
							
 									echo '<option value="r"> VCB </option>';
 									echo '<option value="v"> FONT </option>';
 								
   					echo '</select>
   				</td>
			</tr>';
   		
   		echo '<tr>
				<th class="header3 ldroite">CAISSIER:*</th>
					<td>
						<input type="text" name="crencier1" size="20" class="text header1 ui-corner-all" value="BOI DOUMBIA" />
					</td>
			</tr>';
			echo '<tr>
				<th class="header3 ldroite">PORTEUR:*</th>
					<td>
						<input type="text" name="crencier2" size="20" class="text header1 ui-corner-all" value="BOI DOUMBIA" />
					</td>
			</tr>';
			echo '<tr>
				<th class="header3 ldroite">MONTANT:</th>
					<td>
						<input type="text" name="montant" size="20" class="text header1 ui-corner-all" value="0" />
					</td>
			</tr>';
			echo '<tr >
				<th colspan="2"  class="header3 lcentre">
				<input type="submit" name="ajouter" value="Valider" size="30" class="ui-state-active ui-corner-all boutons" id="myb" onclick="this.style.display =\'none\';" />
							<input type=hidden name="id_bo" value="'.$uti.'">
						<input type=hidden name="role1" value="ajouter" />
				</th>
					</form>
			</tr>';
				
			echo '</table>';	
		}
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		
	echo '</tr>';
	echo '<tr>
<td></td>

		</tr>';
echo '</table><br>';	
echo '</div>';
/*========================================================================list==========================================*/
echo '<div id="colTwoc">';
?>
<?php
     echo fan();
     echo fmois_vcb_font($annee);

echo '</div>';

?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

