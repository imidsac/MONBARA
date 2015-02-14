<?php
session_start(); 
if (session_is_registered("authentification")){ 
}
else {
header("Location:index.php?erreur=intru"); 
}
?>

<?php
include_once('connection.php');
include_once('header.php');
$EDATE=2012; 
?>
<div id="content">
<?php
include_once('sidebar.php');
$som_b=0;
$som_a=0;
$som_v=0;
$som_d=0;
$som_t=0;
$som_a0=0;
$som_v0=0;
$som_d0=0;
$Q=0;
$v=0;
$s=0;
?>
<div id="colTwo">
<a href="/html2pdf/pdf/journe_pdf.php" title="Les retours en format pdf">
<img src="images/pdf/pdf.png" width="6%" height="10%" alt="" align="right" border="0" />
</a>
<a href="journer.php">
				<button id="myb"  class="ui-state-active ui-corner-all boutons">Recherche</button></a> 
<h1 align="center"><i>ON EST LE <? echo date("d/m/Y");?></i></h1>
<h1 align="center"><strong>LES RETOURS D'AUJOURD'HUI</strong></h1>
	
<?php
$rproduit=pg_query($connexion, "select id_ar,lib_ar, type_ar,sum(qte_ar) as qte_ar 
                                         from facture_con join facture using(id_fac) join articles using(id_ar)  
                                         where id_bo=$uti 
                                         and  extract(day from date_fac)=23
                                         and extract(month from date_fac)=4
                                         and extract(year from date_fac)=f_annee() 
                                         group by  lib_ar,type_ar,id_ar order by lib_ar");	
   $rproduit2=pg_query($connexion, "select id_ar,lib_ar, type_ar,sum(qte_ar) as qte_ar 
                                         from transferts_con join transferts using(id_tr) join articles using(id_ar)  
                                         where extract(day from date_tr)=23 
                                         and extract(month from date_tr)=4
                                         and extract(year from date_tr)=f_annee() 
                                         group by  lib_ar,type_ar,id_ar order by lib_ar");	

echo '<br>';
echo '<table align="center" style="width:70%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
//========================================================SORTIE====================================

	
                                         	
			echo '<tr class="header3 bw"><th colspan="8"><h5 align="center" class="titre1">SORTIES</h5></th></tr>';
			echo '<tr class="header2 lgauche bw"><th>N°</th>
					<th colspan="4" class="lgauche">PRODUIT</th>';
			echo	'<th  colspan="3" class="ldroite">QUANTITE</th>';
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

echo '</table>';

?>
<!-- <a href="benefice.php"><input type="button" name="retour" value="BILLAN PERIODIQUE" /></a> -->
</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<?php
include_once('footer.php');
?>
