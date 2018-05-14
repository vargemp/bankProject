<?php 
	include("header.php");
	

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
				  <li><a href='<?php echo "wyplac.php?login=$login" ?>' >Wyplac</a></li>
				  <li class="active"><a href='<?php echo "transfer.php?login=$login" ?>' >Transfer</a></li>
				  <li><a href='<?php echo "drukuj.php" ?>' >Drukuj</a></li>
				  <li><a href='<?php echo "ustawAdmina.php" ?>' >Zmien uprawnienia</a></li>
				  <li><a href='<?php echo "loginPage.php" ?>' ><kbd>Wyloguj</kbd></a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?php 

					$suma = include '/backend/sumy.php';
					echo "<p class='h2 text-primary'>Do kogo chesz wysłać pieniądze?<br>
						 Twój obecny stan rachunku: " . $suma."</p>";
					
				?>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">

				<form action="backend/transferMoney.php" method="post">
				  <div class="form-group">
				    <label for="name">Do:</label>
				    <input name="imie" class="form-control" id="imie" />
				  </div>

				  <div class="form-group">
				    <label for="pwd">Kwota:</label>
				    <input type="number" name="kwota" class="form-control" id="kwota" />
				  </div>

				  <button type="submit" class="btn btn-default">Zatwierdź</button>
				</form>

			</div>
		</div>

		


	</div>


<?php include("footer.php");?>

</body>
</html>

