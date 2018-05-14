<?php //session_start();

include("header.php");
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
				<?php 

					echo "<p class='h2 text-primary'>Zaloguj się</p>";
					
				?>

			</div>
		</div>


		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<form action="backend/login.php" method="post">
				  <div class="form-group">
				    <label for="name">Nazwa użytkownika:</label>
				    <input name="login" class="form-control" id="name" />
				  </div>

				  <div class="form-group">
				    <label for="pwd">Haslo:</label>
				    <input type="password" name="pwd" class="form-control" id="pwd" />
				  </div>

				  <div class="checkbox">
				    <label><input type="checkbox"> Remember me</label>
				  </div>
				  <button type="submit" class="btn btn-default">Zaloguj</button>
				</form>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p>Nie masz konta? <a href='registerPage.php'>Zarejestruj się!</a></p>

			</div>
		</div>

		


	</div>


<?php include("footer.php");?>

</body>
</html>

