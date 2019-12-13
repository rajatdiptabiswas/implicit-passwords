<?php


  header("Content-Type: text/html; charset=utf-8");
  require('config.php');
  session_start(); // Starting Session
  if(!isset($_SESSION['login_user'])) {
      header("location: login.php");
  }
  $username = $_SESSION['login_user'];
  $uid = $_SESSION['uid'];
  $error=''; // Variable To Store Error Message
  if (isset($_POST['submit'])) {
    if (!isset($_POST['form-rg-1']) && !isset($_POST['form-rg-2']) && !isset($_POST['form-rg-3']) &&
      !isset($_POST['form-rg-4'])) {
        $error = "Select your answer before submitting.";
    }
    else
    {
      // Define $username and $password
      $query = mysqli_query($db,"SELECT * FROM `AskedAuth` WHERE `UserID` = '$uid'");
      $saved = array();
      while($result8 = mysqli_fetch_array($query))
      {
        $as=$result8['AuthSpace'];
        $saved[$as] = $result8['Answer'];
      } 
      for($i = 1; $i <= 4; $i++) {
        if(isset($_POST['form-rg-'.$i]) && $_POST['form-rg-'.$i] != $saved[strval($i)]) {
          // die($_POST['form-rg-'.$i].' != '.$saved[strval($i)]);
          die('<script>window.location.replace("authorise.php?e=wrong");</script>');
          $_SESSION['logged_in'] = '0';
          header("location: authorise.php?e=wrong");
        } 
      }
      $_SESSION['logged_in']='1'; 
      header("location: home.php");
      mysqli_close($db); // Closing Connection
    }
  }

  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == '1') {
    header("location: home.php");
  } 
  $ch = curl_init();
  $api_url = "https://www.googleapis.com/customsearch/v1?";
  $data = [
    'q' => 'Einstein',
    'searchType' => 'image',
    'gl' => 'IN',
    'hl' => 'en',
    'num' => '4',
    'key' => 'AIzaSyAGUtw1zAmHZgkWe1t6N0wA3lAengwEirk',
    'cx' => '007209046880833147745:datbv1bddff',
    'imgSize' => 'medium',
  ];
  // given two search strings, it prints 1 image from first, 4 from second, shuffles and
  // returns the index of the first image amongst the shuffled images. Save $uid,$asarg,option.
  function print_search_images($str1, $str2, $asarg) {
    global $db;
    global $ch;
    global $api_url;
    global $data;
    global $uid;
    $data['q'] = $str1;
    curl_setopt($ch, CURLOPT_URL, $api_url.http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $response = curl_exec($ch);
    $err = 0;
    $json = json_decode($response);
    if(isset($json->items)) {
      $pics = $json->items;
      $img_urls = array();
      array_push($img_urls, $pics[0]->image->thumbnailLink);
      
      $data['q'] = $str2;
      curl_setopt($ch, CURLOPT_URL, $api_url.http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
      $response = curl_exec($ch);
      
      $json = json_decode($response);
      // var_dump($json);
      if(isset($json->items)) {
        $pics = $json->items;
        foreach($pics as $pic) {
          array_push($img_urls, $pic->image->thumbnailLink);
        }
        $cnt = count($img_urls);
        $ret = rand(2, $cnt);
        $tmp = $img_urls[0];
        $img_urls[0] = $img_urls[$ret-1];
        $img_urls[$ret-1] = $tmp;
    
        echo '<fieldset class="form-group">
        <div class="row">
          <div class="col-sm-10">';
            for($i = 0; $i < $cnt; $i++) {
                // echo '<option value="'.($i+1).'"><img src="'.$img_urls[$i].'"></option>';
                echo '<div class="form-check">
                    <input class="form-check-input" type="radio" name="form-rg-'.$asarg.'" value="'.($i+1).'">
                    <label class="form-check-label" for="gridRadios2">
                      <img src="'.$img_urls[$i].'">
                    </label>
                  </div>';
            } 
          echo '</div>
          </div>
          </fieldset>';                  
        $query = mysqli_query($db, "SELECT * FROM `AskedAuth` WHERE `UserID`= '$uid' AND `AuthSpace`='$asarg'");
        $rets = strval($ret);
        if(mysqli_num_rows($query) == 1) {
          // update
          $query = mysqli_query($db, "UPDATE `AskedAuth` SET `Answer`= '$rets' WHERE `UserID`='$uid' AND `AuthSpace`='$asarg'");
        } else {
          // insert
          $query = mysqli_query($db, "INSERT INTO `AskedAuth`(`UserID`, `AuthSpace`, `Answer`) VALUES ('$uid', '$asarg', '$rets')");
        } 
      } else {
        $err = 1;
      }
    } else $err = 1; 
    if($err == 1) {
      echo '<h2>The image API didn\'t respond. Ensure you are connected to the internet and try after some time.</h2>';
    }
  }

$map_html = '<fieldset>
              <div style="height:400px;" class="row">
                <div id="map"></div>
              </div>
            </fieldset><br>';

?>
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

  </head>

  <body>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <!-- <script src="js/jquery.min.js"></script> -->
    <!-- <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script> -->
    <script src="js/bootstrap.min.js"></script>
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
    <div class="container">
      

      <form accept-charset="utf-8" class="form-signin" action="" method="post" name="login2">
        <h2 class="form-signin-heading">&nbsp;<span class="fa fa-file-image-o"></span> &nbsp;Step 2 / 2</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <?php 
          
          if(isset($_GET['e']) && $_GET['e'] == 'wrong') {
            echo '<span class=" form-control alert alert-danger">Access Denied. Atleast one of the answers
            differ from the expected. Please try again. </span>'; 
          }
        echo '<h2 class="text-primary">Hey '.$_SESSION['login_user'].'!</h2><br>';
        $uid = $_SESSION['uid'];
        $query = mysqli_query($db,"SELECT * FROM `ImplicitPasswords` WHERE `UserID`= '$uid'");

        // take any 2 authspaces and present to user
          $arr = array();
          while($result8 = mysqli_fetch_array($query))
          {
            $as=$result8['AuthSpaceID'];
            $arr[] = array("as" => $as, "answer" => $result8['Answer']);
          }
          shuffle($arr);
          for($i = 0; $i < 2; $i += 1) {
              echo '<p><b> Pick your answer for question #'.($i+1).': </b></p>';
              $as = $arr[$i]['as'];
              // if($as == '2') $as='1' ;
              if($as == '4') $as='3' ;
              $ans = $arr[$i]['answer'];
              if($as == '1') {
                // as1: Who is your favourite celebrity / singer?
                $r = rand(1, 2);
                if($r == 1) {
                  // 1) Actor's face 
                  print_search_images($ans, 'actor -"'.$ans.'"', '1');
                } else if($r == 2) {
                  // 2) Movie
                    print_search_images($ans.' movie poster', 'movie poster -"'.$ans.'"', '1');
                } else if($r == 3) {
                  // Todo 3) Song
                }
              } else if($as == '2') {
                // as2: What is your favourite city to visit?
                $r = rand(1, 2);
                if($r == 1) {
                  // Globe
                  echo $map_html;
                  echo '<input class="form-check-input" id="map-input" type="hidden" name="form-rg-'.$as.'" value="Prayagraj">';
                  $query = mysqli_query($db, "SELECT * FROM `AskedAuth` WHERE `UserID`= '$uid' AND `AuthSpace`='$as'");
                  if(mysqli_num_rows($query) == 1) {
                    $query = mysqli_query($db, "UPDATE `AskedAuth` SET `Answer`= '$ans' WHERE `UserID`='$uid' AND `AuthSpace`='$as'");
                  } else {
                    $query = mysqli_query($db, "INSERT INTO `AskedAuth`(`UserID`, `AuthSpace`, `Answer`) VALUES ('$uid', '$as', '$ans')");
                  } 
                } else if($r == 2) {
                  // Image (monuments)
                  print_search_images($ans.' monuments', 'famous monuments -"'.$ans.'"', '3');
                } 
              } else if($as == '3') {
                // as3: Favourite sports team?
                $r = rand(1, 2);
                if($r == 1) {
                  // logo
                  print_search_images($ans.' team logo', 'national sports team logo -"'.$ans.'"', '3');
                } else if($r == 2) {
                  // player
                  print_search_images($ans.' team current captain', 'national sports team captain -"'.$ans.'"', '3');
                } 
              } else if($as == 4) {
                // as4: Favourite packed food item
                // todo
              } else {
                echo 'Error: Unknown AuthSpace.';
              }
           }
        curl_close($ch);
        if($error!='')
          echo '<span class=" form-control alert alert-info">'.$error.'</span>'; 

        ?>
        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">&nbsp;<span class="fa fa-sign-in"></span> Authenticate and Login </button>
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

    <script src="js/mrkrs.js"></script>

    <script>
      var prayag = {lat: 25.4358, lng: 81.8463};
      //var latLng = {lat: 0, lng: 0};
      var map;
      
      //loading the map and placing initial marker
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: prayag,
          zoom: 3,
          //bounding map not to go over the edge of the world
          restriction: {
            latLngBounds: {north: 85, south: -85, west: -180, east: 180},
            strictBounds: true
          },
        });
        
        var marker = new google.maps.Marker({
          position: prayag, 
          map: map,
          draggable: true
        });

        //dragend event listner
        google.maps.event.addListener(marker,'dragend', function(e) {placeMarkerAndPanTo(e.latLng, map, marker);});

      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgQznsqzYk32C5TaMCPXvNjMeEUgJsSHY&callback=initMap"
    async defer>
    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
