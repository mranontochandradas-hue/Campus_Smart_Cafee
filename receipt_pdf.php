<?php
session_start();

if (!isset($_SESSION['receipt'])) {
    header("Location: dashboard.php");
    exit;
}

require_once __DIR__ . '/tcpdf/tcpdf.php';

$r = $_SESSION['receipt'];

$pdf = new TCPDF();
$pdf->SetCreator('Campus_Smart_Cafee');
$pdf->SetAuthor('Campus_Smart_Cafee');
$pdf->SetTitle('Payment Receipt');
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Campus Smart Cafee', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(0, 8, 'Payment Receipt', 0, 1, 'C');
$pdf->Ln(3);

// DATE ONLY (no time)
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 6, 'Receipt Date: ' . $r['date'], 0, 1);
$pdf->Ln(2);

$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 7, 'Customer Info', 0, 1);

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 6, 'Name: ' . $r['name'], 0, 1);
$pdf->Cell(0, 6, 'Address: ' . $r['address'], 0, 1);
$pdf->Cell(0, 6, 'Mobile: ' . $r['mobile'], 0, 1);
$pdf->Cell(0, 6, 'Email: ' . $r['email'], 0, 1);

$pdf->Ln(4);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 7, 'Payment Info', 0, 1);

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 6, 'Method: ' . $r['method'], 0, 1);
$pdf->Cell(0, 6, 'Total Amount: ' . $r['total'] . ' Taka', 0, 1);
$pdf->Cell(0, 6, 'Paid Amount: ' . $r['paid'] . ' Taka', 0, 1);
$pdf->Cell(0, 6, 'Change: ' . $r['change'] . ' Taka', 0, 1);

$pdf->Ln(6);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 6, 'Thank you for your purchase!', 0, 1, 'C');

$filename = 'receipt_' . $r['userid'] . '_' . time() . '.pdf';
$pdf->Output($filename, 'D');
exit;
?>
