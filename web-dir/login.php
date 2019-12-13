<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="author" content="armag">
    <meta name="google-signin-client_id" content="1089456065411-d9cg2b0lrsrkt5g0n1miehdfuf1t90a1.apps.googleusercontent.com">
    <link rel="icon" href="assets/icon/favicon.ico">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <link href="css/home.css" rel="stylesheet">
    <!-- <link href="css/signin.css" rel="stylesheet"> -->

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
          <li><a href="signup.php"><span class="fa fa-user-plus"></span> Sign Up</a></li>
          <li class="active"><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>
        </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

<?php
  header("Content-Type: text/html; charset=utf-8");
  require('config.php');
  session_start(); // Starting Session
  $error=''; // Variable To Store Error Message
  if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
      $error = "Username is invalid";
    }
    else
    {
      // Define $username and $password
      // echo '<scriptt> alert("hey") </script>';
      $username=$_POST['username'];
      $username = stripslashes($username);
      $username = mysqli_real_escape_string($db,$username);
      // SQL query to fetch information of registerd users and finds user match.
      $query = mysqli_query($db,"select * from Users where BINARY UserName = BINARY '$username'");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $result5 = mysqli_fetch_array($query);
				$uid=$result5['UserID'];
        $_SESSION['login_user']=$username; // Initializing Session
        $_SESSION['uid']=$uid; // Initializing Session
        header("location: authorise.php"); // Redirecting To Other Page
      } else {
        $error = "Username does not exit.";

      }
      mysqli_close($db); // Closing Connection
    }
  }

 if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == '1') {
    header("location: home.php");
  }
?>

      <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <div class="container">

      <form accept-charset="utf-8" class="form-signin" action="" method="post" name="login">
        <h2 class="form-signin-heading"> <span class="fa fa-user-circle-o"></span> Step 1 / 2</h2>
        <br>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputUsername"  name="username" class="form-control" placeholder="Username" required autofocus>
        <?php 
        if($error!='')
          echo '<span class=" form-control alert alert-info">'.$error.'</span>'; 

        ?>

        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Proceed to authentication</button>
          <br>
          <label>
						 <a href="signup.php"><u>Not a user? Sign up here.</u></a>
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


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
