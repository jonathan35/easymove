<?php 
require_once 'config/ini.php';
require_once 'config/security.php';

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

$earlier = time()-(60*30);//30 minutes early than now
$region_id = $defender->encrypt('decrypt', $_GET['r']);

$region = sql_read('select latitude, longitude from region where id=? limit 1', 'i', array($region_id));
$ds = sql_read('select name, merit, location from driver where region=? and status = ? and location_time > ?', 'iii', array($region_id, 1, $earlier));
$drivers = array();


foreach((array)$ds as $d){
    
    $latitude = get_string_between($d['location'], '"latitude":', ',"speed":');
    $longitude = get_string_between($d['location'], '"longitude":', ',"accuracy":');

    $drivers[] = array(
        array(
            'lat' => (float)$latitude,
            'lng' => (float)$longitude,
        ),
        $d['name'],
        $d['merit']
    );

}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Drivers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      #map {
        height: 100%;
      }
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

    
    <script>
    // The following example creates five accessible and
    // focusable markers.
    function initMap() {
        
        
        var region_lat = <?php echo $region['latitude']?>;
        var region_log = <?php echo $region['longitude']?>;


        if(region_lat == '' || region_lat == ''){
            var center = {lat: 1.4870324, lng: 110.3394176};
            //alert(region_lat+'vs'+region_lat);
        }else{
            var center = {lat: region_lat, lng: region_log};
            //alert(21);
        }
        

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 11,
            center: center,
        });
        // Set LatLng and title text for the markers. The first marker (Boynton Pass)
        // receives the initial focus when tab is pressed. Use arrow keys to
        // move between markers; press tab again to cycle through the map controls.

        
        var drivers = <?php echo json_encode($drivers); ?>;

        /*
        const drivers = [
            [{ lat: 1.5920324, lng: 110.3222276 }, "Boynton Pass"],
            [{ lat: 1.4221324, lng: 110.1594176 }, "Airport Mesa"],
            [{ lat: 1.4330324, lng: 110.2234176 }, "Chapel of the Holy Cross"],
            [{ lat: 1.4440314, lng: 110.2994476 }, "Red Rock Crossing"],
            [{ lat: 1.4550324, lng: 110.3292276 }, "Bell Rock"],
        ];*/
        // Create an info window to share between markers.
        const infoWindow = new google.maps.InfoWindow();
        // Create the markers.
        drivers.forEach(([position, title, merit], i) => {
            const marker = new google.maps.Marker({
            position,
            map,
            title: `${i + 1}. ${title} (${merit}p)`,
            label: `${title}`,
            optimized: false,
            });
            // Add a click listener for each marker, and set up the info window.
            marker.addListener("click", () => {
            infoWindow.close();
            infoWindow.setContent(marker.getTitle());
            infoWindow.open(marker.getMap(), marker);
            });
        });
    }


        
    </script>
</head>
<body>
    <?php if(count($drivers)>0){?>

        <div id="map"></div>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5uh3mV2UVFhyB_BpPFBvD-HdEY0LLEdc&callback=initMap&callback=initMap&libraries=places&v=weekly"
        async
        ></script>

    <?php }else{?>

        
        <div style="color:gray; padding-top:20px;">
            NO ONLINE DRIVER FOUND
            <span style="color:white"><?php echo time()?></span>
            <span style="color:white">--<?php echo time()-(60*30);?></span>
            

    <?php }?>
</body>
</html>
