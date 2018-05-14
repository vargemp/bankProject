<?php 

$conn = include 'databaseConn.php';
include 'funkcje.php';
include 'fpdf.php';
$currentDate = date("Y-m-d");
$currentHour = date('H:i');

if (isset($_POST['filename'])) {
	$fileName = $_POST['filename'];
	
	addPdfToHistory($currentDate, $currentHour, $fileName, $conn);

	$pdf = new FPDF();

	printPDF2($pdf, $fileName, $conn);
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Nie podales nazwy pliku!')
    window.location.href='../drukuj.php';
    </SCRIPT>");
}



 ?>