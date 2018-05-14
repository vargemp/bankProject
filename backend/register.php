<?php 
$conn = include 'databaseConn.php';

$login = $_REQUEST['login'];
$pwd = $_REQUEST['pwd'];
$shaPwd = sha1($pwd);
//$sql = "INSERT INTO users (name, pwd) values ('".$login"','".$pwd."');";

$insert = $conn -> prepare("INSERT INTO users (name, pwd) VALUES (:login, :pwd);");

$insert -> bindParam(':login', $login);
$insert -> bindParam(':pwd', $shaPwd);

$insert -> execute();

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Utworzono użytkownika!')
    window.location.href='../loginPage.php';
    </SCRIPT>");




?>

