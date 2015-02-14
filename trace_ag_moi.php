<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_bo=$_GET['id_bo'];
	$nom_bo=$_GET['nom_bo'];
	$adr_bo=$_GET['adr_bo'];
	$tel_bo=$_GET['tel_bo'];
	$som_t=0;
	$som_p=0;
	$som_r=0;
?>
<div id="content">
<?php
include_once('sidebar.php');

echo '<div id="colTwo">';
	echo fan();
echo fmois_ag($id_bo,$annee);
echo '<h1 align="center"><strong><em><pre>'.getPeriodes($mois).'</pre></em></strong></h1>';


$rmois=pg_query($connexion, "select count(*) as nb from transferts  
                                where id_bo=$id_bo
                                and extract(month from date_tr)=$mois
                                and extract(year from date_tr)=$annee 
                                ");

$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">ETAT GENERAL</h5></th></tr>';

echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th  class="lgauche">DATE</th>
		<th colspan="2" class="lcentre">PRODUITS</th>';
		
echo	'<th class="ldroite">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
		
echo	'<th colspan="3" class="ldroite">MONTANT</th>';
				
echo	'</tr>';



$lsclient=pg_query($connexion, "select id_tr,date_tr,somme, payee,reste 
                                  from transferts  
                                  where id_bo=$id_bo 
                                  and extract(month from date_tr)=$mois
                                  and extract(year from date_tr)=$annee 
                                  order by date_tr");

$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsclient))
 {
 	 $coleur=ligneColor(); 
$date_tr=$ligne['date_tr'];
$lscountcl=pg_query($connexion, "select date_tr,id_bo,count(*) as nb from (select date_tr,id_bo  
                                     from transferts_con join  transferts using(id_tr)  
                                     where id_bo=$id_bo and date_tr='$date_tr'
                                     group by id_ar,date_tr,id_bo order by date_tr) as tt  
                                     group by date_tr,id_bo order by date_tr");
$ht=pg_fetch_assoc($lscountcl);
	$ro=$ht['nb'];

	$lsachat=pg_query($connexion, "select date_tr,id_bo,lib_ar, type_ar, qte_ar,transferts_con.prix_vente,(qte_ar*transferts_con.prix_vente) as montant 
                                     from transferts_con join  transferts using(id_tr) join articles using(id_ar)  
                                     where id_bo=$id_bo and date_tr='$date_tr'
                                     group by  lib_ar,type_ar,qte_ar,transferts_con.prix_vente,id_bo,date_tr 
                                     order by date_tr,lib_ar,type_ar");
	                          
	
	$j=1;
	while ($la=pg_fetch_assoc($lsachat))
    {
    	
 	echo '<tr class="'.$coleur.' bw">';
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro.'" class="lcentre crouge">'.$ligne['id_tr'].'</td>';
 	   	  echo '<td rowspan="'.$ro.'" class="lgauche cnoire" >'.$ligne['date_tr'].'</td>';  
 	   }
 	   echo '<td >'.$la['lib_ar'].'</td>';
	   echo '<td >'.$la['type_ar'].'</td>';
	   echo '<td class="ldroite cnoire">'.number_format($la['qte_ar'],0,' ',' ').'</td>';
	   echo '<td class="ldroite cbleu">'.number_format($la['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	   echo '<td colspan="3" class="ldroite cbleu">'.number_format($la['montant'],0,' ',' ').'<sup>F</sup></td>';
	   
 	echo '</tr>';
 	$j++;
 	}
 	$k++;
 	$som_t=$som_t+$ligne['somme'];
 	$som_p=$som_p+$ligne['payee'];
 	$som_r=$som_r+$ligne['reste'];
	}
	
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="7" align="center"><strong>TOTAL</strong></td>';
			echo '<td colspan="2" class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="7" align="center"><strong>PAYEE</strong></td>';
			echo '<td colspan="2" class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="7" align="center"><strong>RESTE</strong></td>';
			echo '<td colspan="2" class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
//========================================================TOTAL-PRODUIT====================================

	$rproduit=pg_query($connexion, "select id_bo,id_ar,lib_ar, type_ar,sum( qte_ar) as qte_ar 
                                     from transferts_con join  transferts using(id_tr) join articles using(id_ar)   
                                     where id_bo=$id_bo and extract(month from date_tr)=$mois
                                     and extract(year from date_tr)=$annee
                                     group by  lib_ar,type_ar,id_bo,id_ar 
                                     order by lib_ar");		
			echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">TOTAL-PRODUITS</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th colspan="4" class="lgauche">PRODUIT</th>';
			echo	'<th  colspan="4" class="ldroite">QUANTITE</th>';
			echo	'</tr>';
			$i=1;
while ($lrp=pg_fetch_assoc($rproduit))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td colspan="4" class="lgauche cnoire" >'.$lrp['lib_ar'].  '  '  .$lrp['type_ar'].'</td>';
	echo '<td colspan="4" class="ldroite crouge">'.number_format($lrp['qte_ar'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}			
echo '</table><br>';
}
else { 
echo '<div style="text-align: center"><h1 class="lcentre crouge"><strong>Pas des factures pour agence dans ce mois!!!!</strong></h1></div>';	}



$rmoisv=pg_query($connexion, "select count(*) as nb from trpaiement  
                                where id_bo=$id_bo
                                and extract(month from date_trp)=$mois
                                and extract(year from date_trp)=$annee 
                                ");

$rrv=pg_fetch_assoc($rmoisv);
if($rrv['nb']!=0) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
$resultat=pg_query($connexion, "SELECT id_tr,date_trp,motif,nom_b,compte_banc,montant from trpaiement full join banques using(id_b)
											  where id_bo=$id_bo   and extract(month from date_trp)=$mois  
											  and extract(year from date_trp)=$annee order by date_trp
													");
			echo '<tr class="header3 bw"><th colspan="9"><h5 align="center" class="titre1">VERSEMENT EFFECTUEE</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th  class="lcentre">DATE</th>';
			echo	'<th  class="lcentre">transferts N</th>';
			echo	'<th colspan="2" class="lcentre">MOTIFS</th>';
		   echo	'<th colspan="2" class="lcentre">BANQUE</th>';
			echo	'<th colspan="2" class="ldroite">MONTANT</th>';
				
			echo	'</tr>';

$i=1;
while ($ligne=pg_fetch_assoc($resultat))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td >'.$ligne['date_trp'].'</td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['id_tr'],0,' ',' ').'</td>';
	echo '<td colspan="2" class="lcentre">'.$ligne['motif'].'</td>';
	echo '<td colspan="2" class="lcentre">'.$ligne['nom_b'].' '.$ligne['compte_banc'].'</td>';
	echo '<td colspan="2" class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$i++;
	}			
			
echo '</table>';
}
else { 
echo '<div style="text-align: center"><h1 class="lcentre crouge"><strong>Pas des versements pour agence dans ce mois!!!!</strong></h1></div>';	}


//}
?>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
