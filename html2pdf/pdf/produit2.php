<?php
    ob_start();
    include(dirname(__FILE__).'/modele/produit2.php');
    $content = ob_get_clean();
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Inventaire_'.(date('d-m-Y')).'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
