<?php 
session_start();

include 'funkcje.php';
$conn = include 'databaseConn.php';

$login = $_REQUEST['login'];
$pwd = $_REQUEST['pwd'];
$shaPwd = sha1($pwd);
$dbPwd = getUserPwd($login, $conn);

$sqlLoginQuery = "SELECT * FROM users WHERE name='".$login."';";
$sqlPwdQuery = "SELECT * FROM users WHERE name='".$login."' AND pwd='".$shaPwd."';";

$result = $conn -> query($sqlLoginQuery);

if(($rekord = $result -> fetch()) == null){
	$userFound = false; //nie znajduje uzytkownika
}

else{
	$userFound = true;
}

if ($userFound && $shaPwd == $dbPwd) {
	$loginSuccess = true;
	$_SESSION['login'] = $login;
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?login=$login';
    </SCRIPT>");
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
     window.alert('Zle dane')
     window.location.href='../loginPage.php';
     </SCRIPT>");
}

?>