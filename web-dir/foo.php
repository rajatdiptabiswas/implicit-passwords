<?php
    $map_html = ' <div id="map"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>//jquery
    <script src="js/mrkrs.js"></script>

    <script>
      var prayag = {lat: 25.4358, lng: 81.8463};
      //var latLng = {lat: 0, lng: 0};
      var map;
      
      //loading the map and placing initial marker
      function initMap() {
        map = new google.maps.Map(document.getElementById(\'map\'), {
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
        google.maps.event.addListener(marker,\'dragend\', function(e) {placeMarkerAndPanTo(e.latLng, map, marker);});

      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgQznsqzYk32C5TaMCPXvNjMeEUgJsSHY&callback=initMap"
    async defer>
    </script>';


    


?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/map.css">

    </head>
    <body>  
      <?php
        echo $map_html;

      ?>
    </body>
    </html>