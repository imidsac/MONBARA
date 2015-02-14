<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
?>
<div id="content">
<?php
include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
$som_d=0;
$som_t=0;
$som_t2=0;
$som_t2bo=0;
$som_t2cl=0;
$som_a0=0;
$som_v0=0;
$som_d0=0;
$som_dep=0;
$Q=0;
$v=0;
$s=0;
?>
<div id="colTwo">
 
<h1 align="center"><i>ON EST LE <? echo date("d/m/Y");?></i></h1>
<h1 align="center"><strong>LES RETOURS D'AUJOURD'HUI</strong></h1>
	
<?php
/*$resultat=pg_query($connexion, "select  distinct lib_ar, type_ar, qte_ar,facture_con.prix_vente,(qte_ar*facture_con.prix_vente) as montant
                                      from facture_con join  facture using(id_fac) join articles using(id_ar)
                                      where extract(day from date_fac)=extract(day from now()::date)
                                      and extract(month from date_fac)=extract(month from now()::date)
                                       and extract(year from date_fac)=f_annee()
                                       and id_bo=$uti
                                        group by  lib_ar,type_ar,qte_ar,facture_con.prix_vente order by lib_ar,type_ar
													");*/



$resultat0=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from transferts 
													where extract(year from date_tr)=f_annee()  
													and extract(month from date_tr)=extract(month from now()::date) 
													and extract(day from date_tr)=extract(day from now()::date)
													");
$resultat1=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from facture 
													where extract(year from date_fac)=f_annee()  
													and extract(month from date_fac)=extract(month from now()::date) 
													and extract(day from date_fac)=extract(day from now()::date)
													and id_bo=$uti");
$resultat2=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from achat 
													where extract(year from date_1)=f_annee()  
													and extract(month from date_1)=extract(month from now()::date) 
													and extract(day from date_1)=extract(day from now()::date)
													and id_bo=$uti");
$resultat3=pg_query($connexion, "SELECT sum(montant) as montant 
													from depences 
													where extract(year from date_dep)=f_annee()  
													and extract(month from date_dep)=extract(month from now()::date)
													and extract(day from date_dep)=extract(day from now()::date)
													and id_bo=$uti");

$rr=pg_fetch_assoc($resultat);
$Q=$rr['nb_qte'];
$s=$rr['montant'];


$rr0=pg_fetch_assoc($resultat0);
$som_a0=$rr0['somme'];
$som_v0=$rr0['payee'];
$som_d0=$rr0['reste'];

$rr1=pg_fetch_assoc($resultat1);
$som_a=$rr1['somme'];
$som_v=$rr1['payee'];
$som_d=$rr1['reste'];

$rr2=pg_fetch_assoc($resultat2);
$som_a2=$rr2['somme'];
$som_v2=$rr2['payee'];
$som_d2=$rr2['reste'];

$rr3=pg_fetch_assoc($resultat3);
$som_d3=$rr3['montant'];

echo '<a href="journer.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Recherche</button></a>';
if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 ) {
echo '<a href="/html2pdf/pdf/journe_pdf.php" title="Les retours en format pdf">
<img src="images/pdf/pdf.png" width="6%" height="10%" alt="" align="right" border="0" />
</a>';
echo '<table cellpadding="8" cellspacing="0" border="1" align="center" class="jquery.ui-widget ui-widget-content bw" style="width:95%;" rules="groups">';
echo '<tr class="header2 bw">
		
			<th colspan="3" align="center">VENTES</th>
			<th colspan="3" align="center">ACHATS</th>
			<th rowspan="2" align="center">DEPENCES</th>
			
		</tr>';
echo '<tr class="header2 bw">
		
			<th >TOTAL</th>
			<th >PAYEE</th>
			<th >RESTE</th>
			
			<th >TOTAL</th>
			<th >PAYEE</th>
			<th >RESTE</th>
			
			<!-- <th ></th> -->
			
			
		</tr>';
//$ligne=pg_fetch_assoc($resultat1);

			echo '<tr>';
			echo '<td align="center" class="lcentre cnoire">'.number_format($som_a+$som_a0,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="center" class="lcentre cbleu">'.number_format($som_v+$som_v0,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="center" class="lcentre crouge">'.number_format($som_d+$som_d0,0,' ',' ').'<sup>F</sup></td>';
			
			//$ligne=pg_fetch_assoc($resultat2);

			echo '<td align="center" class="lcentre cnoire">'.number_format($som_a2,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="center" class="lcentre cbleu">'.number_format($som_v2,0,' ',' ').'<sup>F</sup></td>';
			echo '<td align="center" class="lcentre crouge">'.number_format($som_d2,0,' ',' ').'<sup>F</sup></td>';			
			
			//$ligne=pg_fetch_assoc($resultat3);
			echo '<td align="center" class="lcentre crouge">'.number_format($som_d3,0,' ',' ').'<sup>F</sup></td>';
			echo '</tr>';
			

echo '</table>';
}
echo '<br>';
/*
echo '<table align="center" style="width:50%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">ETAT JOURNALIER DES VENTES</h5></th></tr>';
  
	
echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
		<th class="lgauche">ARTICLE</th>
		<th class="lgauche">REFERENCE</th>';
		
echo	'<th class="lgauche">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
echo	'<th class="ldroite">MONTANT</th>';	
				
echo	'</tr>';

$i=1;
while ($ligne=pg_fetch_assoc($resultat))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td>'.$ligne['lib_ar'].'</td>';
	echo '<td>'.$ligne['type_ar'].'</td>';
	echo '<td>'.$ligne['qte_ar'].'</td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	echo '<td class="ldroite cbleu">'.number_format($ligne['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	echo '</tr>';
	$i++;
	}
	

echo '</table>';
*/
echo '<br>';
if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==3) {
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="7"><h5 align="center" class="titre1">ETAT GENERAL DES CLIENTS</h5></th></tr>';
echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
		<th  class="lgauche">CLIENTS</th>
		<th colspan="2" class="lcentre">PRODUITS</th>';
		
echo	'<th class="ldroite">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
		
echo	'<th class="ldroite">MONTANT</th>';
				
echo	'</tr>';

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
 	 $coleur=ligneColor(); 
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
 	echo '<tr class="'.$coleur.' bw">';
 	   
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro.'">'.$i++.'</td>';
 	   	  echo '<td rowspan="'.$ro.'" class="lgauche cnoire" >'.$ligne['nom_cl'].'  '.$ligne['prenom_cl'].'</td>';  
 	   }
 	   echo '<td >'.$la['lib_ar'].'</td>';
	   echo '<td >'.$la['type_ar'].'</td>';
	   echo '<td class="ldroite cnoire">'.number_format($la['qte_ar'],0,' ',' ').'</td>';
	   echo '<td class="ldroite cbleu">'.number_format($la['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	    echo '<td class="ldroite cbleu">'.number_format($la['montant'],0,' ',' ').'<sup>F</sup></td>';
 	echo '</tr>';
 	$j++;
 	$som_t=$som_t+$la['montant'];
 	}
 	$k++;
 
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';		


if($_SESSION['id_bo'] == 1 ) {
//========================================AGENCES=======================================================
	echo '<tr class="header3 bw"><th colspan="7"><h5 align="center" class="titre1">ETAT GENERAL DES AGENCES</h5></th></tr>';
      echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
		<th  class="lgauche">AGENCES</th>
		<th colspan="2" class="lcentre">PRODUITS</th>';
		
echo	'<th class="ldroite">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
		
echo	'<th class="ldroite">MONTANT</th>';
				
echo	'</tr>';

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
 	 $coleur=ligneColor(); 
 	$id_bo=$ligne['id_bo'];
 $lscountbo=pg_query($connexion, "select count(*) as nb from (select id_bo,id_ar,prix_vente  
                              from transferts_con join  transferts using(id_tr)  
                              where extract(day from date_tr)=extract(day from now()::date) 
                              and extract(month from date_tr)=extract(month from now()::date) 
                              and extract(year from date_tr)=f_annee() 
                              and id_bo=$id_bo group by id_bo,id_ar,prix_vente order by id_bo) as tt ");

	$lsachat2=pg_query($connexion, "select id_bo,lib_ar, type_ar, sum(qte_ar) as qte_ar,transferts_con.prix_vente,
		                         sum(qte_ar*transferts_con.prix_vente) as montant 
	                           from transferts_con join  transferts using(id_tr) join articles using(id_ar)  
	                           where extract(day from date_tr)=extract(day from now()::date) 
                              and extract(month from date_tr)=extract(month from now()::date) 
                              and extract(year from date_tr)=f_annee() and id_bo=$id_bo 
	                           group by  id_ar,lib_ar,type_ar,transferts_con.prix_vente,id_bo order by lib_ar,type_ar");
	                          
	                           
	$ht2=pg_fetch_assoc($lscountbo);
	$ro2=$ht2['nb'];
	
	$j=1;
	while ($la2=pg_fetch_assoc($lsachat2))
    {
 	echo '<tr class="'.$coleur.' bw">';
 	   
 	   if($j==1){
 	   	  echo '<td rowspan="'.$ro2.'">'.$i++.'</td>';
 	   	  echo '<td rowspan="'.$ro2.'" class="lgauche cnoire" >'.$ligne['nom_bo'].'</td>';  
 	   }
 	   echo '<td >'.$la2['lib_ar'].'</td>';
	   echo '<td >'.$la2['type_ar'].'</td>';
	   echo '<td class="ldroite cnoire">'.number_format($la2['qte_ar'],0,' ',' ').'</td>';
	   echo '<td class="ldroite cbleu">'.number_format($la2['prix_vente'],0,' ',' ').'<sup>F</sup></td>';
	    echo '<td class="ldroite cbleu">'.number_format($la2['montant'],0,' ',' ').'<sup>F</sup></td>';
 	echo '</tr>';
 	$j++;
 	$som_t2=$som_t2+$la2['montant'];
 	}
 	$k++;
 
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="6" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t2,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
			}
//========================================================SORTIE====================================

	$rproduit=pg_query($connexion, "select id_ar,lib_ar,type_ar,entree,sortie, f_stoc_ar(id_ar,1) from 
(
     (
       select id_ar,sum( qt_ar) as entree 
        from achat_con join achat using(id_ac) join articles using(id_ar)  
        where  id_bo=$uti and extract(day from date_1)=extract(day from now()::date)
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
                where extract(day from date_tr)=extract(day from now()::date)
                and extract(month from date_tr)=extract(month from now()::date)
                and extract(year from date_tr)=f_annee() 
                group by  id_ar 
              ) 
                union 
              (
                select id_ar,sum( qte_ar) as sortie from facture_con 
                join facture using(id_fac) join articles using(id_ar) 
                where id_bo=$uti
                and extract(day from date_fac)=extract(day from now()::date)
                and extract(month from date_fac)=extract(month from now()::date)
                and extract(year from date_fac)=f_annee()
                group by  id_ar 
               )
             ) as tt group by id_ar 
             
      ) as sortie using(id_ar)
      
) as ggg join articles using(id_ar) order by lib_ar,type_ar");	
                                         	
			echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">MOUVEMENT DE STOCK</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
					<th colspan="3" class="lgauche">PRODUIT</th>';
		   //echo	'<th   class="ldroite">INITIALES</th>';
			echo	'<th  colspan="2" class="ldroite">ENTREES</th>';
			echo	'<th  colspan="2" class="ldroite">SORTIES</th>';
			//echo	'<th  class="ldroite">ACTUELS</th>';
			echo	'</tr>';
			$i=1;
while ($lrp=pg_fetch_assoc($rproduit))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td colspan="3" class="lgauche cnoire" >'.$lrp['lib_ar'].  '  '  .$lrp['type_ar'].'</td>';
	echo '<td colspan="2" class="ldroite crouge">'.number_format($lrp['entree'],0,' ',' ').'</td>';
	echo '<td colspan="2" class="ldroite crouge">'.number_format($lrp['sortie'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}			
	
//========================================================ENTREE====================================
/*
	$reproduit=pg_query($connexion, "select id_ar,lib_ar, type_ar,sum( qt_ar) as qte_ar 
                                         from achat_con join achat using(id_ac) join articles using(id_ar)  
                                         where  id_bo=$uti
                                         and extract(day from date_1)=extract(day from now()::date)
                                         and extract(month from date_1)=extract(month from now()::date)
                                         and extract(year from date_1)=f_annee() 
                                         group by  lib_ar,type_ar,id_ar order by lib_ar");	
                                         	
			echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">ENTREES</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
					<th colspan="4" class="lgauche">PRODUIT</th>';
			echo	'<th  colspan="3" class="ldroite">QUANTITE</th>';
			echo	'</tr>';
			$i=1;
while ($lrep=pg_fetch_assoc($reproduit))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td colspan="4" class="lgauche cnoire" >'.$lrep['lib_ar'].  '  '  .$lrep['type_ar'].'</td>';
	echo '<td colspan="3" class="ldroite crouge">'.number_format($lrep['qte_ar'],0,' ',' ').'</td>';
	echo '</tr>';
	$i++;
	}	*/								
			
echo '</table>';
}
echo '<br>';


 if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==4) {
//==========================================================VERSEMENTS===============================================



$resultatcl2=pg_query($connexion, "SELECT facpaiement.id_cl,id_fac,nom_cl,prenom_cl,date_facp,motif,montant 
	                                                from facpaiement join clients using(id_cl) 
													where facpaiement.id_bo=$uti
													and extract(day from date_facp)=extract(day from now()::date)
													and extract(month from date_facp)=extract(month from now()::date)
													and extract(year from date_facp)=f_annee()
													order by date_facp
													");

echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="10"><h5 align="center" class="titre1">VERSEMENTS EFFECTUEE PAR DES CLIENTS</h5></th></tr>';
  
	
echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
		<th colspan="2" class="lcentre">CLIENTS</th>
		<th class="ldroite">FACTURE N°</th>
		<th class="lcentre">DATE</th>';
		
echo	'<th colspan="2" >MOTIFS</th>';
		
echo	'<th colspan="2" class="ldroite">MONTANT</th>';
				
echo	'</tr>';

$i=1;
while ($lignecl2=pg_fetch_assoc($resultatcl2))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td class="cnoire">'.$lignecl2['nom_cl'].'</td>';
	echo '<td class="cnoire">'.$lignecl2['prenom_cl'].'</td>';
	echo '<td class="crouge ldroite">'.$lignecl2['id_fac'].'</td>';
	echo '<td class="lcentre ">'.$lignecl2['date_facp'].'</td>';
	echo '<td colspan="2">'.$lignecl2['motif'].'</td>';
	echo '<td colspan="2" class="ldroite cbleu">'.number_format($lignecl2['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$som_t2cl=$som_t2cl+$lignecl2['montant'];
	$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="7" align="center"><strong>TOTAL</strong></td>';
			echo '<td colspan="2" class="ldroite cnoire"><strong>'.number_format($som_t2cl,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
echo '</table><br>';
}
if($_SESSION['id_bo'] == 1 ) {
	if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==4 || $_SESSION['gid'] ==5) {
//===============================================AGENCE=======================================================
$resultatbo2=pg_query($connexion, "SELECT id_tr,id_bo,nom_bo,date_trp,motif,nom_b,compte_banc,montant from trpaiement join boutiques using(id_bo)                                                                                          
                                      full join banques using(id_b) 
                                      where extract(day from date_trp)=extract(day from now()::date)
                                      and extract(month from date_trp)=extract(month from now()::date)
                                      and extract(year from date_trp)=f_annee()
                                      order by nom_bo
													");
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="10"><h5 align="center" class="titre1">VERSEMENTS EFFECTUEE PAR AGENCES</h5></th></tr>';
  
	
echo '<tr class="header2 lgauche bw"><th>NÂ°</th>
		<th colspan="2" class="lcentre">AGENCE</th>
		<th class="ldroite">TRANSFERT N°</th>
		<th class="lcentre">DATE</th>';
		
echo	'<th class="lcentre">MOTIFS</th>';
 echo	'<th colspan="2" class="lcentre">BANQUE</th>';
echo	'<th class="ldroite">MONTANT</th>';
				
echo	'</tr>';

$i=1;
while ($lignebo2=pg_fetch_assoc($resultatbo2))

 {
 	
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td>'.$i.'</td>';
	echo '<td colspan="2" class="cnoire">'.$lignebo2['nom_bo'].'</td>';
	echo '<td class="crouge ldroite">'.$lignebo2['id_tr'].'</td>';
	echo '<td class="lcentre">'.$lignebo2['date_trp'].'</td>';
	echo '<td class="lcentre">'.$lignebo2['motif'].'</td>';
	echo '<td colspan="2" class="lcentre">'.$lignebo2['nom_b'].' '.$lignebo2['compte_banc'].'</td>';
	echo '<td class="ldroite cbleu">'.number_format($lignebo2['montant'],0,' ',' ').'<sup>F</sup></td>';
	
	
	echo '</tr>';
	$som_t2bo=$som_t2bo+$lignebo2['montant'];
	$i++;
	}
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="8" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_t2bo,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';
}
}
echo '</table><br>';
if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==4) {
//==========================================================DEPENSES===============================================
$depenses=pg_query($connexion, "SELECT * from depences 
                                   where extract(year from date_dep)=f_annee()
                                   and extract(month from date_dep)=extract(month from now()::date) 
                                   and extract(day from date_dep)=extract(day from now()::date)
                                   and id_bo=$uti order by date_dep desc");	
                                         	
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';			
			echo '<tr class="header3 bw"><th colspan="10"><h5 align="center" class="titre1">DEPENSES EFFECTUEE</h5></th></tr>';
			echo '<tr class="header2 lgauche bw">
			<th>NÂ°</th>
			<th colspan="2" class="lcentre">DESIGNATION</th>
			<th colspan="2">CAISSIERE</th>
			<th colspan="2" class="ldroite">BENEFICIERE</th>
			<th>DATE</th>
			<th class="ldroite">MONTANT</th>';
			echo	'</tr>';
 	
 	$i=1;
while ($ldep=pg_fetch_assoc($depenses))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td colspan="2">'.$i.'</td>';
	echo '<td>'.$ldep['lib_dep'].'</td>';
	echo '<td colspan="2">'.$ldep['crencier'].'</td>';
	echo '<td colspan="2">'.$ldep['beneficiere'].'</td>';
	echo '<td>'.$ldep['date_dep'].'</td>';
	echo '<td align="right" class="ldroite crouge">'.number_format($ldep['montant'],0,' ',' ').'<sup>F</sup></td>';
	$som_dep=$som_dep+$ldep['montant'];
	$i++;
	}		
	echo '<tr class="header2 lgauche bw">';
			echo '<td colspan="8" align="center"><strong>TOTAL</strong></td>';
			echo '<td class="ldroite cnoire"><strong>'.number_format($som_dep,0,' ',' ').'</strong><sup>F</sup></td>'; 
			echo '</tr>';	
echo '</table>';
}

if($_SESSION['gid'] ==1 || $_SESSION['gid'] ==1000 || $_SESSION['gid'] ==5) {
//==========================================================MOUVEMENT-BANCAIRE=================================== 
$verait=pg_query($connexion, "SELECT verait.*, nom_b,compte_banc 
											from verait join banques using(id_b) 
											where extract(day from date_vr)=extract(day from now()::date) 
											and extract(month from date_vr)=extract(month from now()::date) 
											and extract(year from date_vr)=extract(year from now()::date)
											order by date_vr desc");
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';			
			echo '<tr class="header3 bw"><th colspan="10"><h5 align="center" class="titre1">MOUVEMENT-BANCAIRE</h5></th></tr>';
			echo '<tr class="header2 lgauche bw">
			<th>NÂ°</th>
			<th colspan="" class="lcentre">DATE</th>
			<th colspan="">TYPE</th>
			<th colspan="3" ">PORTEUR & MOTIF</th>
			<th colspan="2">BANQUE</th>
			<th class="ldroite">SOMME</th>';
			echo	'</tr>';
 	
 	$i=1;
while ($ligne=pg_fetch_assoc($verait))
 {
 	echo '<tr class="'.ligneColor().' bw">';
 	echo '<td >'.$i.'</td>';
	echo '<td>'.$ligne['date_vr'].'</td>';
	if($ligne['type']=='v') 
		echo '<td class="lgauche cbleu">Versement</td>';
	else 
		echo '<td class="lguache crouge">Retrait</td>';
	echo '<td colspan="3">'.$ligne['porteur'].'</td>';
	echo '<td colspan="2">'.$ligne['nom_b'].'  '.$ligne['compte_banc'].'</td>';
	echo '<td align="right" class="ldroite crouge">'.number_format($ligne['somme'],0,' ',' ').'<sup>F</sup></td>';
	//$som_dep=$som_dep+$ldep['montant'];
	$i++;
	}		
echo '</table>';
}
?>
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
