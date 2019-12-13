<?php

  header("Content-Type: text/html; charset=utf-8");
  require('config.php');
  session_start(); 
   if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != '1') {
  	header("location: login.php");
  }      
            
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/icon/favicon.ico">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="css/home.css" rel="stylesheet">

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
          <li><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
        </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      <?php
        echo '<h1 style="color: white;"> Hey '.$_SESSION['login_user'].'!<br>You have successfully signed in.</h1>';
      ?>
     <h4 style="color: #ffab40;">Implicit Authentication using Autobiographical Memory Recall</h4>
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
    <script src="js/home.js"></script>
    <script src="js/upvote.js"></script>
  </body>
</html>


<?php

  $db->close();

?>