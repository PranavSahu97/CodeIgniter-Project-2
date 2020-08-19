<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Airports</title>
    <link rel = "stylesheet" href = "https://bootswatch.com/4/flatly/bootstrap.min.css">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      body {
        margin: 0;
        padding: 0;
      }

      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }

      .marker {
        /*background-image: url('mapbox-icon.png');*/
        background-image: url('https://i2.wp.com/files.123freevectors.com/wp-content/uploads/new/123fv-images/1291-location-pin-clipart.jpg?w=800&q=95');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
      }

      .mapboxgl-popup {
        max-width: 400px;
       font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
      }

      .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    </style>
    <style>
      .center {
        text-align: center;
        border: 3px solid green;
      }

      .panel {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
    }

      .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;} 
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
    }
    </style>
</head>
<body>

  <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Airports</a>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
          </ul>
        </div>
      </div>
  </nav>


  <div id='map'></div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoicHJhbmF2c2FodTk3IiwiYSI6ImNrY3BjZDNlMjBhdmEzM29jOXd4ampyY3AifQ.WrJtcYhFi91QLRvMZVJXcQ';
          var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/light-v10',
          center: [-96, 37.8],
          zoom: 3
          });

        var geojson = <?php echo $geoJson; ?>

          geojson.features.forEach(function(marker) {
          // create a HTML element for each feature
          var el = document.createElement('div');
          el.className = 'marker';
          el.addEventListener("click", function(){ myFunction(marker);  });
          //e1.data-toggle="popover";
          new mapboxgl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
         // .setHTML('<h3>' + marker.properties.title + '</h3>'))
        .setHTML(
`<div style="display: flex; flex-direction: column;">
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">GLOBAL_ID:</div>
        <div>`+marker.properties.description[0]+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">NAME:</div>
        <div>`+marker.properties.title+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">COUNTRY:</div>
        <div>`+marker.properties.description[1]+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">MIL_CODE:</div>
        <div>`+marker.properties.description[3]+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">LENGTH:</div>
        <div>`+marker.properties.description[4]+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">WIDTH:</div>
        <div>`+marker.properties.description[5]+`</div>
    </div>
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
        <div style="font-weight:bold;">COMP_CODE:</div>
        <div>`+marker.properties.description[6]+`</div>
    </div>
</div>`))
          .addTo(map);
        });
        

          function myFunction(marker) {
            var popup = document.getElementById("myPopup");
            // popup.classList.toggle("show");



            //alert(marker.properties.title);
          }
      </script>

    </body>
</html>