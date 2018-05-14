<?php 
//session_start();
include 'funkcje.php';
$conn = include 'databaseConn.php';

$login = $_SESSION['login'];
$userName = $_REQUEST['imie'];
$amount = $_REQUEST['kwota'];
$currentDate = date("Y-m-d");
$idBankomatu = '3';

if (userExist($userName, $conn) && enoughMoney($amount, $login)) {
	wyplacPieniadze($amount, $currentDate, $idBankomatu, $login, $conn);
	wplacPieniadze($amount, $currentDate, $idBankomatu,$userName, $conn);
	
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Przelew zostanie zrealizowany w najbliższym dniu roboczym.')
    window.location.href='../index.php?login=$login';
    </SCRIPT>");

}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Masz za mało środków na koncie lub nie istnieje taki użytkownik!')
    window.location.href='../transfer.php?login=$login';
    </SCRIPT>");
}




 ?>