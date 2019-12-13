<?php

  header("Content-Type: text/html; charset=utf-8");
  require('config.php');
  session_start();
  if(isset($_SESSION['login_user'])){
    header("location:home.php");
  }

?>
<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="author" content="armag">
    <link rel="icon" href="assets/icon/favicon.ico">
    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/home.css" rel="stylesheet">

  </head>

  <body >
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
          <li><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>
        </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
       <h2 style="color:#ffab40;">Welcome to <b>Implicit Authentication using Autobiographical Memory Recall</b></h2>
      <br>
       <h4 > <a href="signup.php"><span style="color:#ff9100;"><i>New user? Click here to Sign Up.</i></span></a></h4>
      <h4 > <a href="login.php"><span style="color:#ff9100;"><i>Existing user? Click here to Login.</i></span></a></h4>
    
        <div class="row">
          <div class="col-sm-8">
              <p class="text-wrap" style="color:#ffd180; padding: 3em; padding-left: 0px; font-family: Tahoma; font-size:1.3em;">
                  <span style="font-size:2em;">A</span>uthentication is the first line of defense against compromising confidentiality and integrity. Though traditional login/password based schemes are easy to implement, they have been subjected to several attacks. As an alternative, token and biometric based authentication systems were introduced. However, they have not improved substantially to justify the investment. Thus, a variation to the login/password scheme, viz. graphical scheme was introduced. But it also suffered due to shoulder-surfing and screen dump attacks. In this paper, we introduce a framework of our proposed implicit password authentication system, which is immune to the common attacks suffered by other authentication schemes.
              </p>

          </div>
          <div class="col-sm-4">
            <img src="assets/img/ipas.gif" height="200px" width="400px">
          </div>
        </div>
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
     

    </div><!--/.container-->
 
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/index.js"></script>
  </body>
</html>


<?

  $db->close();

?>