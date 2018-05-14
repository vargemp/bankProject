<?php 
error_reporting(E_ERROR);

$conn = include 'databaseConn.php';
include 'funkcje.php';
include 'fpdf.php';

$pdf = new FPDF();





printPDF2($pdf, $conn);
 ?>