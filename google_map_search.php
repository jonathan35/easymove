<?php 
if (!defined('ROOT')) {
	define('ROOT', @str_repeat('../', count(explode("/", $_SERVER['REQUEST_URI'])) - 1));
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Places Search Box</title>

    <script src="<?php echo ROOT?>js/jquery.min.js"></script>
    <script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%; 
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      <?php if(!empty($table)){?>
      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        
        font-weight: 300;
        margin-left: 12px;
        padding: 8px 11px 8px 13px;
        text-overflow: ellipsis;
        width: 400px;

        border: 1px solid #999;
        font-size: 18px;

      }
      <?php }?>

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }

      #target {
        width: 345px;
      }
    </style>
    <script>
/*



  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 1.4870324, lng: 110.3394176 },

*/

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initMap() {

  var default_lat = 1.4870324;
  var default_lng = 110.3394176;
  var default_coor = '<?php echo $value[$field.'_coordinate']?>';
  var zoom = 13;

  if(default_coor != ''){
    var zoom = 16;
    var coor = default_coor.split(',');
    default_lat = parseFloat(coor[0]);
    default_lng = parseFloat(coor[1]);

    /*alert(default_lat+'++'+default_lng);*/
  }
  
  const myLatLng = { lat: default_lat, lng: default_lng };


  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: default_lat, lng: default_lng  },
    zoom: zoom,
    mapTypeId: "roadmap",
    disableDefaultUI: true,

  });
  new google.maps.Marker({
    position: myLatLng,
    map,
  });

  /*
  google.maps.event.addListener(map, 'click', function (event) {
    new google.maps.Marker({
        position: event.latLng,
        map: map,
    });
  });*/
  //const card = document.getElementById("pac-card");
  const input = document.getElementById("pac-input");
  const biasInputElement = document.getElementById("use-location-bias");
  const strictBoundsInputElement = document.getElementById("use-strict-bounds");
  const options = {
    componentRestrictions: { country: "my" },
    fields: ["formatted_address", "geometry", "name"],
    origin: map.getCenter(),
    strictBounds: false,
    types: ["establishment"],
  };
  //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
  const autocomplete = new google.maps.places.Autocomplete(input, options);
  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);
  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");
  infowindow.setContent(infowindowContent);
  const marker = new google.maps.Marker({
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });
  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);
    const place = autocomplete.getPlace();

    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }
    
    get_coordinate(map.getCenter());

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);

    
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    const radioButton = document.getElementById(id);
    radioButton.addEventListener("click", () => {
      autocomplete.setTypes(types);
      input.value = "";
    });
  }
  setupClickListener("changetype-all", []);
  setupClickListener("changetype-address", ["address"]);
  setupClickListener("changetype-establishment", ["establishment"]);
  setupClickListener("changetype-geocode", ["geocode"]);
  biasInputElement.addEventListener("change", () => {
    if (biasInputElement.checked) {
      autocomplete.bindTo("bounds", map);
    } else {
      // User wants to turn off location bias, so three things need to happen:
      // 1. Unbind from map
      // 2. Reset the bounds to whole world
      // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
      autocomplete.unbind("bounds");
      autocomplete.setBounds({ east: 60, west: -50, north: 20, south: -20 });
      strictBoundsInputElement.checked = biasInputElement.checked;
    }
    input.value = "";
  });
  strictBoundsInputElement.addEventListener("change", () => {
    autocomplete.setOptions({
      strictBounds: strictBoundsInputElement.checked,
    });

    if (strictBoundsInputElement.checked) {
      biasInputElement.checked = strictBoundsInputElement.checked;
      autocomplete.bindTo("bounds", map);
    }
    input.value = "";
  });
}


    </script>
  </head>
  <body>
    <input
      id="pac-input" 
      <?php if(!empty($table)){?>
      name="<?php echo $field?>" 
      value="<?php echo $value[$field]?>"
      <?php }?>
      class="controls"
      type="text"
      placeholder="Search Place"
    /><!--<input type="submit" value="CONFIRM" class="btn btn-confirm-location">-->


    <input type="hidden" id="<?php echo $field.'_coordinate'?>" name="<?php echo $field.'_coordinate'?>" value="<?php echo $value[$field.'_coordinate']?>" type="text">


    <div id="map"></div>
    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgCnKKXcbfDHhiyfjum75uIuRE0ZtvvOo&callback=initMap&libraries=places&v=weekly"
      async
    ></script>
  </body>
</html>

<script>
function get_coordinate(va) { 
  va = va.toString().replace('(', '').replace(')', '').replace(' ', '');
  $('#<?php echo $field?>_coordinate').val(va);
}
</script>


