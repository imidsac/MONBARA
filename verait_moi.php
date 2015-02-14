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
				include_once('insert_banc.php');
			if ($role1=='supprimer')
				include_once('delete_vr.php');
$resultat=pg_query($connexion, "SELECT nom_b, compte_banc, solde  from banques 
	where id_b<>0 order by nom_b, compte_banc, solde");
$resultat1=pg_query($connexion, "SELECT *  from banques order by nom_b, compte_banc, solde");
$verait=pg_query($connexion, "SELECT verait.*,(date_vr)::date as dte, nom_b,compte_banc 
											from verait join banques using(id_b) 
											where extract(month from date_vr)=$mois
											and extract(year from date_o)=$annee order by date_vr desc");
$resuldate=pg_query($connexion, "SELECT now()::date as dte1");
$datej=pg_fetch_assoc($resuldate);
echo '<table style="width:100%">';
	echo '<form action="" method="post">';
	echo '<tr>';
		echo '<td align="left" style="width:80%">';
			echo '<table cellpadding="10" cellspacing="0" align="left" class="ui-widget ui-widget-content" style="width:80%">';
			
			echo '<tr class="header3 bw">
		<th colspan="9">
		<h5 align="center" class="titre1">ETAT DES BANQUES</h5></th></tr>';
echo '<tr class="header2 bw">
	<th>N°</th>
	<th align="left">NOM</th>
	<th align="left">COMPTE-BANC</th>
	<th align="right">SOLDE</th>
	<!-- <th align="center" >TOTAL</th> -->
	</tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['nom_b'].'</td>';
	echo '<td>'.$ligne['compte_banc'].'</td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['solde'],0,' ',' ').'<sup>F</sup></td>';
	//echo '<td>'.$ligne['total'].'</td>';
	$som_s=$som_s+$ligne['solde'];	
	$i++;
	}
	
echo '<tr class="header2 lgauche bw">';
echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
echo '<td class="ldroite crouge">'.number_format($som_s,0,' ',' ').'<sup>F</sup></td>';
echo '</tr>';
			echo '</table>';
		echo '</td>';
if($_SESSION['gid'] ==1000 || $_SESSION['gid'] ==5) {
		echo '<td align="left" style="width:50%">';
			echo '<table cellpadding="10" cellspacing="0" align="left" class="ui-widget ui-widget-content" style="width:50%">';
			echo '<th colspan="2" class="header2 bw"><h1><strong>VERSEMENT/RETRAIT</strong></h1></th>';
			echo '<tr>
				<th class="header3 ldroite">DATE:</th>
					<td>
						<input type="text" name="date_vr" size="20" class="text header1 ui-corner-all" value="'.(date('d-m-Y H:i:s')).'" />
					</td>
			</tr>';
				echo '<tr align="right">
				<th class="header3 ldroite">COMPTE-BANC</th>
					<td>
						<select name="id_b" id="myb" class="ui-state-active ui-corner-all boutons">';
							while ($ligne=pg_fetch_assoc($resultat1))
 								{
 									echo '<option value="'.$ligne['id_b'].'">'.$ligne['nom_b'].'  '.$ligne['compte_banc'].'</option>';
 								}
   					echo '</select>
   				</td>
   		</tr>';
   		echo '<tr>
				<th class="header3 ldroite">TYPE:</th>
					<td>
						<select name="type" id="myb" class="ui-state-active ui-corner-all boutons">';
							
 									echo '<option value="v"> Versement </option>';
 									echo '<option value="r"> Retrait </option>';
 									//echo '<option value="i"> Interne </option>';
 									echo '<option value="f"> frait </option>';
 								
   					echo '</select>
   				</td>
			</tr>';
   		
			echo '<tr>
				<th class="header3 ldroite">PORTEUR:*</th>
					<td>
						<input type="text" name="porteur" size="20" class="text header1 ui-corner-all" value="BOI DOUMBIA" />
					</td>
			</tr>';
			echo '<tr>
				<th class="header3 ldroite">SOMME:</th>
					<td>
						<input type="text" name="somme" size="20" class="text header1 ui-corner-all" value="0" />
					</td>
			</tr>';
			echo '<tr >
				<th colspan="2"  class="header3 lcentre">
				<input type="submit" name="ajouter" value="Valider" size="30" class="ui-state-active ui-corner-all boutons" id="myb" onclick="this.style.display =\'none\';" />
						<input type=hidden name="role1" value="ajouter" />
				</th>
					</form>
			</tr>';
				
			echo '</table>';	
		echo '</td>';
		}
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

echo fan();
echo fmois_banc($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>
<?
echo '<table align="center" style="width:90%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';

echo '<tr class="header2 bw">
	<th>N°</th>
	<th>DATE</th>
	<th>PORTEUR & MOTIF</th>
	<th>SOMME</th>
	<th >TYPE</th>
	<th colspan="2">BANQUE</th>
	<th colspan="2">ACTION</th></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($verait))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['date_vr'].'</td>';
	echo '<td>'.$ligne['porteur'].'</td>';
	echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').'</td>';
	if($ligne['type']=='v') 
		echo '<td class="lcentre cbleu">Versement</td>';
	else 
		echo '<td class="lcentre crouge">Retrait</td>';
	echo '<td>'.$ligne['nom_b'].'</td>';
	echo '<td>'.$ligne['compte_banc'].'</td>';
	
	if($_SESSION['gid'] == 1000 ) {		
		echo '<td><a href="#"><button id="myb"  class="ui-state-active ui-corner-all boutons">Modifier</button></a></td>';
										 
	echo '<td><a href="sup_vr.php?porteur='.$ligne['porteur'].
										 '&id_vr='.$ligne['id_vr'].
										 '&date_vr='.$ligne['date_vr'].
										 '&somme='.$ligne['somme'].
										 '&type='.$ligne['type'].
										 '&nom_b='.$ligne['nom_b'].
										 '&compte_banc='.$ligne['compte_banc'].
										 '&mois='.$mois.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';			 
	}
	elseif($_SESSION['gid'] == 5 ) {
		if($datej['dte1'] <= $ligne['dte']) {
		   
										 
	echo '<td><a href="sup_vr.php?porteur='.$ligne['porteur'].
										 '&id_vr='.$ligne['id_vr'].
										 '&date_vr='.$ligne['date_vr'].
										 '&somme='.$ligne['somme'].
										 '&type='.$ligne['type'].
										 '&nom_b='.$ligne['nom_b'].
										 '&compte_banc='.$ligne['compte_banc'].
										 '&mois='.$mois.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">Supprimer</button></a></td>';
	echo '<td></td>';
			}
		else {echo '<td></td><td></td>';}
		}
		else {echo '<td></td><td></td>';}
	echo '</tr>';
	$i++;
	}

echo '</table>';
echo '</div>';

?>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

