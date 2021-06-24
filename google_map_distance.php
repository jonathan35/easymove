<?php define('ROOT', @str_repeat('../', count(explode("/", $_SERVER['REQUEST_URI'])) - 1));?>

<script src="<?php echo ROOT?>js/jquery.min.js"></script>
<script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style type="text/css">
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map, #map2 {
    height: calc(100% - 38px); 
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

    #map #infowindow-content, #map2 #infowindow-content {
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
    
    #pac-input, #pac-input2 {

    }

    #pac-input:focus, #pac-input2:focus {
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
    #sendfrom_coordinate, #sendto_coordinate {
    padding:0;
    font-size:8px;
    display:none;

    }
</style>
<script>


// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {

  var default_lat = 1.4870324;
  var default_lng = 110.3394176;
  var default_coor = '<?php echo $_SESSION['auth_user']['branch_location_coordinate']?>';
  var zoom = 13;

  if(default_coor != ''){
    var zoom = 16;
    var coor = default_coor.split(',');
    default_lat = parseFloat(coor[0]);
    default_lng = parseFloat(coor[1]);
  }
  
  const myLatLng = { lat: default_lat, lng: default_lng };
  const myLatLng2 = { lat: 1.5870324, lng: 110.4394176 };

  var mapOption = {
    center: myLatLng,
    zoom: zoom,
    mapTypeId: "roadmap",
    disableDefaultUI: true,
  }

  
  const map = new google.maps.Map(document.getElementById("map"), mapOption);
  const map2 = new google.maps.Map(document.getElementById("map2"), mapOption);

  new google.maps.Marker({
    position: myLatLng,
    map: map,
  });
  new google.maps.Marker({
    position: myLatLng,
    map: map2,
  });

 

  const input = document.getElementById("pac-input");
  const input2 = document.getElementById("pac-input2");
  /*
  const biasInputElement = document.getElementById("use-location-bias");
  const strictBoundsInputElement = document.getElementById("use-strict-bounds");*/
  const options = {
    componentRestrictions: { country: "my" },
    fields: ["formatted_address", "geometry", "name"],
    origin: map.getCenter(),
    strictBounds: false,
    types: ["establishment"],
  };
  const options2 = {
    componentRestrictions: { country: "my" },
    fields: ["formatted_address", "geometry", "name"],
    origin: map2.getCenter(),
    strictBounds: false,
    types: ["establishment"],
  };
  
  const autocomplete = new google.maps.places.Autocomplete(input, options);
  const autocomplete2 = new google.maps.places.Autocomplete(input2, options2);
  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);
  autocomplete2.bindTo("bounds", map2);
  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");
  infowindow.setContent(infowindowContent);
  const marker = new google.maps.Marker({
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });
  const marker2 = new google.maps.Marker({
    map2,
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

  autocomplete2.addListener("place_changed", () => {
    infowindow.close();
    marker2.setVisible(false);
    const place = autocomplete2.getPlace();

    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map2.
    if (place.geometry.viewport) {
      map2.fitBounds(place.geometry.viewport);
    } else {
      map2.setCenter(place.geometry.location);
      map2.setZoom(17);
    }
    
    get_coordinate2(map2.getCenter());


    /*-------------------Get Distance - Start -----------------------*/
    var service = new google.maps.DistanceMatrixService;
    
    var origin = map.getCenter();
    var destination = map2.getCenter();
   

    /*
    var origin = new google.maps.LatLng(map.getCenter());
    var destination = new google.maps.LatLng(map2.getCenter());

     alert(origin+'vvvvvv'+destination);
    $('#sendfrom_coordinate').val()
    $('#sendto_coordinate').val()

    
*/
    service.getDistanceMatrix({
      origins: [origin],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status !== google.maps.DistanceMatrixStatus.OK) {
        //alert('Error was: ' + status);
      } else {
        //alert(response.originAddresses[0] + ' --> ' + response.destinationAddresses[0] + ' ==> ' + response.rows[0].elements[0].distance.text);
        var dis = response.rows[0].elements[0].distance.text;
        dis2 = dis.replace(new RegExp(" km", "g"), '').replace(new RegExp(",", "g"), '');
        $('#distance').val(dis2);
      }
    });
    /*---------------------Get Distance - End ---------------------*/

    marker2.setPosition(place.geometry.location);
    marker2.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map2, marker2);
  });

  


  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    const radioButton = document.getElementById(id);
    radioButton.addEventListener("click", () => {
      autocomplete.setTypes(types);
      autocomplete2.setTypes(types);
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
      autocomplete2.bindTo("bounds", map2);
    } else {
      // User wants to turn off location bias, so three things need to happen:
      // 1. Unbind from map
      // 2. Reset the bounds to whole world
      // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
      autocomplete.unbind("bounds");
      autocomplete.setBounds({ east: 60, west: -50, north: 20, south: -20 });
      autocomplete2.unbind("bounds");
      autocomplete2.setBounds({ east: 60, west: -50, north: 20, south: -20 });
      strictBoundsInputElement.checked = biasInputElement.checked;
    }
    input.value = "";
    input2.value = "";
  });
  strictBoundsInputElement.addEventListener("change", () => {
    autocomplete.setOptions({
      strictBounds: strictBoundsInputElement.checked,
    });
    autocomplete2.setOptions({
      strictBounds: strictBoundsInputElement.checked,
    });

    if (strictBoundsInputElement.checked) {
      biasInputElement.checked = strictBoundsInputElement.checked;
      autocomplete.bindTo("bounds", map);
      autocomplete2.bindTo("bounds", map);
    }
    input.value = "";
    input2.value = "";
  });
}
</script>


<div class="row">
    <div class="col-12">
        Origin
        <div style="border:1px solid #CCC; height:250px;">
            <input
            id="pac-input" name="sendfrom" 
            value="<?php echo $_SESSION['auth_user']['branch_location']?>"            
            class="controls" type="text" required placeholder="Search Place"/>
            
            <input type="hidden" id="sendfrom_coordinate" name="sendfrom_coordinate" value="<?php echo $_SESSION['auth_user']['branch_location_coordinate']?>" type="text">
            
            <div id="map"></div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-12">
        Destination
        <div style="border:1px solid #CCC; height:250px;">
            <input id="pac-input2" name="sendto" 
            class="controls" type="text" required placeholder="Search Place" />
            
            <input type="hidden" id="sendto_coordinate" name="sendto_coordinate" value="" type="text">
            
            <div id="map2"></div>
        </div>
    </div>
</div>


<input type="hidden" id="distance" name="distance">

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgCnKKXcbfDHhiyfjum75uIuRE0ZtvvOo&callback=initMap&libraries=places&v=weekly"
    async
></script>
 

<script>
function get_coordinate(va) { 
  va = va.toString().replace('(', '').replace(')', '').replace(' ', '');
  $('#sendfrom_coordinate').val(va);
}
function get_coordinate2(va) {
  va = va.toString().replace('(', '').replace(')', '').replace(' ', '');
  $('#sendto_coordinate').val(va);
}
</script>


