<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>

<style type="text/css">
.centre {  align: center;}
.myalg {  text-align: left ! important;}
.myald {  text-align: right ;}
.myalc {  text-align: center ;}
.cl1 {color:#969696;}
.cl2 {color:#4c4c4c;}
.cl3 {color:#3a3a3a;}
.t1 { font-size: 65.5%; }
.t2 { font-size: 95.5%; font-weight bold ;}
.gras {font-weight bold ;}
.m1 { margin: 1em 10px; padding: 1.6em 30px;}
.b0 { border: none;}
.b1 { border: 1px solid  #969696;}
.b2 {border:solid 10px white;}
.w1 { width: 99%;}
.w75 { width: 75%;}
.w95 { width: 95%;}
.w90 { width: 90%;}
.w100 { width: 100%;}
.bg1{ background: #ececec;}
.bg2{ background: #969696;}
#data tr th {border:solid 6px #ececec;color:#000;background:#ececec;align: center;font-size:10px;}
#data tr td {border:solid 6px white;color:#000;text-align: right;font-size:10px;}
#data tr {background:white;}
td.myalg {  text-align: left ! important;}
</style>
<page>
<page_footer>[[page_cu]]/[[page_nb]]</page_footer>
<?php 
$uti=$_SESSION['id_bo'];

	include_once('../../connection.php');
	$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
	$vila=pg_fetch_assoc($vil);
	$resultat=pg_query($connexion, "SELECT lib_ar,type_ar,nom_bo,pvente,stoc_ar 
from produits join articles using(id_ar) join boutiques using(id_bo) where id_bo=$uti order by stoc_ar desc");
	include('entete.php');
?>
		
		<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE :</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
<td class="myalg cl1 t2">DATE :</td>
<td class="myalg cl3 t2"><?php echo (date('d-m-Y H:i:s'))?></td>
</tr>
</table>
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">LISTE DES PRODUITS</td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">ARTICLES</th>
			<th style="text-align: left;">REFERENCE</th>
			
			<!-- <th style="text-align: left;">AGENCES</th> -->
			<th style="text-align: right;">STOCKS</th>
			<!-- <th style="text-align: right;">PRIX D'ACHAT</th> -->
			<th style="text-align: right;">PRIX DE VENTE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['lib_ar'].'</td>';
			echo '<td style="text-align: left;">'.$ligne['type_ar'].'</td>';
			
			//echo '<td style="text-align: left;">'.$ligne['nom_bo'].'</td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['stoc_ar'],0,' ',' ').'</td>';
			//echo '<td style="text-align: right; color:red;">'.number_format($ligne['prix_achat'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:blue;">'.number_format($ligne['pvente'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;
		}
		?>
		</table>

</page>

