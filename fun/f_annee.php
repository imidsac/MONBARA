<?php

//require'connect.php'; 
//echo fan();

//
function fan()
{


    $DB = new DB();
    $lignes = $DB->pg_query("select f_annee() as an,f_annee()-1 as pan");
    foreach ($lignes as $ligne) ;


    $r = '';
    $r .= ' <div id="ian">';
    //$r .= '<table>';
    if ($_GET['bar'] == 'FAC') {
        $r .= '<a href="sortie.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="sortie.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
	      <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
		  <strong>' . $ligne['pan'] . '</strong>
	      </button></a>';
    } elseif ($_GET['bar'] == 'TR') {
        $r .= '<a href="sortie_t.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="sortie_t.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'EN') {
        $r .= '<a href="entre.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="entre.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'DEP') {
        $r .= '<a href="depence_moi.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="depence_moi.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'AG') {
        $r .= '<a href="trace_ag.php?&id_bo=' . $_GET['id_bo'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="trace_ag.php?&id_bo=' . $_GET['id_bo'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'CL') {
        $r .= '<a href="trace_client.php?&id_cl=' . $_GET['id_cl'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="trace_client.php?&id_cl=' . $_GET['id_cl'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'BE') {
        $r .= '<a href="benefice.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="benefice.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'EMP') {
        $r .= '<a href="epaiement.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="epaiement.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'PAI') {
        if ($_GET['id_cl'] == null) {
            $r .= '<a href="paie_ag.php?&id_bo=' . $_GET['id_bo'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
            $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
            $r .= '<strong>' . $ligne['an'] . '</strong>';
            $r .= '</button></a>';

            $r .= '<a href="paie_ag.php?&id_bo=' . $_GET['id_bo'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
        } else {
            $r .= '<a href="paie_cl.php?&id_cl=' . $_GET['id_cl'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
            $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
            $r .= '<strong>' . $ligne['an'] . '</strong>';
            $r .= '</button></a>';

            $r .= '<a href="paie_cl.php?&id_cl=' . $_GET['id_cl'] . '&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
        }
    }

    $r .= '</div>';


    $r .= ' <div id="ian_b">';
    if ($_GET['bar'] == 'BAN') {
        $r .= '<a href="banc.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="banc.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    } elseif ($_GET['bar'] == 'CAI') {
        $r .= '<a href="caisse.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['an'] . ' ">';
        $r .= '<button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">';
        $r .= '<strong>' . $ligne['an'] . '</strong>';
        $r .= '</button></a>';

        $r .= '<a href="caisse.php?&bar=' . $_GET['bar'] . '&annee=' . $ligne['pan'] . '">
          <button id="myb"  class="ui-state-active ui-corner-all boutons" onclick="this.style.display =\'none\';">
          <strong>' . $ligne['pan'] . '</strong>
          </button></a>';
    }

    $r .= '</div>';

    return $r;
}


function ligneColor()
{
    global $col;
    if ($col == 'header0') $col = "header1";
    else        $col = "header0";
    return $col;
}

?>
