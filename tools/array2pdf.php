<?php
require_once "tools/domPDF/dompdf_config.inc.php";


class Array2PDF {
  function createPDF($comprobante) {
    $gui = file_get_contents("static/comprobante.html");
    $gui = str_replace('{comprobante}', $comprobante, $gui);
    $dompdf = new DOMPDF();
    $dompdf->load_html($gui);
    $dompdf->render();
    $dompdf->stream("comprobante.pdf");
    //return $dompdf->output();
    exit;
	}
}

function Array2PDF() {return new Array2PDF();} 
?>