<?php 
	include("header.php");
	include "backend/funkcje.php";
	
	$conn = include '/backend/databaseConn.php';
	

	if(!isset($_SESSION['login'])){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
     window.location.href='loginPage.php';
     </SCRIPT>");
    }
    else{
        $login = $_SESSION['login'];
    }


?>
<body>

	<div class="container">
		<div class="row">
			<div class="container">
			  <div class="jumbotron">
			    <h1>Bank</h1> 
			    <p>Ta strona umożliwi Ci sprawdzenie swojego konta bankowego, wpłacenie oraz wypłacenie z niego pieniędzy.</p> 
			  </div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ul class="nav nav-tabs">
				  <li><a href='<?php echo "index.php?login=$login" ?>' >Stan konta</a></li>
				  <li><a href='<?php echo "wplac.php?login=$login" ?>' >Wplac</a></li>
				  <li><a href="wyplac.php">Wyplac</a></li>
				  <li><a href='<?php echo "transfer.php?login=$login" ?>' >Transfer</a></li>
				  <li class="active"><a href='<?php echo "drukuj.php" ?>' >Drukuj</a></li>
				  <li><a href='<?php echo "ustawAdmina.php" ?>' >Zmien uprawnienia</a></li>
				  <li><a href='<?php echo "loginPage.php" ?>' ><kbd>Wyloguj</kbd></a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p class='h2 text-primary'>Tutaj możesz wydrukować historię wszystkich transakcji.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<form action="backend/drukujPdf.php" method="post">
				  <div class="form-group">
				    <label for="nazwa">Podaj nazwę pliku:</label>
				    <input type="text" class="form-control" name="filename" id="filename"/>
				  </div>
				  
				  <?php 
				  	if (isAdmin($login, $conn)) {
				  		echo '<button type="submit" class="btn btn-default" >Drukuj</button>';
				  	}
				  	else{
				  		echo "<kbd>Nie masz uprawnien do drukowania</kbd>";
				  	}


				   ?>
				</form>				

			</div>
		</div>

	




<?php include("footer.php");?>

</body>
</html>
