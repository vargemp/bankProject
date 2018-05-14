<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'bank';

$conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);


return $conn;


?>