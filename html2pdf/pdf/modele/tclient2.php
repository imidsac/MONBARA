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
$annee=isset($_GET['annee'])?$_GET['annee']:$_POST['annee'];
//$annee=$_GET['annee'];
$mois=$_GET['mois'];
//$nmois=$_GET['nmois'];


	include_once('../../fun/f_mois.php');
	include_once('../../connection.php');
	$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
	$vila=pg_fetch_assoc($vil);
	$resultat=pg_query($connexion, "select id_ar,lib_ar,type_ar,sum(qte_ar) as qte_ar from (
(select id_ar,lib_ar, type_ar,sum(qte_ar) as qte_ar from transferts_con 
join transferts using(id_tr) join articles using(id_ar)  
where extract(month from date_tr)=$mois 
and extract(year from date_tr)=$annee 
group by  lib_ar,type_ar,id_ar ) 
union (select id_ar,lib_ar, type_ar,sum( qte_ar) as qte_ar from                  facture_con                                                                                                                             join facture using(id_fac) join articles using(id_ar)
where  extract(month from date_fac)=$mois
and extract(year from date_fac)=$annee
group by  lib_ar,type_ar,id_ar )) as tt
group by lib_ar,type_ar,id_ar order by lib_ar");
 $resultate=pg_query($connexion, "select id_ar,lib_ar,type_ar,entree,sortie, f_stoc_ar(id_ar,$uti) from 
(
     (
       select id_ar,sum( qt_ar) as entree 
        from achat_con join achat using(id_ac) join articles using(id_ar)  
        where  id_bo=$uti 
        and extract(month from date_1)=$mois
        and extract(year from date_1)=$annee 
        group by  id_ar 
     ) as entree 
     
     full join 
     
     (
       select id_ar,sum(sortie) as sortie from 
            (
              (
                select id_ar,sum(qte_ar) as sortie from transferts_con 
                join transferts using(id_tr) join articles using(id_ar) 
                where extract(month from date_tr)=$mois
                and extract(year from date_tr)=$annee 
                group by  id_ar 
              ) 
                union 
              (
                select id_ar,sum( qte_ar) as sortie from facture_con 
                join facture using(id_fac) join articles using(id_ar) 
                where id_bo=$uti
                and extract(month from date_fac)=$mois
                and extract(year from date_fac)=$annee
                group by  id_ar 
               )
             ) as tt group by id_ar 
             
      ) as sortie using(id_ar)
      
) as ggg join articles using(id_ar) order by lib_ar,type_ar");
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
		<tr><td class="myalc w1 cl3 t2 bg1">PAIEMENT DES EMPLOYEES</td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">CLIENTS</th>
			<th style="text-align: left;">PRODUIT</th>
			<th style="text-align: left;">REFERENCE</th>
			<th style="text-align: left;">QUANTITE</th>
			<!--<th style="text-align: right;"></th>
			 <th style="text-align: right;">PRIX D'ACHAT</th> 
			<th style="text-align: right;">PRIX DE VENTE</th>	-->
		</tr>
		<?php
		$lsclient=pg_query($connexion, "select id_cl, nom_cl,prenom_cl from 
facture join clients using(id_cl) 
where extract(month from date_fac)=$mois and extract(year from date_fac)=$annee and facture.id_bo=$uti
group by facture.id_cl,nom_cl,prenom_cl,facture.id_bo order by nom_cl,prenom_cl");

$som_t=0;
$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsclient))
 {
 	 //$coleur=ligneColor(); 
 	$id_cl=$ligne['id_cl'];
 $lscountcl=pg_query($connexion, "select id_cl,count(*) as nb from (                                                                                                select id_cl,id_ar,lib_ar, type_ar,sum( qte_ar) as qte_ar 
from facture_con join  facture using(id_fac) join articles using(id_ar)   
where id_cl=$id_cl and extract(month from date_fac)=$mois 
and extract(year from date_fac)=$annee
group by  lib_ar,type_ar,id_cl,id_ar 
order by lib_ar) as tt  
group by id_cl order by id_cl");

	$lsachat=pg_query($connexion, "select id_cl,id_ar,lib_ar, type_ar,sum( qte_ar) as qte_ar 
from facture_con join  facture using(id_fac) join articles using(id_ar)   
where id_cl=$id_cl and extract(month from date_fac)=$mois     
and extract(year from date_fac)=$annee
group by  lib_ar,type_ar,id_cl,id_ar 
order by lib_ar");
	                          
	                           
	$ht=pg_fetch_assoc($lscountcl);
	$ro=$ht['nb'];
	
	$j=1;
	while ($la=pg_fetch_assoc($lsachat))
    {
 	echo '<tr >';
 	   
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro.'" style="text-align: center;">'.$i++.'</td>';
 	   	  echo '<td rowspan="'.$ro.'" style="text-align: left;" >'.$ligne['nom_cl'].' '.$ligne['prenom_cl'].'</td>';  
 	   }
 	   echo '<td style="text-align: left;">'.$la['lib_ar'].'</td>';
	   echo '<td style="text-align: left;">'.$la['type_ar'].'</td>';
	   echo '<td style="text-align: right; color:#000;">'.number_format($la['qte_ar'],0,' ',' ').'</td>';
	   //echo '<td class="ldroite cbleu">'.number_format($la['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	    //echo '<td class="ldroite cbleu">'.number_format($la['montant'],0,' ',' ').'<sup>F</sup></td>';
 	echo '</tr>';
 	$j++;
 	$som_t=$som_t+$la['montant'];
 	}
 	$k++;
 
	}
	/*echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';*/
		
		?>
		</table>

</page>


<page orientation="portrait">

<?php
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
<!-- <table class="w100 b0" cellspacing="14mm" cellpadding="0" align="center" rules="cols" style="border: 0px;">
<tr><td colspan="2" class="myalc w1 cl3 t2 bg1">MOUVEMENT DE STOCK</td></tr>
<tr>
<td class="myalc" style="width: 50%;border: 0.1mm #969696;"> -->
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">MOUVEMENT DE STOCK</td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		   <th style="width: 4px;text-align: center;"></th>
			<th style="text-align: left;">PRODUIT</th>
			<th style="text-align: left;">REFERENCE</th>
			<th style="text-align: left;">ENTREE</th>
			<th style="text-align: left;">SORTIE</th>
		</tr>
		<?php $i=1;
		while ($ligne=pg_fetch_assoc($resultate))
 		{
		 	echo '<tr>';
		 	echo '<td style="text-align: center;">'.$i.'</td>';
			echo '<td style="text-align: left;">'.$ligne['lib_ar'].'</td>';
			echo '<td style="text-align: left;">'.$ligne['type_ar'].'</td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['entree'],0,' ',' ').'</td>';
			echo '<td style="text-align: right; color:#000;">'.number_format($ligne['sortie'],0,' ',' ').'</td>';
			echo '</tr>';
			$i++;
		}
		?>
		</table>

</page>

