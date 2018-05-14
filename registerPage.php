<?php include("header.php");?>
<body>

	<div class="container">
		<div class="row">
			<div class="container">
			  <div class="jumbotron">
			    <h1><a href="loginPage.php">Bank</a></h1> 
			    <p>Ta strona umożliwi Ci sprawdzenie swojego konta bankowego, wpłacenie oraz wypłacenie z niego pieniędzy.</p> 
			  </div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p class='h2 text-primary'>Stwórz użytkownika</p>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<form action="backend/register.php" method="post">
				  <div class="form-group">
				    <label for="name">Nazwa użytkownika:</label>
				    <br><em class="text-important">Nazwa użytkownika nie powinna zawierać spacji</em>
				    <input name="login" pattern="^[A-Za-z0-9_]{1,15}$" class="form-control" id="name" />
				  </div>

				  <div class="form-group">
				    <label for="pwd">Haslo:</label>
				    <br><em class="text-important">Hasło musi składać się z conajmniej 8 liter,  jednej cyfry, jednej wielkiej i jednej małej litery.</em>
				    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
				    name="pwd" class="form-control" id="pwd" />
				  </div>

				  <button type="submit" class="btn btn-default">Zarejestruj</button>
				</form>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p>Masz konto? <a href='loginPage.php'>Zaloguj się!</a></p>

			</div>
		</div>

	</div>


<?php include("footer.php");?>

</body>
</html>

