<?php

//require'connect.php';
//$DB = new DB(); 

//echo getPeriodes(4);
function getPeriodes($p){
  switch($p){
    case 1:   $r='Janvier'; break;
    case 2:   $r='Février'; break;
    case 3:   $r='Mars'; break;
    case 4:   $r='Avril'; break;
    case 5:   $r='Mai'; break;
    case 6:   $r='Juin'; break;
    case 7:   $r='Juillet'; break;
    case 8:   $r='Août'; break;
    case 9:   $r='Septembre'; break;
    case 10:  $r='Octobre'; break;
    case 11:  $r='Novembre'; break;
    default:  $r='Decembre';
    }
    return $r;
  }



 function fmois_fac($annee) 
     {

	 
	$r = ''; 
   $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .='<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">VENTES '.$annee.' </h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="vente_fac_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

	return $r;
    }


    function fmois_tr($annee) 
     {

  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
     $r .='<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">TRANSFERTS '.$annee.' </h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="vente_tr_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fmois_ac($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .='<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">ENTREES '.$annee.' </h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="achat2.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }

    function fmois_dep($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .='<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">DEPENCES '.$annee.' </h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="depence.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fmois_banc($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">VERSEMENT/RETRAIT EFFECTUEE '.$annee.'</h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="verait_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fmois_ag($id_bo,$annee) 
     {
      //require'connect.php';
       $DB = new DB();
      $lignes=$DB->pg_query("select sum (reste) as reste from transferts  where id_bo=$id_bo");
       foreach($lignes as $ligne);
       $lignes1=$DB->pg_query("SELECT * from boutiques where id_bo=$id_bo");
       foreach($lignes1 as $ligne1);
       $lignes2=$DB->pg_query("SELECT sum(montant) as payee FROM trpaiement where id_bo=$id_bo and annee=$annee ");
       foreach($lignes2 as $ligne2);
       $lignes3=$DB->pg_query("select sum (somme) as somme from transferts  where id_bo=$id_bo and extract(year from date_tr)=$annee");
       foreach($lignes3 as $ligne3);
   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">'.$annee.'</h5></th></tr>';
    $r .= '<tr >';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">AGENCE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['nom_bo'].'</td>'; 
          $r .= '<th colspan="2" class="header3 ldroite cbleu">CONTACTS</th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['tel_bo'].'  </td>';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">ADDRESSE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['adr_bo'].'  </td>';
   $r .= '</tr>';
   $r .= '<tr >';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">TOTAL </th>';
          $r .=  '<td colspan="2" class="lcentre cnoire">'.number_format($ligne3['somme'],0,' ',' ').'<sup>F</sup></td>'; 
          $r .= '<th colspan="2" class="header3 ldroite cbleu">ACCOMPTE</th>';
          $r .=  '<td colspan="2" class="lcentre cbleu">'.number_format($ligne2['payee'],0,' ',' ').'<sup>F</sup>  </td>';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">RESTE A PAYEE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.number_format($ligne['reste'],0,' ',' ').' <sup>F</sup></td>';
   $r .= '</tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Janvier</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Fevrier</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Mars</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Avril</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Mai</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Juin</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Juillet</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Août</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Septembre</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Octobre</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Novembre</a></td>';
        $r .= '<td><a href="trace_ag_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fpaie_ag($id_bo,$annee) 
     {
      //require'connect.php';
       $DB = new DB();

       $lignes=$DB->pg_query("select sum (reste) as reste from transferts  where id_bo=$id_bo");
       foreach($lignes as $ligne);
       $lignes1=$DB->pg_query("SELECT * from boutiques where id_bo=$id_bo");
       foreach($lignes1 as $ligne1);
       $lignes2=$DB->pg_query("SELECT sum(montant) as payee FROM trpaiement where id_bo=$id_bo and annee=$annee ");
       foreach($lignes2 as $ligne2);
       $lignes3=$DB->pg_query("select sum (somme) as somme from transferts  where id_bo=$id_bo and extract(year from date_tr)=$annee");
       foreach($lignes3 as $ligne3);

       
   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">'.$annee.'</h5></th></tr>';
    $r .= '<tr >';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">AGENCE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['nom_bo'].'</td>'; 
          $r .= '<th colspan="2" class="header3 ldroite cbleu">CONTACTS</th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['tel_bo'].'  </td>';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">ADDRESSE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['adr_bo'].'  </td>';
   $r .= '</tr>';
   $r .= '<tr >';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">TOTAL </th>';
          $r .=  '<td colspan="2" class="lcentre cnoire">'.number_format($ligne3['somme'],0,' ',' ').'<sup>F</sup></td>'; 
          $r .= '<th colspan="2" class="header3 ldroite cbleu">ACCOMPTE</th>';
          $r .=  '<td colspan="2" class="lcentre cbleu">'.number_format($ligne2['payee'],0,' ',' ').'<sup>F</sup>  </td>';
          $r .= '<th colspan="2" class="header3 ldroite cbleu">RESTE A PAYEE </th>';
          $r .=  '<td colspan="2" class="lcentre crouge">'.number_format($ligne['reste'],0,' ',' ').' <sup>F</sup></td>';
   $r .= '</tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Janvier</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Fevrier</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Mars</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Avril</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Mai</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Juin</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Juillet</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Août</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Septembre</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Octobre</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Novembre</a></td>';
        $r .= '<td><a href="paie_ag_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'&id_bo='.$id_bo.'&nom_bo='.$ligne['nom_bo'].'&tel_bo='.$ligne['tel_bo'].'&adr_bo='.$ligne['adr_bo'].'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }

    function fmois_cl($id_cl,$annee) 
     {
       $DB = new DB();
       $lignes=$DB->pg_query("select sum (reste) as reste from facture  where id_cl=$id_cl");
       foreach($lignes as $ligne);
       $lignes1=$DB->pg_query("SELECT nom_cl,prenom_cl,tel1_cl,add_cl from clients where id_cl=$id_cl");
       foreach($lignes1 as $ligne1);
       $lignes2=$DB->pg_query("SELECT sum(montant) as payee FROM facpaiement where id_cl=$id_cl and annee=$annee ");
       foreach($lignes2 as $ligne2);
       $lignes3=$DB->pg_query("select sum (somme) as somme from facture  where id_cl=$id_cl and extract(year from date_fac)=$annee");
       foreach($lignes3 as $ligne3);
       
   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">'.$annee.'</h5></th></tr>';
    $r .= '<tr >';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">CLIENTS </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['nom_cl'].' '.$ligne1['prenom_cl'].'</td>'; 
         $r .= '<th colspan="2" class="header3 ldroite cbleu">CONTACTS</th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['tel1_cl'].'</td>';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">ADDRESSE </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['add_cl'].'</td>';
  $r .= '</tr>';
  $r .= '<tr >';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">TOTAL </th>';
         $r .=  '<td colspan="2" class="lcentre cnoire">'.number_format($ligne3['somme'],0,' ',' ').'<sup>F</sup></td>'; 
         $r .= '<th colspan="2" class="header3 ldroite cbleu">ACCOMPTE</th>';
         $r .=  '<td colspan="2" class="lcentre cbleu">'.number_format($ligne2['payee'],0,' ',' ').'<sup>F</sup>  </td>';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">RESTE A PAYEE </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.number_format($ligne['reste'],0,' ',' ').' <sup>F</sup></td>';
  $r .= '</tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Janvier</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Fevrier</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Mars</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Avril</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Mai</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Juin</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Juillet</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Août</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Septembre</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Octobre</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Novembre</a></td>';
        $r .= '<td><a href="trace_client_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fpaie_cl($id_cl,$annee) 
     {
       $DB = new DB();
       
       $lignes=$DB->pg_query("select sum (reste) as reste from facture  where id_cl=$id_cl");
       foreach($lignes as $ligne);
       $lignes1=$DB->pg_query("SELECT nom_cl,prenom_cl,tel1_cl,add_cl from clients where id_cl=$id_cl");
       foreach($lignes1 as $ligne1);
       $lignes2=$DB->pg_query("SELECT sum(montant) as payee FROM facpaiement where id_cl=$id_cl and annee=$annee ");
       foreach($lignes2 as $ligne2);
       $lignes3=$DB->pg_query("select sum (somme) as somme from facture  where id_cl=$id_cl and extract(year from date_fac)=$annee");
       foreach($lignes3 as $ligne3);
   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">'.$annee.'</h5></th></tr>';
    $r .= '<tr >';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">CLIENTS </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['nom_cl'].' '.$ligne1['prenom_cl'].'</td>'; 
         $r .= '<th colspan="2" class="header3 ldroite cbleu">CONTACTS</th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['tel1_cl'].'</td>';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">ADDRESSE </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.$ligne1['add_cl'].'</td>';
  $r .= '</tr>';
  $r .= '<tr >';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">TOTAL </th>';
         $r .=  '<td colspan="2" class="lcentre cnoire">'.number_format($ligne3['somme'],0,' ',' ').'<sup>F</sup></td>'; 
         $r .= '<th colspan="2" class="header3 ldroite cbleu">ACCOMPTE</th>';
         $r .=  '<td colspan="2" class="lcentre cbleu">'.number_format($ligne2['payee'],0,' ',' ').'<sup>F</sup>  </td>';
         $r .= '<th colspan="2" class="header3 ldroite cbleu">RESTE A PAYEE </th>';
         $r .=  '<td colspan="2" class="lcentre crouge">'.number_format($ligne['reste'],0,' ',' ').' <sup>F</sup></td>';
  $r .= '</tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Janvier</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Fevrier</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Mars</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Avril</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Mai</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Juin</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Juillet</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Août</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Septembre</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Octobre</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Novembre</a></td>';
        $r .= '<td><a href="paie_cl_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'&id_cl='.$id_cl.'&nom_cl='.$ligne['nom_cl'].'&prenom_cl='.$ligne['prenom_cl'].'&tel1_cl='.$ligne['tel1_cl'].'&add_cl='.$ligne['add_cl'].'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


    function fmois_balance($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">BALANCE '.$annee.'</h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="benefice_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';
        $r .='<td><a href="benefice_total.php?&bar='.$_GET['bar'].'&annee='.$annee.'">Annuaire</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }


function fmois_vcb_font($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">VCB/FONT EFFECTUEE '.$annee.'</h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="vcb_font.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }



    function fmois_emp($annee) 
     {

   
  $r = ''; 
  $r .= '<table align="center" style="width:80%;" class="jquery.ui-widget ui-widget-content myborder" cellpadding="8" cellspacing="0" rules="rows">';
    $r .= '<tr class="header3 bw"><th colspan="13"><h5 align="center" class="titre1">PAIEMENT DES EMPLOYES '.$annee.'</h5></th></tr>';
    $r .='<tr class="header3 bw">';

        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=1&annee='.$annee.'">Janvier</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=2&annee='.$annee.'">Fevrier</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=3&annee='.$annee.'">Mars</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=4&annee='.$annee.'">Avril</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=5&annee='.$annee.'">Mai</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=6&annee='.$annee.'">Juin</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=7&annee='.$annee.'">Juillet</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=8&annee='.$annee.'">Août</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=9&annee='.$annee.'">Septembre</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=10&annee='.$annee.'">Octobre</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=11&annee='.$annee.'">Novembre</a></td>';
        $r .= '<td><a href="epaiement_moi.php?&bar='.$_GET['bar'].'&mois=12&annee='.$annee.'">Decembre</a></td>';
        $r .= '<td><a href="epaiement_total.php?&bar='.$_GET['bar'].'&annee='.$annee.'">Annuaire</a></td>';

    $r .= '</tr>';
$r .= '</table>';
    

  return $r;
    }



