<?php 
//include '../wplac.php';
//session_start();
include 'funkcje.php';
$conn = include 'databaseConn.php';
$currentDate = date("Y-m-d");
$login = $_SESSION['login'];
$kwota = $_REQUEST['kwota'];
$idBankomatu = array_search($_REQUEST['bankomat'], findAtms($conn));

wplacPieniadze($kwota, $currentDate, $idBankomatu, $login, $conn);



echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Wplacono!')
window.location.href='../index.php?login=$login';
</SCRIPT>");

 ?>