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


?>
<body>

	<div class="container">
		<div class="row">
			<div class="container">
			  <div class="jumbotron">
			    <h1>Bank</h1> 
			    <p>Ta strona umożliwi Ci sprawdzenie swojego konta bankowego, wpłacenie oraz wypłacenie z niego pieniędzy.</p> 

			    <?= "Login globalny: ".$login ?>
			  </div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ul class="nav nav-tabs">
				  <li><a href='<?php echo "index.php?login=$login" ?>' >Stan konta</a></li>
				  <li><a href="wplac.php">Wplac</a></li>
				  <li><a href='<?php echo "wyplac.php?login=$login" ?>' >Wyplac</a></li>
				  <li><a href='<?php echo "transfer.php?login=$login" ?>' >Transfer</a></li>
				  <li><a href='<?php echo "drukuj.php" ?>' >Drukuj</a></li>
				  <li class="active"><a href='<?php echo "ustawAdmina.php" ?>' >Zmien uprawnienia</a></li>
				  <li><a href='<?php echo "loginPage.php" ?>' ><kbd>Wyloguj</kbd></a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p class='h2 text-primary'>Komu chcesz przyznać uprawnienia administratora?</p>
				<p class='h5 text-primary'>Administrator może drukować historie wszystkich transakcji oraz nadawać innym uprawnienia administratora.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				
				 <form action='backend/setAdmin.php' method="post">
				    <div class="form-group">
				      <label for="sel1">Wybierz użytkownika:</label>
				      <select class="form-control" id="sel1" name="users">
				        <?php 

						$uzytkownicy = findUsers($conn);
				    	foreach($uzytkownicy as $value) {

			    		echo '<option value='.$value.'>'.$value.'</option>';
			    		}	

						?>
				      </select>
				      <br>
				   	</div>
				   	<?php 

				   	if (isAdmin($login, $conn)) {
				  		echo '<button type="submit" class="btn btn-default">Nadaj uprawnienia administratora</button>';
				  	}
				  	else{
				  		echo "<kbd>Nie masz uprawnien do zmiany uprawnień</kbd>";
				  	}


				   	 ?>

				   	
				</form>
			</div>
		</div>







	</div>


<?php include("footer.php");

?>

</body>
</html>
