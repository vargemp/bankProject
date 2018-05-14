<?php 
$conn = include 'databaseConn.php';

//SELECT SUM(kwota) FROM transakcje JOIN users ON transakcje.id_usera=users.id_usera WHERE typ='in' AND name='bartosz'

$sumInSql = "SELECT SUM(kwota) FROM transakcje JOIN users
			ON transakcje.id_usera=users.id_usera WHERE typ='in' AND name='".$login."';";
$sumujIn = $conn -> query($sumInSql);
$sumOfIn = "";

while(($rekord = $sumujIn ->fetch()) != null){
	$sumOfIn = $rekord['SUM(kwota)'];
}




$sumOutSql = "SELECT SUM(kwota) FROM transakcje JOIN users
			ON transakcje.id_usera=users.id_usera WHERE typ='out' AND name='".$login."';";
$sumujOut = $conn -> query($sumOutSql);

$sumOfOut = "";

while(($rekord = $sumujOut ->fetch()) != null){
	$sumOfOut = $rekord['SUM(kwota)'];
}


$sumOfAll = $sumOfIn - $sumOfOut;
return $sumOfAll;

 ?>