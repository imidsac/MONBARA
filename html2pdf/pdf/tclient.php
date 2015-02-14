<?php
include('../../fun/f_mois.php');
$annee = $_GET['annee'];
$mois = $_GET['mois'];
    ob_start();
    include(dirname(__FILE__).'/modele/tclient.php');
    $content = ob_get_clean();
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('trace_clients_'.getPeriodes($mois).'_'.$annee.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
