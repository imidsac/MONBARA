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


<?php
$uti=$_SESSION['id_bo'];
include_once('../../connection.php');


$rr0=pg_fetch_assoc($resultat0);
$som_a0=$rr0['somme'];
$som_v0=$rr0['payee'];
$som_d0=$rr0['reste'];

$rr=pg_fetch_assoc($resultat1);
$som_a=$rr['somme'];
$som_v=$rr['payee'];
$som_d=$rr['reste'];

$rr2=pg_fetch_assoc($resultat2);
$som_a2=$rr2['somme'];
$som_v2=$rr2['payee'];
$som_d2=$rr2['reste'];

$rr3=pg_fetch_assoc($resultat3);
$som_d3=$rr3['montant'];

$DEP=$rr3['montant']+$rr2['payee'];
$REC=$som_v=$rr['payee']+$som_v0=$rr0['payee'];
$BAL=$REC-$DEP;

include_once('../../connection.php');
//$connexion=pg_connect("dbname=baramusso host=localhost user=imidsac password=MOImeme");
$vil=pg_query($connexion, "select * from boutiques where id_bo=$uti");
	$vila=pg_fetch_assoc($vil);
	$boutique=$vila['nom_bo'];
?>
<page>
<page_footer>[[page_cu]]/[[page_nb]]</page_footer> 
<?php
	include('entete.php');
?>

<table align="center">
<tr>
<td class="myalg cl1 t2">AGENCE :</td>
<td class="myalg cl3 t2"><?php echo $vila['nom_bo']?></td>
</tr>
</table>
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">TRACE JOURNALIER LE <?php echo (date('d-M-Y H:i:s'))?></td></tr>
</table><br/>
	<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th style="text-align: center;" colspan="7" >ETAT GENERAL DES CLIENTS</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">CLIENTS</th>
			<th style=" width: 25%;text-align: left;">PRODUITS</th>
			<th style="text-align: left;">QUANTITE</th> 
			<th style="text-align: right;">PRIX-VENTE</th>
			<th style="text-align: right;">MONTANT</th>	
		</tr>
		<?php 
		$lsclient=pg_query($connexion, "select distinct id_cl,nom_cl, prenom_cl 
                                    from facture join clients using(id_cl)  
                                    where facture.id_bo=$uti 
                                    and extract(day from date_fac)=extract(day from now()::date) 
                                    and extract(month from date_fac)=extract(month from now()::date) 
                                    and extract(year from date_fac)=f_annee() order by nom_cl, prenom_cl");


$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsclient))
 {
 	$id_cl=$ligne['id_cl'];
 $lscountcl=pg_query($connexion, "select count(*) as nb from (select id_cl,id_ar,prix_vente  
                              from facture_con join  facture using(id_fac)  
                              where extract(day from date_fac)=extract(day from now()::date) 
                              and extract(month from date_fac)=extract(month from now()::date) 
                              and extract(year from date_fac)=f_annee()  
                              and id_cl=$id_cl group by id_cl,id_ar,prix_vente order by id_cl) as tt ");

	$lsachat=pg_query($connexion, "select id_cl,lib_ar, type_ar, sum(qte_ar) as qte_ar,facture_con.prix_vente,sum(qte_ar*facture_con.prix_vente) as montant 
	                           from facture_con join  facture using(id_fac) join articles using(id_ar)  
	                           where extract(day from date_fac)=extract(day from now()::date) 
                              and extract(month from date_fac)=extract(month from now()::date) 
                              and extract(year from date_fac)=f_annee() and id_cl=$id_cl 
	                           group by  id_ar,lib_ar,type_ar,facture_con.prix_vente,id_cl order by lib_ar,type_ar");
	                          
	                           
	$ht=pg_fetch_assoc($lscountcl);
	$ro=$ht['nb'];
	
	$j=1;
	while ($la=pg_fetch_assoc($lsachat))
    {
 	echo '<tr>';
 	   
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro.'">'.$i++.'</td>';
 	   	  echo '<td rowspan="'.$ro.'" style="text-align: left;">'.$ligne['nom_cl'].'  '.$ligne['prenom_cl'].'</td>';  
 	   }
 	   echo '<td style="text-align: left;">'.$la['lib_ar']. '  (' .$la['type_ar'].')</td>';
	   //echo '<td style="text-align: left;">'.$la['type_ar'].'</td>';
	   echo '<td style="text-align: right; color:#000;">'.number_format($la['qte_ar'],0,' ',' ').'</td>';
	   echo '<td style="text-align: right; color:blue;">'.number_format($la['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	    echo '<td style="text-align: right; color:blue;">'.number_format($la['montant'],0,' ',' ').'<sup>F</sup></td>';
 	echo '</tr>';
 	$j++;
 	//$som=0;
 	$som_t=$som_t+$la['montant'];
 	}
 	$k++;
 
	}
	echo '<tr>
		<th colspan="5" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_t,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '</tr>';	
		?>
     </table><br/>		
		
		<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th colspan="7" style="text-align: center;">ETAT GENERAL DES AGENCES</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">AGENCES</th>
			<th style="width: 25%;text-align: left;">PRODUITS</th>
			<th style="text-align: left;">QUANTITE</th> 
			<th style="text-align: right;">PRIX-VENTE</th>
			<th style="text-align: right;">MONTANT</th>	
		</tr>
			<?php 
		$lsagence=pg_query($connexion, "select distinct id_bo,nom_bo 
                                    from transferts join boutiques using(id_bo)  
                                    where  
                                    extract(day from date_tr)=extract(day from now()::date) 
                                    and extract(month from date_tr)=extract(month from now()::date) 
                                    and extract(year from date_tr)=f_annee() order by nom_bo");


$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsagence))
 {
 	$id_bo=$ligne['id_bo'];
 $lscountbo=pg_query($connexion, "select id_bo,count(*) as nb from (select id_bo  
                              from transferts_con join  transferts using(id_tr)  
                              where extract(day from date_tr)=extract(day from now()::date) 
                              and extract(month from date_tr)=extract(month from now()::date) 
                              and extract(year from date_tr)=f_annee() order by id_bo) as tt 
                              where id_bo=$id_bo group by id_bo");

	$lsachat2=pg_query($connexion, "select id_bo,lib_ar, type_ar, qte_ar,transferts_con.prix_vente,(qte_ar*transferts_con.prix_vente) as montant 
	                           from transferts_con join  transferts using(id_tr) join articles using(id_ar)  
	                           where extract(day from date_tr)=extract(day from now()::date) 
                              and extract(month from date_tr)=extract(month from now()::date) 
                              and extract(year from date_tr)=f_annee() and id_bo=$id_bo 
	                           group by  lib_ar,type_ar,qte_ar,transferts_con.prix_vente,id_bo order by lib_ar,type_ar");
	                          
	                           
	$ht2=pg_fetch_assoc($lscountbo);
	$ro2=$ht2['nb'];
	
	$j=1;
	while ($la2=pg_fetch_assoc($lsachat2))
    {
 	echo '<tr>';
 	   
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro2.'">'.$i++.'</td>';
 	   	  echo '<td rowspan="'.$ro2.'" style="text-align: left;">'.$ligne['nom_bo'].'</td>';  
 	   }
 	   echo '<td style="text-align: left;">'.$la2['lib_ar']. '  (' .$la2['type_ar'].')</td>';
	   //echo '<td style="text-align: left;">'.$la['type_ar'].'</td>';
	   echo '<td style="text-align: right; color:#000;">'.number_format($la2['qte_ar'],0,' ',' ').'</td>';
	   echo '<td style="text-align: right; color:blue;">'.number_format($la2['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	    echo '<td style="text-align: right; color:blue;">'.number_format($la2['montant'],0,' ',' ').'<sup>F</sup></td>';
 	echo '</tr>';
 	$j++;
 	//$somag=0;
 	$som_2=$som_2+$la2['montant'];
 	}
 	$k++;
	}
	
	echo '<tr>
		<th colspan="5" align="center" class="prix"> TOTAL</th>'; 
		echo '<th align="right" class="som"><strong>'.number_format($som_2,0,' ',' ').'<sup>F</sup></strong></th>';
		echo '</tr>';	
		?>
		</table><br/>
<!-- ==========================================================SORTIES/ENTREES=================================== -->

		<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols">
		<tr class="header3">
		    <th colspan="4" style="text-align: center;">MOUVEMENT DE STOCK</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th>
			<th style="width: 25%;text-align: left;">PRODUITS</th>
			<th style="text-align: left;">ENTREE</th> 
			<th style="text-align: left;">SORTIE</th> 
		</tr>
		<?php
$rproduit=pg_query($connexion, "select id_ar,lib_ar,type_ar,entree,sortie, f_stoc_ar(id_ar,1) from 
(
     (
       select id_ar,sum( qt_ar) as entree 
        from achat_con join achat using(id_ac) join articles using(id_ar)  
        where  id_bo=1
        and extract(day from date_1)=extract(day from now()::date)
        and extract(month from date_1)=extract(month from now()::date) 
        and extract(year from date_1)=f_annee() 
        group by  id_ar 
     ) as entree 
     
     full join 
     
     (
       select id_ar,sum(sortie) as sortie from 
            (
              (
                select id_ar,sum(qte_ar) as sortie from transferts_con 
                join transferts using(id_tr) join articles using(id_ar) 
                where extract(month from date_tr)=extract(day from now()::date)
                and extract(month from date_tr)=extract(month from now()::date)
                and extract(year from date_tr)=f_annee() 
                group by  id_ar 
              ) 
                union 
              (
                select id_ar,sum( qte_ar) as sortie from facture_con 
                join facture using(id_fac) join articles using(id_ar) 
                where extract(day from date_fac)=extract(day from now()::date)
                and extract(month from date_fac)=extract(month from now()::date)
                and extract(year from date_fac)=f_annee()
                group by  id_ar 
               )
             ) as tt group by id_ar 
             
      ) as sortie using(id_ar)
      
) as ggg join articles using(id_ar) order by lib_ar,type_ar");
$i=1;
while ($lrp=pg_fetch_assoc($rproduit))

 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td style="text-align: left;">'.$lrp['lib_ar'].  '  '  .$lrp['type_ar'].'</td>';
	echo '<td style="text-align: right;">'.number_format($lrp['entree'],0,' ',' ').'</td>';
	echo '<td style="text-align: right;">'.number_format($lrp['sortie'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}			
?>
</table><br/>

 <!-- <table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols">
      <tr class="header3">
		    <th colspan="3" style="text-align: center;">ENTREES</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th>
			<th style="width: 25%;text-align: left;" >PRODUITS</th>
			<th style="text-align: left;">QUANTITE</th> 
		</tr>
      <?php
$reproduit=pg_query($connexion, "select id_ar,lib_ar, type_ar,sum( qt_ar) as qte_ar 
                                         from achat_con join achat using(id_ac) join articles using(id_ar)  
                                         where  id_bo=$uti
                                         and extract(day from date_1)=extract(day from now()::date)
                                         and extract(month from date_1)=extract(month from now()::date)
                                         and extract(year from date_1)=f_annee() 
                                         group by  lib_ar,type_ar,id_ar order by lib_ar");
$i=1;
while ($lrep=pg_fetch_assoc($reproduit))

 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td style="text-align: left;">'.$lrep['lib_ar'].  '  '  .$lrep['type_ar'].'</td>';
	echo '<td style="text-align: right;">'.number_format($lrep['qte_ar'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}			
?>
		</table><br/> -->
<!-- ==========================================================VERSEMENTS=================================== -->
<!-- ==========================================================VERSEMENTS-CLIENTS=================================== -->
		<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th style="text-align: center;" colspan="7" >VERSEMENTS EFFECTUEE PAR DES CLIENTS</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">CLIENTS</th>
			<th style=" width: 15%;text-align: left;">DATE</th>
			<th style="text-align: left;">FACTURE N°</th> 
			<th style="text-align: right;">MOTIFS</th>
			<th style="text-align: right;">MONTANT</th>	
		</tr>
		<?php
		$resultatcl2=pg_query($connexion, "SELECT facpaiement.id_cl,id_fac,nom_cl,prenom_cl,date_facp,motif,montant from facpaiement join clients using(id_cl) 
													where facpaiement.id_bo=$uti
													and extract(day from date_facp)=extract(day from now()::date)
													and extract(month from date_facp)=extract(month from now()::date)
													and extract(year from date_facp)=f_annee()
													order by date_facp
													");
		$i=1;
while ($lignecl2=pg_fetch_assoc($resultatcl2))

 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td style="text-align: left;">'.$lignecl2['nom_cl'].'  '.$lignecl2['prenom_cl'].'</td>';
	echo '<td style="text-align: left;">'.$lignecl2['date_facp'].'</td>';
	echo '<td style="text-align: right;">'.$lignecl2['id_fac'].'</td>';
	echo '<td style="text-align: left;">'.$lignecl2['motif'].'</td>';
	echo '<td style="text-align: right;">'.number_format($lignecl2['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$som_t2cl=$som_t2cl+$lignecl2['montant'];
	$i++;
	}
	echo '<tr>';
			echo '<th colspan="5" align="center" class="prix"><strong>TOTAL</strong></th>';
			echo '<th style="text-align: right;"><strong>'.number_format($som_t2cl,0,' ',' ').'</strong><sup>F</sup></th>'; 
			echo '</tr>';
		?>
		</table><br/>
<!-- ==========================================================VERSEMENTS-AGENCES=================================== -->
		<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th style="text-align: center;" colspan="7" >VERSEMENTS EFFECTUEE PAR DES AGENCES</th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 25%;text-align: left;">AGENCES</th>
			<th style=" width: 15%;text-align: left;">DATE</th>
			<th style="text-align: left;">TRANSFERTS N°</th> 
			<th style="width: 20%;text-align: left;">BANQUE</th>
			<th style="text-align: right;">MONTANT</th>	
		</tr>
		<?php
		$resultatbo2=pg_query($connexion, "SELECT id_tr,id_bo,nom_bo,date_trp,motif,montant,nom_b,compte_banc from trpaiement join boutiques using(id_bo) 
join banques using(id_b) where extract(day from date_trp)=extract(day from now()::date)
and extract(month from date_trp)=extract(month from now()::date)
and extract(year from date_trp)=f_annee()
order by date_trp");
		$i=1;
while ($lignebo2=pg_fetch_assoc($resultatbo2))

 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td style="text-align: left;">'.$lignebo2['nom_bo'].' </td>';
	echo '<td style="text-align: left;">'.$lignebo2['date_trp'].'</td>';
	echo '<td style="text-align: right;">'.$lignebo2['id_tr'].'</td>';
	
	echo '<td style="text-align: left;">'.$lignebo2['nom_b'].' '.$lignebo2['compte_banc'].'</td>';
	echo '<td style="text-align: right;">'.number_format($lignebo2['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$som_t2bo2=$som_t2bo2+$lignebo2['montant'];
	$i++;
	}
	echo '<tr>';
			echo '<th colspan="5" align="center" class="prix"><strong>TOTAL</strong></th>';
			echo '<th style="text-align: right;"><strong>'.number_format($som_t2bo2,0,' ',' ').'</strong><sup>F</sup></th>'; 
			echo '</tr>';
		?>
		</table><br/>
		
<!-- ==========================================================DEPENSES=================================== -->

<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th style="text-align: center;" colspan="7" >DEPENSES EFFECTUEE </th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="text-align: right;">DATE</th>
			<th style="width: 25%;text-align: left;">DESIGNATION</th>
			<th style=" width: 15%;text-align: left;">CAISSIERE</th>
			<th style="text-align: left;">BENEFICIERE</th> 
			
			<th style="text-align: right;">MONTANT</th>	
		</tr>
	
<?php
$depenses=pg_query($connexion, "SELECT * from depences 
                                   where extract(year from date_dep)=f_annee()
                                   and extract(month from date_dep)=extract(month from now()::date) 
                                   and extract(day from date_dep)=extract(day from now()::date)
                                   and id_bo=$uti order by date_dep ");	
                                   
$i=1;
while ($ldep=pg_fetch_assoc($depenses))

 {
 	
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
 	echo '<td style="text-align: left;">'.$ldep['date_dep'].'</td>';
	echo '<td style="text-align: left;">'.$ldep['lib_dep'].'</td>';
	echo '<td style="text-align: left;">'.$ldep['crencier'].'</td>';
	echo '<td style="text-align: right;">'.$ldep['beneficiere'].'</td>';
	
	echo '<td style="text-align: right;">'.number_format($ldep['montant'],0,' ',' ').'<sup>F</sup></td>';
   echo '</tr>';
   $som_dep=$som_dep+$ldep['montant'];	
   $i++;
	}
	echo '<tr>';
			echo '<th colspan="5" align="center" class="prix"><strong>TOTAL</strong></th>';
			echo '<th style="text-align: right;"><strong>'.number_format($som_dep,0,' ',' ').'</strong><sup>F</sup></th>'; 
			echo '</tr>';

?>
		</table><br/>
<!-- ==========================================================BILLAN=================================== -->
<?php
$resultat0=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from transferts 
													where extract(year from date_tr)=f_annee()  
													and extract(month from date_tr)=extract(month from now()::date) 
													and extract(day from date_tr)=extract(day from now()::date)
													");
$resultat1=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from facture 
													where extract(month from date_fac)=extract(month from now()::date) 
													and extract(day from date_fac)=extract(day from now()::date)
													and id_bo=$uti");
$resultat2=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from achat where extract(month from date_1)=extract(month from now()::date) 
													and extract(day from date_1)=extract(day from now()::date)
													and id_bo=$uti");
$resultat3=pg_query($connexion, "SELECT sum(montant) as montant 
													from depences where extract(month from date_dep)=extract(month from now()::date)
													and extract(day from date_dep)=extract(day from now()::date)
													and id_bo=$uti");


$rr0=pg_fetch_assoc($resultat0);
$som_a0=$rr0['somme'];
$som_v0=$rr0['payee'];
$som_d0=$rr0['reste'];

$rr=pg_fetch_assoc($resultat1);
$som_a=$rr['somme'];
$som_v=$rr['payee'];
$som_d=$rr['reste'];

$rr2=pg_fetch_assoc($resultat2);
$som_a2=$rr2['somme'];
$som_v2=$rr2['payee'];
$som_d2=$rr2['reste'];

$rr3=pg_fetch_assoc($resultat3);
$som_d3=$rr3['montant'];

$DEP=$rr3['montant']+$rr2['payee'];
$REC=$som_v=$rr['payee']+$som_v0=$rr0['payee'];
$BAL=$REC-$DEP;
?>		
<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">BILAN DU JOURS</td></tr>
</table><br/>
<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th colspan="3" style="width: 30%;text-align: center;">VENTES</th>
			<th colspan="3" style="width: 30%;text-align: center;">ACHATS</th>
			<th rowspan="2" style="width: 10%;text-align: center;">DEPENCES</th>
		</tr>
		<tr class="header3">
			<th  style="width: 10%;text-align: center;">TOTALS</th>
			<th  style="width: 10%;text-align: center;">PAYEES</th>
			<th  style="width: 10%;text-align: center;">RESTES</th>
			
			<th  style="width: 10%;text-align: center;">TOTALS</th>
			<th  style="width: 10%;text-align: center;">PAYEES</th>
			<th  style="width: 10%;text-align: center;">RESTES</th>
		</tr>
<?php
$ligne=pg_fetch_assoc($resultat1);

	echo '<tr>';
	echo '<td align="center">'.number_format($som_a+$som_a0,0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="center">'.number_format($som_v+$som_v0,0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="center">'.number_format($som_d+$som_d0,0,' ',' ').'<sup>F</sup></td>';
			
$ligne=pg_fetch_assoc($resultat2);

	echo '<td align="center">'.number_format($som_a2,0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="center">'.number_format($som_v2,0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="center">'.number_format($som_d2,0,' ',' ').'<sup>F</sup></td>';						
			
$ligne=pg_fetch_assoc($resultat3);

	echo '<td align="center">'.number_format($som_d3,0,' ',' ').'<sup>F</sup></td>';
	echo '</tr>';			
?>

</table><br/>

<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
		<tr><td class="myalc w1 cl3 t2 bg1">LA BALANCE DU JOURS</td></tr>
		
</table><br/>

<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
			<th  style="width: 30%;text-align: center;">RECETTES TOTALES</th>
			<th  style="width: 30%;text-align: center;">DEPENCES TOTALES</th>
			<th  style="width: 10%;text-align: center;">BALANCE</th>
		</tr>
<?php
echo '<tr>';
	echo '<td align="center">'.number_format($som_v+$som_v0,0,' ',' ').'<sup>F</sup></td>';
	echo '<td align="center">'.number_format($DEP,0,' ',' ').'<sup>F</sup></td>';
	echo '<th align="center"><strong>'.number_format($BAL,0,' ',' ').'<sup>F</sup></strong></th>';
	echo '</tr>';	
?>
</table><br/>

<!-- ==========================================================MOUVEMENT-BANCAIRE=================================== -->
<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
		<tr class="header3">
		    <th style="text-align: center;" colspan="7" >MOUVEMENTS BANCAIRE </th>	
		</tr>
		<tr class="header3">
			<th style="width: 4px;text-align: center;"></th><th style="width: 15%;text-align: left;">DATE</th>
			<th style="text-align: left;">TYPE</th>
			<th style=" width: 35%;text-align: left;">PORTEUR & MOTIF</th>
			<th style="text-align: left;">BANQUE</th>
			<th style="text-align: rigth;">SOMME</th> 
			
				
		</tr>
		
		<?php
		$verait=pg_query($connexion, "SELECT verait.*, nom_b,compte_banc 
											from verait join banques using(id_b) 
											where extract(day from date_vr)=extract(day from now()::date) 
											and extract(month from date_vr)=extract(month from now()::date) 
											and extract(year from date_vr)=extract(year from now()::date)
											order by date_vr desc");
		$i=1;
while ($ligne=pg_fetch_assoc($verait))
 {
 	echo '<tr>';
 	echo '<td>'.$i.'</td>';
	echo '<td style="text-align: center;">'.$ligne['date_vr'].'</td>';
	if($ligne['type']=='v') 
		echo '<td style="text-align: left;">Versement</td>';
	else 
		echo '<td style="text-align: left;">Retrait</td>';
	echo '<td style="text-align: left;">'.$ligne['porteur'].'</td>';
	echo '<td style="text-align: left;">'.$ligne['nom_b'].'  '.$ligne['compte_banc'].'</td>';
	echo '<td style="text-align: right;">'.number_format($ligne['somme'],0,' ',' ').'<sup>F</sup></td>';
	echo '</tr>';
	$i++;
	}
		?>
		</table>
<br/>
<br/>
<?php include('foter.php');?>		
</page>

