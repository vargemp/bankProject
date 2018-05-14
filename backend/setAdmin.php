<?php 
include 'funkcje.php';
$conn = include 'databaseConn.php';


$name = $_POST['users'];


setAdmin($name, $conn);

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Nadano uprawnienia!')
    window.location.href='../ustawAdmina.php';
    </SCRIPT>");

 ?>