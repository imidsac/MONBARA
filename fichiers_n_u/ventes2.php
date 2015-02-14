<?php
include_once('header.php');
include_once('connection.php');
$som_t=0;
$som_p=0;
$som_r=0;
?>

<div id="content">
	
	<?php
	include_once('sidebar.php');
	?>

	<div id="colTwo">
	<h1 align="center"><em><strong>LISTE DES VENTES SIMPLES</strong></em></h1>
		<?php
		$som=0;
		$role1=$_POST['role1'];
			if ($role1=='modifier')
				include_once('update_ve.php');
			//if ($role1=='ajouter')
			//	include_once('insert_ve.php');
			if ($role1=='supprimer')
				include_once('delete_ve.php');
			
$resultat=pg_query($connexion, "SELECT * from ventes order by date_ve desc");
echo '<table cellpadding="10" cellspacing="0" border="1" align="center" frame="border">';
echo '<tr>
			<td colspan="9">
				<a href="ajo_ve.php">
				<input type="button" name="ajout" value="Faire une vente" />
				</a>
			</td>
		</tr>';
echo '<tr>
		<th>N°</th>
		<th>DATE</th>
		<th>CLIENT</th>
		<th>SOMME_TOTAL</th>
		<th>SOMME_PAYEE</th>
		<th>SOMME_RESTE</th>
		<th colspan="3">ACTION</th>
		<!-- <th>CONTENUE</th> --></tr>';
$i=1;
while ($ligne=pg_fetch_assoc($resultat))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['date_ve'].'</td>';
	echo '<td>'.$ligne['client'].'</td>';
	echo '<td align="right">'.number_format($ligne['somme'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="right">'.number_format($ligne['reste'],0,' ',' ').' <sup>F</sup></td>';
	//if($ligne['etat_fac']=='0') 
		//	echo '<td>Non Livrée</td>';
//	if($ligne['etat_fac']=='1')
	//		echo '<td>Partielment Livrée</td>';
	//if($ligne['etat_fac']=='2')
		//	echo '<td>Totalment Livrée</td>';
	echo '<td><a href="mod_ve.php?date_ve='.$ligne['date_ve'].
										'&client='.$ligne['client'].
										 '&somme='.$ligne['somme'].
										 '&id_ve='.$ligne['id_ve'].
										 '"><input type="button" name="mod" value="Modifier" /></a></td>';
										 
	echo '<td><a href="sup_ve.php?client='.$ligne['client'].
										'&date_ve='.$ligne['date_ve'].
										 '&id_ve='.$ligne['id_ve'].'"><input type="button" name="sup" value="Supprimer" /></a></td>';
										 
	echo '<td><a href="ventes_con.php?id_ve='.$ligne['id_ve'].
												'&client='.$ligne['client'].
												'&date_ve='.$ligne['date_ve'].
												'&reste='.$ligne['reste'].
												'&payee='.$ligne['payee'].
												'&somme='.$ligne['somme'].
												'"><input type="button" name="cont" value="CONTENUE" /></a></td>';	
	
	echo '</tr>';
										$som_t=$som_t+$ligne['somme'];
										$som_p=$som_p+$ligne['payee'];
										$som_r=$som_r+$ligne['reste'];
	$i++;
	}
	echo '<tr>';
			echo '<td colspan="3" align="center"><strong>TOTAL</strong></td>';
			echo '<td align="right">'.number_format($som_t,0,' ',' ').'<sup>F</sup></td>'; 
			echo '<td align="right">'.number_format($som_p,0,' ',' ').'<sup>F</sup></td>'; 
			echo '<td align="right">'.number_format($som_r,0,' ',' ').'<sup>F</sup></td>'; 
		 
			echo '</tr>';
echo '<tr>
			<td colspan="9">
				<a href="ajo_ve.php">
				<input type="button" name="ajout" value="Faire une vente" />
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

