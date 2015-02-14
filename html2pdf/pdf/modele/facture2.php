<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>
<style type="text/css">
@font-face {
    font-family: 'ChunkFiveRegular';
    src: url('chunkfive-webfont.eot');
    src: url('chunkfive-webfont.eot?iefix') format('eot'),
         url('chunkfive-webfont.woff') format('woff'),
         url('chunkfive-webfont.ttf') format('truetype'),
         url('chunkfive-webfont.svg#webfont6hibqX7I') format('svg');
    font-weight: normal;
    font-style: normal;

}
.titre {
color: #000;
	text-shadow: 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
	font: 70px/70px 'ChunkFiveRegular';
	display: inline-block;
}
.titre1 {
color: #000;
	text-shadow: 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
	font: 40px/40px 'ChunkFiveRegular';
	display: inline-block;
}
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
#data tr th {border:solid 10px #ececec;color:#000;background:#ececec;align: center;font-size:12px;}
#data tr td {border:solid 7px white;color:#000;text-align: right;font-size:10px;}
#data tr {background:white;}
td.myalg {  text-align: left ! important;}
</style>


<?php 
	include('Conversion.php');
	$lettre=new Conversion();
	function num_facture($n){
		if($n<10) 	return '<strong style="color:red">0000'.$n.'</strong>';
		elseif($n>=10 && $n<100) 	return '<strong style="color:red">000'.$n.'</strong>';
		elseif($n>=100 && $n<1000) 	return '<strong style="color:red">00'.$n.'</strong>';
		elseif($n>=1000 && $n<10000) 	return '<strong style="color:red">0'.$n.'</strong>';
		elseif($n>=10000 && $n<100000) 	return '<strong style="color:red">0'.$n.'</strong>';
		else 		return '<strong style="color:red">'.$n.'</strong>';
	}
	$id_fac=$_GET['id_fac'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$somme=$_GET['somme'];
	$payee=$_GET['payee'];
	$reste=$_GET['reste'];
	$date_fac=$_GET['date_fac'];
	$uti=$_SESSION['id_bo'];
	include_once('../../connection.php');
	//$connexion=pg_connect("dbname=baramusso host=localhost user=imidsac password=MOImeme");
	//$connexion=pg_connect("dbname=test host=localhost user=imidsac password=MOImeme");
	$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
	$vila=pg_fetch_assoc($vil);
	$boutique=$vila['nom_bo'];
	$resultat=pg_query($connexion, "SELECT facture_con.*, type_ar,lib_ar 
								from facture_con join articles using(id_ar) where id_fac=$id_fac ORDER BY lib_ar,type_ar desc");
	$resultat2=pg_query($connexion, "SELECT facture_con.*, type_ar,lib_ar 
								from facture_con join articles using(id_ar) where id_fac=$id_fac ORDER BY lib_ar,type_ar desc");
$resultat3=pg_query($connexion, "SELECT count(*) as nb 
								from facture_con  where id_fac=$id_fac ");	
$nbar=pg_fetch_assoc($resultat3);
	//$resultat2=$resultat;
if($nbar['nb']<=10) {
?>
<page>
<table class="w100 b0" cellspacing="14mm" cellpadding="0" align="center" rules="cols" style="border: 0px;">
<tr>
<td class="myalc" style="width: 50%;border: 0.1mm #969696;">
<?php  	$som=0;
	include('entete.php');
?>
<!-- <table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE:</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
</tr>
</table> -->
<table  class="w1 b0" cellspacing="1mm" cellpadding="0">
		<tr>	<td class="myalg cl3 t2" style="width: 5%"></td>
			<td class="myalg cl1 t2" >Client :</td>
			<td class="myalg cl3 t2" ><?php echo $nom_cl.' '.$prenom_cl ?></td>
			<td class="myalg cl1 t2" >Facture numero :</td>
			<td class="myalg cl3 t2" ><?php echo num_facture($id_fac)?></td>
			<td class="myalg cl1 t2" > <?php echo $date_fac.' A '.$boutique?></td>
		</tr>
</table>
<table  class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1"></td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th style="width: 2px"></th>
			<th style="width: 45%;text-align: left;">Designation</th>
			<th class="myalg">Q.T</th>
			<th class="myald">P.U</th>
			<th class="myald">Montant</th>			
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['lib_ar'].' ('.$ligne['type_ar'].')</td>';
			echo '<td align="center">'.$ligne['qte_ar'].'</td>';
			echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;
			$som=$som+$ligne['montant'];
		}
?>
		<tr>
		<th colspan="4" align="right" class="prix">PRIX TOTAL</th> 
		<th align="right" class="som"><strong><?php echo number_format($somme,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">SOMME PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($payee,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">RESTE A PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($reste,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		</table><br/>
		<table class="w1 b0" cellspacing="1mm" cellpadding="0" align="center"> 
		<tr>
			<td class="myalc cl3 t2 w1">
			Arrêté la presente facture à la somme de 
			<strong><?php echo $lettre->conversion($somme).' Francs CFA' ?></strong></td>
		</tr>
	</table>	
</td>




<td class="myalc" style="width: 50%;border: 0.1mm #969696;">
<?php  	$som=0;
	include('entete.php');
?>
<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE:</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
</tr>
</table>
<table class="w1 b0" cellspacing="1mm" cellpadding="0">
		<tr>	<td class="myalg cl3 t2" style="width: 5%"></td>
			<td class="myalg cl1 t2" >Client :</td>
			<td class="myalg cl3 t2" ><?php echo $nom_cl.' '.$prenom_cl?></td>
			<td class="myalg cl1 t2" >Facture numero :</td>
			<td class="myalg cl3 t2" ><?php echo num_facture($id_fac)?></td>
			<td class="myalg cl1 t2" > <?php echo $date_fac.' A '.$boutique?></td>
		</tr>
</table>
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1"></td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th style="width: 2px"></th><th style="width: 45%;text-align: left;">Designation</th><th class="myalg">Q.T</th>
			<th class="myald">P.U</th><th class="myald">Montant</th>			
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat2))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['lib_ar'].' ('.$ligne['type_ar'].')</td>';
			echo '<td align="center">'.$ligne['qte_ar'].'</td>';
			echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;
			$som=$som+$ligne['montant'];
		}
?>
		<tr>
		<th colspan="4" align="right" class="prix">PRIX TOTAL</th> 
		<th align="right" class="som"><strong><?php echo number_format($somme,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">SOMME PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($payee,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">RESTE A PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($reste,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		</table><br/>
		<table class="w1 b0" cellspacing="1mm" cellpadding="0" align="center"> 
		<tr>
			<td class="myalc cl3 t2 w1">
			Arrêté la presente facture à la somme de 
			<strong><?php echo $lettre->conversion($somme).' Francs CFA' ?></strong></td>
		</tr>
	</table>	
</td>
</tr>
</table>

<page_footer><?php include('pied.php');?></page_footer>
</page>
<?php } else { 
echo '<page orientation="portrait">';
$som=0;
	include('enteteA4.php');
?>
<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE:</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
</tr>
</table>
<table cellpadding="0" cellspacing="1" align="center" class="w1 b0">
		<tr>	<td class="myalg cl3 t2" style="width: 5%"></td>
			<td class="myalg cl1 t2" >Client :</td>
			<td class="myalg cl3 t2" ><?php echo $client?></td>
			<td class="myalg cl1 t2" >Facture numero :</td>
			<td class="myalg cl3 t2" ><?php echo num_facture($id_fac)?></td>
			<td class="myalg cl1 t2" > <?php echo $date_fac?> à Bamako</td>
		</tr>
</table>
<table  class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1"></td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th style="width: 2px"></th>
			<th style="width: 45%;text-align: left;">Designation</th>
			<th class="myalg">Q.T</th>
			<th class="myald">P.U</th>
			<th class="myald">Montant</th>			
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['lib_ar'].' ('.$ligne['type_ar'].')</td>';
			echo '<td align="center">'.$ligne['qte_ar'].'</td>';
			echo '<td align="right">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="right">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			$i++;
			$som=$som+$ligne['montant'];
		}
?>
		<tr>
		<th colspan="4" align="right" class="prix">PRIX TOTAL</th> 
		<th align="right" class="som"><strong><?php echo number_format($somme,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">SOMME PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($payee,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		<tr>
		<th colspan="4" align="right" class="prix">RESTE A PAYEE</th> 
		<th align="right" class="som"><strong><?php echo number_format($reste,0,' ',' ').'<sup>F</sup>' ?></strong></th>
		</tr>
		</table><br/>
		<table class="w1 b0" cellspacing="1mm" cellpadding="0" align="center"> 
		<tr>
			<td class="myalc cl3 t2 w1">
			Arrêté la presente facture à la somme de 
			<strong><?php echo $lettre->conversion($somme).' Francs CFA' ?></strong></td>
		</tr>
	</table>	
<page_footer><?php include('pied2.php');?></page_footer>
</page>
<?php } ?>
