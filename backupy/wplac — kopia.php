<?php 


	

	if(!isset($_SESSION['login'])){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
     window.location.href='loginPage.php';
     </SCRIPT>");
    }
    else{
        $login = $_SESSION['login'];

        include("header.php");
		include '/backend/funkcje.php';

		$conn = include '/backend/databaseConn.php';

		$bankomaty = findAtms($conn);

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
				  <li class="active"><a href="wplac.php">Wplac</a></li>
				  <li><a href='<?php echo "wyplac.php?login=$login" ?>' >Wyplac</a></li>
				  <li><a href='<?php echo "transfer.php?login=$login" ?>' >Transfer</a></li>
				  <li><a href='<?php echo "drukuj.php" ?>' >Drukuj</a></li>
				  <li><a href='<?php echo "ustawAdmina.php" ?>' >Zmien uprawnienia</a></li>
				  <li><a href='<?php echo "loginPage.php" ?>' ><kbd>Wyloguj</kbd></a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<p class='h2 text-primary'>Ile chcesz wpłacić pieniędzy?</p>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<form action='backend/wplata.php' method="post">
				  <div class="form-group">
				  	<input type='hidden' name='<?php echo "$login";?>' value='<?php echo "$login";?>'/> 
				    <label for="wplata">Wpłać (kwota):</label>
				    <input type="number" class="form-control" name="kwota" id="kwota" required />
				    <?php 
				  //   	include '/backend/funkcje.php';
						// $conn = include '/backend/databaseConn.php';

						// $bankomaty = findAtms($conn);
				  //   	foreach($bankomaty as $value) {
				  //   		echo '<label class="radio-inline"><input type="radio" name="bankomat" value="'.$value.'" required>
				  //   		'.$value.'</label>';
						// }
				     ?>

				     <?php foreach($bankomaty as $bankomat): ?>

                    
                    <label class="radio-inline"><input type="radio" name="bankomat" 
                        	value="<?= $bankomat ?>" required><?= $bankomat ?></label>

                    <?php endforeach; ?>
				  </div>

				  <button type="submit" class="btn btn-default">Wpłać pieniądze</button>
				</form>				

			</div>
		</div>
	</div>


<?php include("footer.php");

?>

</body>
</html>
