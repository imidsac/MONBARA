<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');

$EDATE=(date('Y'));

$som_t=0;
$som_p=0;
$som_r=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<?php
echo fan();
echo fmois_ac($annee);
?>
<h1 align="center"><strong><em><pre><?php echo getPeriodes($mois) ?> </pre></em></strong></h1>
<?php
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_ac.php');
			//if ($role1=='ajouter')
				//include_once('insert_ac.php');
			if ($role1=='supprimer')
				include_once('delete_ac.php');
			
					$resultat=pg_query($connexion, "SELECT achat.*,(date_1)::date as dte, nom_fo 
					from achat join fournisseur using(id_fo) 
					where id_bo=$uti
					and annee=$annee
					and extract(month from date_1)=$mois order by date_1 desc");
					$resultat1=pg_query($connexion, "SELECT now()::date as dte1");
                    $datej=pg_fetch_assoc($resultat1);
					$rmois=pg_query($connexion, "SELECT count(*) as nb from achat 
					where id_bo=$uti
					and annee=$annee
					and extract(month from date_1)=$mois ");
					$rr=pg_fetch_assoc($rmois);
					if($rr['nb']!=0) {
					echo '<h1 align="center"><strong>LISTE DES ENTREES</strong></h1>';
					echo '<table 
								align="center" style="width:98%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
								if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
								echo '<tr class="header3 bw"><td colspan="10"><a href="ajo_ac2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$_GET['bar'].'">
							<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UN ACHAT</button></a></td></tr>';
							}
								echo '<tr class="header2 bw">
											<th>N°</th>
											<th>DATE</th>
											<th>FOURNISSEUR</th>
											<!-- <th>DATE_LIVRAISON</th> -->
											<th>SOMME_TOTAL</th>
											<th>SOMME_PAYEE</th>
											<th>SOMME_RESTE</th>
											<th>ETATS</th>
											<th colspan="3">ACTION</th>
											<!-- <th>CONTENUE</th> -->
										</tr>';
								$i=1;
								while ($ligne=pg_fetch_assoc($resultat))
 									{
 										echo '<tr class="'.ligneColor().' bw">';
 										echo '<td>'.$i.'</td>';
 										echo '<td>'.$ligne['date_1'].'</td>';
										echo '<td>'.$ligne['nom_fo'].'</td>';
										
										//echo '<td>'.$ligne['date_2'].'</td>';
										echo '<td class="ldroite cnoire">'.number_format($ligne['somme'],0,' ',' ').'<sup>F</sup></td>';
										echo '<td class="ldroite cbleu">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
										echo '<td class="ldroite crouge">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
											if($ligne['etat_ac']=='n') 
												echo '<td class="lcentre crouge">N-Livrai</td>';
											else if($ligne['etat_ac']=='p')
												echo '<td class="lcentre cbleu">P-Livrai</td>';
											else 
												echo '<td class="lcentre cnoire">T-Livrai</td>';
												
										if($_SESSION['gid'] == 1000 ) {		
										echo '<td><a href="mod_co_ac.php?nom_fo='.$ligne['nom_fo'].
										 '&date_1='.$ligne['date_1'].
										 '&id_ac='.$ligne['id_ac'].
										 '&id_fo='.$ligne['id_fo'].
										 '&date_2='.$ligne['date_2'].
										 '&bar='.$_GET['bar'].
										 '&mois='.$mois.
										 '&annee='.$annee.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button>
										 </a></td>';
										 	
									   echo '<td><a href="sup_co_ac.php?nom_fo='.$ligne['nom_fo'].
										 '&date_1='.$ligne['date_1'].
										 '&id_ac='.$ligne['id_ac'].
										 '&bar='.$_GET['bar'].
										 '&mois='.$mois.
										 '&annee='.$annee.'">
										 <button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
										 }
										 elseif($_SESSION['gid'] == 3 ) {
		                                  if($datej['dte1'] <= $ligne['dte']) {
		                                 echo '<td><a href="mod_co_ac.php?nom_fo='.$ligne['nom_fo'].
										 '&date_1='.$ligne['date_1'].
										 '&id_ac='.$ligne['id_ac'].
										 '&id_fo='.$ligne['id_fo'].
										 '&date_2='.$ligne['date_2'].
										 '&bar='.$_GET['bar'].
										 '&mois='.$mois.
										 '&annee='.$annee.
										 '"><button id="myb"  class="ui-state-active ui-corner-all boutons">MODIFIER</button>
										 </a></td>';
										 	
									   echo '<td><a href="sup_co_ac.php?nom_fo='.$ligne['nom_fo'].
										 '&date_1='.$ligne['date_1'].
										 '&id_ac='.$ligne['id_ac'].
										 '&bar='.$_GET['bar'].
										 '&mois='.$mois.
										 '&annee='.$annee.'">
										 <button id="myb"  class="ui-state-active ui-corner-all boutons">SUPPRIMER</button></a></td>';
										 }
		                                else {echo '<td></td><td></td>';}
		                                 }
										echo '<td><a href="cachat.php?id_ac='.$ligne['id_ac'].
												'&id_fo='.$ligne['id_fo'].
												'&nom_fo='.$ligne['nom_fo'].
												'&date_2='.$ligne['date_2'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'&bar='.$_GET['bar'].
										        '&mois='.$mois.
										        '&annee='.$annee.'">
												<button id="myb"  class="ui-state-active ui-corner-all boutons">CONTENUE</button>
												</a></td>';	
	
										echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
									$i++;
								}
								echo '<tr class="header2 lgauche bw">';
								
			echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '<td class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
		 	echo '<td colspan="4" align="center"></td>';
			echo '</tr class="header3 bw">';
			if($_SESSION['gid'] == 3 || $_SESSION['gid'] == 1000 ) {	
						echo '<tr class="header3 bw"><td colspan="10"><a href="ajo_ac2.php?&mois='.$mois.'">
							<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UN ACHAT</button></a></td></tr>';
							}
				echo '</table>';
				}
else { 
echo '<div style="text-align: center"><h2><strong>Pas des entrees dans cette mois!!!!</strong></h2></div>';
echo '<a href="ajo_ac2.php?&annee='.$annee.'&mois='.$mois.'&bar='.$_GET['bar'].'">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">FAIRE UNE ACHAT</button>
				</a>';
} 

?>
		
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>

<?php
include_once('footer.php');
?>

