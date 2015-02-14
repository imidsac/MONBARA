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
$annee=isset($_GET['annee'])?$_GET['annee']:$_POST['annee'];
$mois=$_GET['mois'];
//getPeriodes($mois)=$_GET['nmois'];
$uti=$_SESSION['id_bo'];

	include_once('../../connection.php');
	include_once('../../fun/f_mois.php');
	$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
	$vila=pg_fetch_assoc($vil);
	$resultat=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='b' and compte_banc<>'INCONNU' AND id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");
	$resultat1=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='a' and compte_banc<>'INCONNU' and id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");
   $resultat2=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='u' and compte_banc<>'INCONNU' and id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");	
	
	include('entete.php');
?>
		
		<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE :</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
<td class="myalg cl1 t2">MOIS:</td>
<td class="myalg cl3 t2"><?php echo getPeriodes($mois).'/'.$annee?></td>
</tr>
</table>
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">PAIEMENTS DES EMPLOYERS</td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
      <tr class="header3">	
          <th colspan="6" style="width: 25%;text-align: center;">BUREAU</th>
      </tr>	
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>
			<th style="text-align: left;">SALAIRE DE BASE</th>
			
			<th style="text-align: left;">AVANCE SUR SALAIRE</th>
			<th style="text-align: right;">SALAIRE NET A PAYEE</th>
			<!-- <th style="text-align: right;">PRIX D'ACHAT</th> -->
			<th style="text-align: right;">COMPTE-BANCAIRE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$som_0=$som_0+$ligne['emontant'];
			$som_1=$som_1+$ligne['payee'];
			$som_2=$som_2+$ligne['reste'];
			$i++;
		}
		echo '<tr>
		<th colspan="2" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_0,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_1,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_2,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th></th>';
		echo '</tr>';
		?>
		</table>
		<BR>
</page>
<page>
<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
      <tr class="header3">	
          <th colspan="6" style="width: 25%;text-align: center;">ATELIER</th>
      </tr>	
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>
			<th style="text-align: left;">SALAIRE DE BASE</th>
			
			<th style="text-align: left;">AVANCE SUR SALAIRE</th>
			<th style="text-align: right;">SALAIRE NET A PAYEE</th>
			<!-- <th style="text-align: right;">PRIX D'ACHAT</th> -->
			<th style="text-align: right;">COMPTE-BANCAIRE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat1))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$som_3=$som_3+$ligne['emontant'];
			$som_4=$som_4+$ligne['payee'];
			$som_5=$som_5+$ligne['reste'];
			$i++;
		}
		echo '<tr>
		<th colspan="2" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_3,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_4,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_5,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th></th>';
		echo '</tr>';
		?>
		</table>
		<BR>
		</page>
<page>
		<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
      <tr class="header3">	
          <th colspan="6" style="width: 25%;text-align: center;">USINE</th>
      </tr>	
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>
			<th style="text-align: left;">SALAIRE DE BASE</th>
			
			<th style="text-align: left;">AVANCE SUR SALAIRE</th>
			<th style="text-align: right;">SALAIRE NET A PAYEE</th>
			<!-- <th style="text-align: right;">PRIX D'ACHAT</th> -->
			<th style="text-align: right;">COMPTE-BANCAIRE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat2))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$som_6=$som_6+$ligne['emontant'];
			$som_7=$som_7+$ligne['payee'];
			$som_8=$som_8+$ligne['reste'];
			$i++;
		}
		echo '<tr>
		<th colspan="2" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_6,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_7,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_8,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th></th>';
		echo '</tr>';
		?>
		</table>
</page>

<page pageset="old">
<page_footer>[[page_cu]]/[[page_nb]]</page_footer>
<?php 
//$annee=(date('Y'));
//$mois=$_GET['mois'];
//getPeriodes($mois)=$_GET['nmois'];
//$uti=$_SESSION['id_bo'];

	$resultat_2=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='b' and compte_banc='INCONNU' AND id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");
	$resultat1_2=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='a' and compte_banc='INCONNU' and id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");
   $resultat2_2=pg_query($connexion, "select nom_em,prenom_em,compte_banc,emontant,payee,(emontant-payee) as reste,mois,annee 
	from epaiement join employer using(id_em) 
	where lieu='u' and compte_banc='INCONNU' and id_bo=$uti and mois=$mois and annee=$annee order by nom_em,prenom_em");	
	

	include('entete.php');
?>
		
<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE :</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
<td class="myalg cl1 t2">MOIS:</td>
<td class="myalg cl3 t2"><?php echo getPeriodes($mois).'/'.$annee?></td>
</tr>
</table>
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">PAIEMENTS DES EMPLOYERS</td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
      <tr class="header3">	
          <th colspan="6" style="width: 25%;text-align: center;">BUREAU</th>
      </tr>	
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>
			<th style="text-align: left;">SALAIRE DE BASE</th>
			
			<th style="text-align: left;">AVANCE SUR SALAIRE</th>
			<th style="text-align: right;">SALAIRE NET A PAYEE</th>
			<th style="text-align: right;">COMPTE-BANCAIRE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat_2))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$som_10=$som_10+$ligne['emontant'];
			$som_11=$som_11+$ligne['payee'];
			$som_12=$som_12+$ligne['reste'];
			$i++;
		}
		echo '<tr>
		<th colspan="2" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_10,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_11,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_12,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th></th>';
		echo '</tr>';
		?>
		</table>
		<BR>
</page>
<page>

<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
      <tr class="header3">	
          <th colspan="6" style="width: 25%;text-align: center;">ATELIER</th>
      </tr>	
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>
			<th style="text-align: left;">SALAIRE DE BASE</th>
			
			<th style="text-align: left;">AVANCE SUR SALAIRE</th>
			<th style="text-align: right;">SALAIRE NET A PAYEE</th>
			<!-- <th style="text-align: right;">PRIX D'ACHAT</th> -->
			<th style="text-align: right;">COMPTE-BANCAIRE</th>	
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultat1_2))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$som_13=$som_13+$ligne['emontant'];
			$som_14=$som_14+$ligne['payee'];
			$som_15=$som_15+$ligne['reste'];
			$i++;
		}
		echo '<tr>
		<th colspan="2" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_13,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_14,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th align="right" class="som"><strong>'.number_format($som_15,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '<th></th>';
		echo '</tr>';
		?>
		</table>
		<BR>
		</page>
<page>
		<?php 
		$rem=pg_query($connexion, "SELECT count(*) as nb from epaiement join employer using(id_em)
                                   where lieu='u' and compte_banc='INCONNU' 
                                   and mois=$mois and id_bo=$uti ");
      $rr=pg_fetch_assoc($rem);
		//if($rr['nb']!=0) {
		echo '<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols">'; 
      echo '<tr class="header3">';
          echo '<th colspan="6" style="width: 25%;text-align: center;">USINE</th>';
      echo '</tr>';	
		echo '<tr class="header3">';
			echo '<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">EMPLOYERS</th>';
			echo '<th style="text-align: left;">SALAIRE DE BASE</th>';
			
			echo '<th style="text-align: left;">AVANCE SUR SALAIRE</th>';
			echo '<th style="text-align: right;">SALAIRE NET A PAYEE</th>';
			echo '<th style="text-align: right;">COMPTE-BANCAIRE</th>';
		echo '</tr>';
			//}
		 $i=1;
		while ($ligne=pg_fetch_assoc($resultat2_2))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['nom_em'].' '.$ligne['prenom_em'].'</td>';
			echo '<td style="text-align: right;">'.number_format($ligne['emontant'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right;">'.number_format($ligne['payee'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['reste'],0,' ',' ').'<sup>F</sup></td>';
			echo '<td style="text-align: right; color:red;">'.$ligne['compte_banc'].'</td>';
			
			echo '</tr>';
			$i++;
		}
	
		?>
		</table>
</page>

