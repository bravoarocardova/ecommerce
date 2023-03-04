<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator
{
  public function generate($html,  $filename = '', $paper = '', $orientation = '', $stream = true)
  {
    $options = new Options();
    // $options->set('isHtml5ParserEnabled', true);
    // $options->set('isRemoteEnabled', true);
    // $options->set('chroot', '/');
    // $options->setIsHtml5ParserEnabled(true);
    // $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
      $dompdf->stream($filename . ".pdf", ["Attachment" => 0]);
    } else {
      return $dompdf->output();
    }
  }
}
