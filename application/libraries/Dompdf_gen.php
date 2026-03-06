<?php
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_gen extends Dompdf {

    public function __construct() {
        $options = new Options();

        // 🔥 MUST-HAVE options
        $options->set('isRemoteEnabled', true);        // load images via URL
        $options->set('isHtml5ParserEnabled', true);  // modern HTML support
        $options->set('isPhpEnabled', true);          // allow PHP in views
        $options->set('defaultFont', 'DejaVu Sans');  // Unicode safe font

        // Optional performance tweaks
        $options->set('isFontSubsettingEnabled', true);
        $options->set('debugCss', false);
        $options->set('debugLayout', false);

        parent::__construct($options);
    }
}
