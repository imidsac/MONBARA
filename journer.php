<?php
include_once('header.php');
include_once('session.php');
include_once('connection.php');
$EDATE=2012; 
?>
<div id="content">
<?php
include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
$som_d=0;
?>
<div id="colTwo">
<!-- <a href="/html2pdf/pdf/journe_pdf.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Le Fichier(PDF)</button></a> -->
<a href="journer.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Recherche</button></a>

<h1 align="center"><strong>ENTREEZ LA DATE DE VOTRE CHOIX</strong></h1>
	
<?php
/*$resultat1=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from facture 
													where extract(year from date_fac)=f_annee()  
													and extract(month from date_fac)=extract(month from now()::date) 
													and extract(day from date_fac)=extract(day from now()::date)");
$resultat2=pg_query($connexion, "SELECT sum(payee) as payee,sum(reste) as reste,sum(somme) as somme 
													from achat 
													where extract(year from date_1)=f_annee()  
													and extract(month from date_1)=extract(month from now()::date) 
													and extract(day from date_1)=extract(day from now()::date)");
$resultat3=pg_query($connexion, "SELECT sum(montant) as montant 
													from depences 
													where extract(year from date_dep)=f_annee()  
													and extract(month from date_dep)=extract(month from now()::date)
													and extract(day from date_dep)=extract(day from now()::date)");

$rr=pg_fetch_assoc($resultat1);
$som_a=$rr['somme'];
$som_v=$rr['payee'];
$som_d=$rr['reste'];

$rr2=pg_fetch_assoc($resultat2);
$som_a2=$rr2['somme'];
$som_v2=$rr2['payee'];
$som_d2=$rr2['reste'];

$rr3=pg_fetch_assoc($resultat3);
$som_d3=$rr3['montant'];*/



echo '<table cellpadding="8" cellspacing="0" border="1" align="center" class="jquery.ui-widget ui-widget-content bw" style="width:95%;" rules="groups">';

echo '<form action="journer2.php" method="post">';
	echo '<tr class="header2 bw"><th class="header3 ldroite">RECHERCHE</th><td colspan="6"><input type="text" name="dater" size="80" class="text header1 ui-corner-all" /></td>';
	echo  '</tr>';
	echo '<tr>
	<td>
	
	<input type="submit" name="valider" value="Valider" id="myb"  class="ui-state-active ui-corner-all boutons" /></td>
	
	</form>
	<td>
	<a href="journe.php"><button id="myb"  class="ui-state-active ui-corner-all boutons">Annuller</button></a>	
	</td>
	</tr>';



echo '</table>';
/*
echo '<br>';
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">ETAT GENERAL</h5></th></tr>';

echo '<tr class="header2 lgauche bw"><th>N°</th>
		<th  class="lgauche">CLIENTS</th>
		<th colspan="2" class="lcentre">PRODUITS</th>';
		
echo	'<th class="ldroite">QUANTITE</th>';
		
echo	'<th class="ldroite">PRIX-VENTE</th>';
		
echo	'<th class="ldroite">MONTANT</th>';
				
echo	'</tr>';

$lsclient=pg_query($connexion, "select distinct id_cl,nom_cl, prenom_cl 
                                    from facture join clients using(id_cl)  
                                    where extract(day from date_fac)=extract(day from now()::date) 
                                    and extract(month from date_fac)=extract(month from now()::date) 
                                    and extract(year from date_fac)=f_annee() order by nom_cl, prenom_cl");


$i=1;
$k=1;
while ($ligne=pg_fetch_assoc($lsclient))
 {
 	 $coleur=ligneColor(); 
 	$id_cl=$ligne['id_cl'];
 $lscountcl=pg_query($connexion, "select id_cl,count(*) as nb from (select id_cl  
                              from facture_con join  facture using(id_fac)  
                              where extract(day from date_fac)=extract(day from now()::date) 
                              and extract(month from date_fac)=extract(month from now()::date) 
                              and extract(year from date_fac)=f_annee() group by id_ar,id_cl order by id_cl) as tt 
                              where id_cl=$id_cl group by id_cl ");

	$lsachat=pg_query($connexion, "select id_cl,lib_ar, type_ar, qte_ar,facture_con.prix_vente,(qte_ar*facture_con.prix_vente) as montant 
	                           from facture_con join  facture using(id_fac) join articles using(id_ar)  
	                           where extract(day from date_fac)=extract(day from now()::date) 
                              and extract(month from date_fac)=extract(month from now()::date) 
                              and extract(year from date_fac)=f_annee() and id_cl=$id_cl 
	                           group by  lib_ar,type_ar,qte_ar,facture_con.prix_vente,id_cl order by lib_ar,type_ar");
                        
	                           
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
 	
 	}
 	$k++;
 
	}
		*/  

echo '</table>';

?>
<!-- <a href="benefice.php"><input type="button" name="retour" value="BILLAN PERIODIQUE" /></a> -->
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
