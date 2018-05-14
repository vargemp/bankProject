<?php 
	include("header.php");
	include '/backend/funkcje.php';
	$conn = include '/backend/databaseConn.php';
	
   	if(!isset($_SESSION['login'])){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.location.href='loginPage.php';
         </SCRIPT>");
    }
    else{
        $login = $_SESSION['login'];
    }

	// if(isset($_GET['login'])){
	// 	$login = $_GET['login'];
	// 	$_SESSION['login'] = $login;

	// }
	// else{
	// 	$login = "brak usera";
	// 	$_SESSION['login'] = $login;
	// }

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
				  <li class="active"><a href="#">Stan konta</a></li>
				  <li><a href='wplac.php'>Wplac</a></li>
				  <li><a href='<?php echo "wyplac.php?login=$login" ?>' >Wyplac</a></li>
				  <li><a href='<?php echo "transfer.php?login=$login" ?>' >Transfer</a></li>
				  <li><a href='<?php echo "drukuj.php" ?>' >Drukuj</a></li>
				  <li><a href='<?php echo "ustawAdmina.php" ?>' >Zmien uprawnienia</a></li>
				  <li><a href='backend/logout.php'><kbd>Wyloguj</kbd></a></li>
				</ul>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?php 
					$suma = include '/backend/sumy.php';
					echo "<p class='h2 text-primary'>Witaj ".$login.", twój obecny stan rachunku: " . $suma."</p>";


					
				?>
				<!-- <a href="backend/test.php">Click</a> -->


			</div>
		</div>


		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?php 
					
					

					
					showAccount($login, $conn);
					
				?>

			</div>
		</div>

		


	</div>


<?php include("footer.php");?>

</body>
</html>

