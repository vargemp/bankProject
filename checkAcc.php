<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'bank';

$conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);


$sqlSelect = 'select * from transakcje';
$result = $conn -> query($sqlSelect);

echo "<table border>";
echo '<th>id<th>kwota<th>data<th>typ';

while(($rekord = $result -> fetch()) != null){
	echo '<tr><td>'.$rekord['id'];
	echo '<td>'.$rekord['kwota'];
	echo '<td>'.$rekord['data'];
	echo '<td>'.$rekord['typ'];
}

























?>