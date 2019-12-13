<?php


	header("Content-Type: text/html; charset=utf-8");
	require('config.php');
	session_start();
	 if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == '1') {
    	header("location: home.php");
  		}
	$error='';
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']))
			$error = "Fill all the fields.";
		else
		{
			$uname=$_POST['username'];
			$pword='1234';
			$pword=md5($pword);
			$email=$_POST['email'];
			$answer1 = $_POST['answer1'];
			$as1 = $_POST['as1'];
			$as2 = $_POST['as2'];
			$as3 = $_POST['as3'];
			$answer2 = $_POST['answer2'];
			$answer3 = $_POST['answer3'];
			$query1="INSERT INTO `Users` (`UserID`, `UserName`, `UserEmail`, `CreatedDate`, `Active`, `Password`) VALUES (NULL,'$uname','$email',CURRENT_TIMESTAMP,'1','$pword');";
			mysqli_query($db,$query1) or die("Couldn't store data in database.");
			$query2 = "SELECT * FROM `Users` where BINARY(`UserName`) = BINARY('$uname')";
			$res = mysqli_query($db,$query2) or die("Couldn't fetch data from database.");
			if(mysqli_num_rows($res)<1)
				$error="Oops...There was some error.".mysqli_error($db);
			else
			{
				$result5 = mysqli_fetch_array($res);
				$uid=$result5['UserID'];
				if(isset($_GET['remember']))
				{
					if($_GET['remember']== true)
					{
						$_SESSION['login_user'] = $uname; 
						$_SESSION['uid'] = $uid; 
						
					}
				}
				$query6="INSERT INTO `ImplicitPasswords` (`ImplicitPasswordsID`, `UserID`, `AuthSpaceID`, `Answer`) VALUES (NULL,'$uid','$as1','$answer1');";
				mysqli_query($db, $query6) or die("Couldn't store data in database.");
				$query6="INSERT INTO `ImplicitPasswords` (`ImplicitPasswordsID`, `UserID`, `AuthSpaceID`, `Answer`) VALUES (NULL,'$uid','$as2','$answer2');";
				mysqli_query($db, $query6) or die("Couldn't store data in database.");
				$query6="INSERT INTO `ImplicitPasswords` (`ImplicitPasswordsID`, `UserID`, `AuthSpaceID`, `Answer`) VALUES (NULL,'$uid','$as3','$answer3');";
				mysqli_query($db, $query6) or die("Couldn't store data in database.");
				header("location: home.php");
			}
			mysqli_close($db);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="assets/icon/favicon.ico">

	<title>
		Join Us!
	</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="css/home.css" rel="stylesheet">
	
    <link href="css/signup.css" rel="stylesheet">



</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand text-light" href="index.php">
            <span class="logo">
              <span class="fa fa-id-badge"></span> 
              <b>Implicit Authentication using Autobiographical Memory Recall
              </b>
            </span>
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="signup.php"><span class="fa fa-user-plus"></span> Sign Up</a></li>
          <li><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>
        </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
<br>
 <div class="container">

      <form accept-charset="utf-8" class="form-signup" action="" method="post" name="signup">
		<h2 class="form-signup-heading">&nbsp;<span class="fa fa-user-plus"></span> &nbsp;Sign Up</h2>
		<br>
		<label for="inputUsername" class="sr-only" >Username</label>
		<input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required><br>
		<div id="msg"></div>
		<label for="inputEmail" class="sr-only">e-mail:</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required><br>
		<br/>
		<!-- <label for="inputPassword" class="text-success text-uppercase"><span class="fa fa-key"></span> Fallback Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Choose Password" name="password" required=""><br>
		<input type="password" id="inputRepassword" class="form-control" placeholder="Retype Password" name="repassword" required=""><br>
		 --><div class="form-group">
			<label for="authSpace" class="text-success text-uppercase"> <span class="fa fa-question-circle"></span> Choose 3 different questions from the dropdowns:</label>
			<div class="text-info"> 
				Please ensure that your answers contains proper keywords which can be easily interpreted by a standard seach engine.
				Also ensure that your answer returns the proper set of images when queried over any search engine that you want to associate with.
			</div>
			<br>
			<select name="as1" class="form-control">
				<option value="1" selected>Who is your favourite celebrity / singer?</option>
				<option value="2">What is your favourite city to visit?</option>
				<option value="3">Favourite sports team</option>
				<option value="4">Favourite packed food item</option>
			</select>
			<input type="text" name="answer1" id="inputAnswer1" class="form-control" placeholder="Input answer or keywords" required><br>
			<br>
			<select name="as2" class="form-control">
				<option value="1">Who is your favourite celebrity / singer?</option>
				<option value="2" selected>What is your favourite city to visit?</option>
				<option value="3">Favourite sports team</option>
				<option value="4">Favourite packed food item</option>
			</select>
			<input type="text" name="answer2" id="inputAnswer2" class="form-control" placeholder="Input answer or keywords" required><br>
			<br>
			<select name="as3" class="form-control">
				<option value="1">Who is your favourite celebrity / singer?</option>
				<option value="2">What is your favourite city to visit?</option>
				<option value="3" selected>Favourite sports team</option>
				<option value="4">Favourite packed food item</option>
			</select>   
			<input type="text" name="answer3" id="inputAnswer3" class="form-control" placeholder="Input answer or keywords" required><br>
		</div>
<div class="notification"></div>

        <?php 
        if($error!='')
          echo '<span class=" form-control alert alert-info">'.$error.'</span>'; 

        ?>
		<br>
		<button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" id="submit-signup">Sign Up</button>
		<br>
		<label>
						 <a href="login.php"><u>If you are already registered click here to login.</u></a>.
          </label>
		</form>


		<div class="footer" style="background: rgba(0,0,0, 0.8); padding: 0px; position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          color: rgba(255,255,255,0.7);
          text-align: center;"> 
     <footer>
        <h5><b>&copy; 2019-20 | <span class="fa fa-graduation-cap"></span> Major Project, MNNIT CSE-20 | <span class="fa fa-users"></span> By <a href="https://github.com/armag-pro">@armag</a> and team</b></h5>
     </footer>
    </div>
	 </div> <!-- /container -->

<script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="js/signup.js"></script>

</body>
</html>
