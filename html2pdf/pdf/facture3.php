<?php
    ob_start();
    include(dirname(__FILE__).'/modele/facture3.php');
    $content = ob_get_clean();
	$id_fac=$_GET['id_fac'];
    // convert in PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A5', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('facture_'.$id_fac.'_'.$nom_cl.'_'.$prenom_cl.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>