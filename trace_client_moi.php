<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
	$id_cl=$_GET['id_cl'];
	$nom_cl=$_GET['nom_cl'];
	$prenom_cl=$_GET['prenom_cl'];
	$add_cl=$_GET['add_cl'];
	$tel1_cl=$_GET['tel1_cl'];
	$som_t=0;
	$som_p=0;
	$som_r=0;
?>
<div id="content">
<?php
include_once('sidebar.php');
echo '<div id="colTwo">';
echo fan();
echo fmois_cl($id_cl,$annee);
echo '<h1 align="center"><strong><em><pre>'.getPeriodes($mois).'</pre></em></strong></h1>';


$rmois=pg_query($connexion, "select count(*) as nb from facture  
                                where id_cl=$id_cl
                                and extract(month from date_fac)=$mois
                                and extract(year from date_fac)=$annee 
                                and id_bo=$uti");

$rr=pg_fetch_assoc($rmois);
if($rr['nb']!=0) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">ETAT GENERAL</h5></th></tr>';

echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th  class="lgauche">DATE</th>
		<th colspan="2" class="lcentre">PRODUITS</th>';
		
echo	'<th class="ldroite">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
		
echo	'<th class="ldroite">MONTANT</th>';
				
echo	'</tr>';



$lsclient=pg_query($connexion, "select id_fac,date_fac,somme, payee,reste 
                                  from facture  
                                  where id_cl=$id_cl 
                                  and extract(month from date_fac)=$mois
                                  and extract(year from date_fac)=$annee 
                                  order by date_fac");

$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsclient))
 {
 	 $coleur=ligneColor(); 
$date_fac=$ligne['date_fac'];
$lscountcl=pg_query($connexion, "select date_fac,id_cl,count(*) as nb from (select date_fac,id_cl  
                                     from facture_con join  facture using(id_fac)  
                                     where id_cl=$id_cl and date_fac='$date_fac'
                                     group by id_ar,date_fac,id_cl order by date_fac) as tt  
                                     group by date_fac,id_cl order by date_fac");
$ht=pg_fetch_assoc($lscountcl);
	$ro=$ht['nb'];

	$lsachat=pg_query($connexion, "select date_fac,id_cl,lib_ar, type_ar, qte_ar,facture_con.prix_vente,(qte_ar*facture_con.prix_vente) as montant 
                                     from facture_con join  facture using(id_fac) join articles using(id_ar)  
                                     where id_cl=$id_cl and date_fac='$date_fac'
                                     group by  lib_ar,type_ar,qte_ar,facture_con.prix_vente,id_cl,date_fac 
                                     order by date_fac,lib_ar,type_ar");
	                          
	
	$j=1;
	while ($la=pg_fetch_assoc($lsachat))
    {
    	
 	echo '<tr class="'.$coleur.' bw">';
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro.'" class="lcentre crouge">'.$ligne['id_fac'].'</td>';
 	   	  echo '<td rowspan="'.$ro.'" class="lgauche cnoire" >'.$ligne['date_fac'].'</td>';  
 	   }
 	   echo '<td >'.$la['lib_ar'].'</td>';
	   echo '<td >'.$la['type_ar'].'</td>';
	   echo '<td class="ldroite cnoire">'.number_format($la['qte_ar'],0,' ',' ').'</td>';
	   echo '<td class="ldroite cbleu">'.number_format($la['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	   echo '<td class="ldroite cbleu">'.number_format($la['montant'],0,' ',' ').'<sup>F</sup></td>';
	   
 	echo '</tr>';
 	$j++;
 	}
 	$k++;
 	$som_t=$som_t+$ligne['somme'];
 	$som_p=$som_p+$ligne['payee'];
 	$som_r=$som_r+$ligne['reste'];
	}
	
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>PAYEE</strong></td>';
			echo '<td class="ldroite cbleu"><strong>'.number_format($som_p,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>RESTE</strong></td>';
			echo '<td class="ldroite crouge"><strong>'.number_format($som_r,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
//========================================================TOTAL-PRODUIT====================================

	$rproduit=pg_query($connexion, "select id_cl,id_ar,lib_ar, type_ar,sum( qte_ar) as qte_ar 
                                     from facture_con join  facture using(id_fac) join articles using(id_ar)   
                                     where id_cl=$id_cl and extract(month from date_fac)=$mois
                                     and extract(year from date_fac)=$annee
                                     group by  lib_ar,type_ar,id_cl,id_ar 
                                     order by lib_ar");		
			echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">TOTAL-PRODUITS</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th colspan="4" class="lcentre">PRODUIT</th>';
			echo	'<th  colspan="3" class="lcentre">QUANTITE</th>';
			echo	'</tr>';
			$i=1;
while ($lrp=pg_fetch_assoc($rproduit))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td colspan="4" class="lgauche cnoire" >'.$lrp['lib_ar'].  '  '  .$lrp['type_ar'].'</td>';
	echo '<td colspan="3" class="ldroite crouge">'.number_format($lrp['qte_ar'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}			
echo '</table><br>';
}
else { 
echo '<div style="text-align: center"><h1 class="lcentre crouge"><strong>Pas des factures pour client(e) dans ce mois!!!!</strong></h1></div>';	}


$rmoisv=pg_query($connexion, "select count(*) as nb from facpaiement  
                                where id_cl=$id_cl
                                and extract(month from date_facp)=$mois
                                and extract(year from date_facp)=$annee 
                                ");

$rrv=pg_fetch_assoc($rmoisv);
if($rrv['nb']!=0) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
$resultat=pg_query($connexion, "SELECT id_fac,date_facp,motif,montant from facpaiement 
											  where id_cl=$id_cl   and extract(month from date_facp)=$mois  
											  and extract(year from date_facp)=$annee order by date_facp
													");			
			echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">VERSEMENT EFFECTUEE</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th  class="lcentre">DATE</th>';
			echo	'<th  class="lcentre">FACTURE N</th>';
			echo	'<th colspan="2" class="lcentre">MOTIFS</th>';
		
			echo	'<th colspan="2" class="ldroite">MONTANT</th>';
				
			echo	'</tr>';

$i=1;
while ($ligne=pg_fetch_assoc($resultat))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td >'.$ligne['date_facp'].'</td>';
	echo '<td class="ldroite crouge">'.number_format($ligne['id_fac'],0,' ',' ').'</td>';
	echo '<td colspan="2" class="lcentre">'.$ligne['motif'].'</td>';
	echo '<td colspan="2" class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$i++;
	}			
			
echo '</table>';
}
else { 
echo '<div ><h1  class="lcentre crouge"><strong>Pas des versements pour client(e) dans ce mois!!!!</strong></h1></div>';	}

?>

	
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
