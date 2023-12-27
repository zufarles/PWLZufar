<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdf = new \Dompdf\Dompdf();

$pdf->loadHtml('<h1>Hello</h1>');
$pdf->setPaper('A4','Potrait');
$pdf->render();
$pdf->stream('coba.pdf');