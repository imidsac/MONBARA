<?php
    ob_start();
    include(dirname(__FILE__).'/modele/pemployer.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('paiement_employer_'.getPeriodes($mois).'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
