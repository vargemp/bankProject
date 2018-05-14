<?php 

function getUserId($login, $conn){
	//select id_usera from users where name='bartosz'
	$getIdSql = "SELECT id_usera FROM users WHERE name='".$login."';";
	$getId = $conn -> query($getIdSql);

	$userId = "";

	while(($rekord = $getId ->fetch()) != null){
		$userId = $rekord['id_usera'];
	}

	return $userId;
}

function getUserPwd($login, $conn){
	$ask = "SELECT pwd FROM users WHERE name = '".$login."';";
	$result = $conn -> query($ask);

	while(($rekord = $result ->fetch()) != null){
		$pwd = $rekord['pwd'];
	}

	return $pwd;
}

function isAdmin($login, $conn){
	$ask = "SELECT isAdmin FROM users WHERE name = '".$login."';";
	$result = $conn -> query($ask);

	while(($rekord = $result ->fetch()) != null){
		$isAdmin = $rekord['isAdmin'];
	}

	if ($isAdmin > 0) {
		return true;
	}
	else{
		return false;
	}
}

function wyplacPieniadze($kwota, $data, $bankomat, $login, $conn){
	$userId = getUserId($login, $conn);

	if (enoughMoney($kwota, $login)) {
		$wyplacPieniadze = $conn -> prepare("INSERT INTO transakcje (kwota, data, typ, id_bankomatu, id_usera) VALUES (:kwota, :data, 'out', :bankomat, :id);");

		$wyplacPieniadze -> bindParam(':kwota', $kwota);
		$wyplacPieniadze -> bindParam(':data', $data);
		$wyplacPieniadze -> bindParam(':bankomat', $bankomat);
		$wyplacPieniadze -> bindParam(':id', $userId);

		$wyplacPieniadze -> execute();
	}
	else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('Masz za mało środków na koncie!')
	    window.location.href='../wyplac.php?login=$login';
	    </SCRIPT>");
	}	
}

function wplacPieniadze($kwota, $data, $bankomat, $login, $conn){
	$userId = getUserId($login, $conn);

	$wplacPieniadze = $conn -> prepare("insert into transakcje (kwota, data, typ, id_bankomatu, id_usera) values (:kwota, :data, 'in', :bankomat, :id);");

	$wplacPieniadze -> bindParam(':kwota', $kwota);
	$wplacPieniadze -> bindParam(':data', $data);
	$wplacPieniadze -> bindParam(':bankomat', $bankomat);
	$wplacPieniadze -> bindParam(':id', $userId);

	$wplacPieniadze -> execute();
}

function userExist($userName, $conn){
	$ask = "SELECT 1 FROM users WHERE name = '".$userName."';";
	$result = $conn -> query($ask);

	if(($rekord = $result -> fetch()) == null){
		
		return false; //nie znajduje uzytkownika

	}

	else{
		return true; //znajduje uzytkownika
	}
}

function enoughMoney($amount, $login){
	$suma = include 'sumy.php';

	if ($amount > $suma) {
		return false;
	}
	else{
		return true;
	}
}

function showAccount($login, $conn){


	$sqlSelect = "SELECT kwota, data, id_bankomatu, typ FROM transakcje 
				JOIN users ON transakcje.id_usera = users.id_usera 
				WHERE name = '".$login."';";


	$sqlSelect2 = "SELECT kwota, data, bankomaty.miasto, typ FROM transakcje 
				JOIN users ON transakcje.id_usera = users.id_usera JOIN bankomaty on transakcje.id_bankomatu = bankomaty.id_bankomatu
				WHERE name = '".$login."';";
	$result = $conn -> query($sqlSelect2);

	echo "<p class='h2'>Historia transakcji:</p>";
	echo "<table class='table table-striped'>";
	echo '<th>kwota<th>data<th>Bankomat<th>typ';

	while(($rekord = $result -> fetch()) != null){
		


		if ($rekord['typ'] == 'out') {
			echo '<tr><td class="text-danger">'.$rekord['kwota'];
			echo '<td class="text-danger">'.$rekord['data'];
			echo '<td class="text-danger">'.$rekord['miasto'];
			echo '<td class="text-danger">'.$rekord['typ'];
		}
		else{
			echo '<tr><td class="text-success">'.$rekord['kwota'];
			echo '<td class="text-success">'.$rekord['data'];
			echo '<td class="text-success">'.$rekord['miasto'];
			echo '<td class="text-success">'.$rekord['typ'];

			}
	}

	echo "</table>";
}

function findUsers($conn){
	$sql = "SELECT name, isAdmin FROM users WHERE isAdmin = 0";
	$findUsers = $conn -> query($sql);
	$users = array();

	//dodanie wszystkich userow z tabeli do tablicy
	$counter = 1;
	while(($rekord = $findUsers->fetch()) != null){
		$users[$counter] = $rekord['name']." ".$rekord['isAdmin'];
		$counter++;
	}

	return $users;
}

function findAtms($conn){

	$sql = "SELECT * FROM bankomaty WHERE id_bankomatu=1 OR id_bankomatu=2";
	$findAtms = $conn -> query($sql);
	$atms = array();

	//dodanie wszystkich bankomatow z tabeli do tablicy
	$counter = 1;
	while(($rekord = $findAtms->fetch()) != null){
		$atms[$counter] = $rekord['miasto']." ".$rekord['ulica'];
		$counter++;
	}

	return $atms;
}

function printPDF($conn){
	//SELECT id_transakcji, kwota, data, typ, name, miasto, ulica FROM transakcje JOIN users ON transakcje.id_usera=users.id_usera JOIN bankomaty ON transakcje.id_bankomatu=bankomaty.id_bankomatu

	$sql = "SELECT id_transakcji, kwota, data, name, miasto, ulica, typ FROM transakcje JOIN users ON transakcje.id_usera=users.id_usera JOIN bankomaty ON transakcje.id_bankomatu=bankomaty.id_bankomatu;";
	$result = $conn -> query($sql);

	echo "<p class='h2'>Historia wszystkich transakcji:</p>";
	echo "<table class='table table-striped'>";
	echo '<th>Id transakcji<th>Kwota<th>Data<th>Imie<th>Bankomat<th>Typ';

	while(($rekord = $result -> fetch()) != null){
		
		$bankomat = $rekord['miasto']." ".$rekord['ulica'];


		if ($rekord['typ'] == 'out') {
			echo '<tr><td class="text-danger">'.$rekord['id_transakcji'];
			echo '<td class="text-danger">'.$rekord['kwota'];
			echo '<td class="text-danger">'.$rekord['data'];
			echo '<td class="text-danger">'.$rekord['name'];
			echo '<td class="text-danger">'.$bankomat;
			echo '<td class="text-danger">'.$rekord['typ'];
		}
		else{
			echo '<tr><td class="text-success">'.$rekord['id_transakcji'];
			echo '<td class="text-success">'.$rekord['kwota'];
			echo '<td class="text-success">'.$rekord['data'];
			echo '<td class="text-success">'.$rekord['name'];
			echo '<td class="text-success">'.$bankomat;
			echo '<td class="text-success">'.$rekord['typ'];

			}
	}

	echo "</table>";
}

function printPdf2($pdf, $nazwa, $conn){
	$sql = "SELECT id_transakcji, kwota, data, name, miasto, ulica, typ FROM transakcje JOIN users ON transakcje.id_usera=users.id_usera JOIN bankomaty ON transakcje.id_bankomatu=bankomaty.id_bankomatu;";
	$result = $conn -> query($sql);

	$pdf -> AddPage();
	$pdf -> SetFont('Arial');
	$pdf->Cell(30,5,'Id transakcji',1,0,'L',0);   // empty cell with left,top, and right borders
	$pdf->Cell(30,5,'Kwota',1,0,'L',0);
	$pdf->Cell(30,5,'Data',1,0,'L',0);
	$pdf->Cell(30,5,'Imie',1,0,'L',0);
	$pdf->Cell(30,5,'Bankomat',1,0,'L',0);
	$pdf->Cell(30,5,'Typ',1,0,'L',0);
	$pdf -> Ln();

	while(($rekord = $result -> fetch()) != null){
		
		$bankomat = $rekord['miasto']." ".$rekord['ulica'];


		if ($rekord['typ'] == 'out') {
			$pdf -> Cell(30,10,$rekord['id_transakcji'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['kwota'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['data'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['name'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['typ'], 1,0,'L',0);
			$pdf -> MultiCell(30,5,$bankomat, '1','L',false);
			
			$pdf -> Ln();
		}
		else{
			$pdf -> Cell(30,10,$rekord['id_transakcji'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['kwota'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['data'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['name'], 1,0,'L',0);
			$pdf -> Cell(30,10,$rekord['typ'], 1,0,'L',0);
			$pdf -> MultiCell(30,5,$bankomat, '1','L',false);
			
			$pdf -> Ln();
			}
	}

	$pdf -> Output($nazwa, 'D');
}

function addPdfToHistory($date, $hour, $filename, $conn){

	$insert = $conn->prepare("INSERT INTO historia_wydrukow (data, godzina, nazwa_pliku) VALUES (:data, :godzina, :nazwa_pliku);");

	$insert -> bindParam(':data', $date);
	$insert -> bindParam(':godzina', $hour);
	$insert -> bindParam(':nazwa_pliku', $filename);

	$insert -> execute();
	
}

function setAdmin($name, $conn){
	//UPDATE `users` SET `isAdmin` = '1' WHERE `users`.`id_usera` = 9

	$sql = $conn -> //prepare("insert into transakcje (kwota, data, typ, id_bankomatu, id_usera) values (:kwota, :data, 'in', :bankomat, :id);");
	prepare("UPDATE users SET isAdmin = '1' WHERE name = :name;");


	$sql -> bindParam(':name', $name);
	

	$sql -> execute();



}







 ?>
