<?php 
include_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'cart_function.php';
require_once 'head.php';
require_once 'api/send_notification.php';


if($_GET['i']){
    $oid = $defender->encrypt('decrypt',$_GET['i']);
}
$_GET['r'] = $defender->encrypt('encrypt', $order['region']);

$order = sql_read('select * from orders where id=? limit 1', 's', $oid);
$branch = sql_read("select * from branch where id=? limit 1", 'i', array($order['branch']));
$region = sql_read("select * from region where id=? limit 1", 'i', array($order['region']));
$zone = sql_read("select * from zone where id=? limit 1", 'i', array($order['zone']));


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




    <h3>Assign Order</h3>
    <div class="text-muted"><?php echo $region['region']?> driver(s) online within 3 hours. </div>

    <?php 
    $drivers = sql_read('select id, name, mobile_number, location, location_time from driver where region=? and status=? and location_time>?', 'iii', array($order['region'], 1, time()-(60*60*2)));//2hrs ago


    foreach($drivers as $driver){?>
        <div class="card" >
            <div>
                <img src="../images/car-20.png" style="width:18px; padding-right:4px; top: -3px; position:relative;"> 
                <?php echo $driver['name'];?>
            </div>
            <div>
                <img src="../images/phone-20.png" style="width:18px; padding-right:4px; top:-3px; position:relative;">
                <?php 
                $phone = $driver['mobile_number'];
                if (substr($phone, 0,1) != 6) {
                    $phone = '6'.$phone;
                }
                ?>
                <a class="btn btn-white p-0 pl-1 pr-1" href="https://api.whatsapp.com/send/?phone=<?php echo $phone;?>&text=Sorry to cancel your order <?php echo $mo = sprintf("%08d", $order['id']); ?>.&app_absent=0" style="color:#2cb742" target="_blank">
                    <?php echo $phone;?>
                    <img src="<?php echo ROOT?>images/whatsapp-16.png" style="position:relative; top:-1px;">
                </a>
            </div>
            <div>
                <img src="../images/distance-20.png" style="width:18px; padding-right:4px; top:-3px; position:relative;">
                <?php
                    $driver_lat = get_coor($driver['location'], '"latitude":', ',"speed":');
                    $driver_lng = get_coor($driver['location'], '"longitude":', ',"accuracy":');

                    $order_coor = explode(',',$order['origin_coordinate']);
                    $order_lat = $order_coor[0];
                    $order_lng = $order_coor[1];
                    $degree_diff = abs($order_lat - $driver_lat) + abs($order_lng - $driver_lng);
                    $est_distance = round($degree_diff * 111);//1 degree about 111km                    
                    echo $est_distance.'km ';
                    echo getTimePass($driver['location_time']);


   

                ?>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="driver" value="<?php echo $driver['id']?>">
                <?php if($order['assign'] == $driver['id']){?>
                    <input value="Assigned" class="btn fwhite float-right">
                <?php }else{ ?>
                    <input name="assign" type="submit" value="Assign" class="btn btn-default float-right">
                <?php }?>
            </form>

        </div>
    <?php
    }
    ?>







    <div class="pt-3 mt-5"></div>
    <h3>Recent Online Driver(s)</h3>
    <div class="text-muted">Driver(s) online within 30 minutes.</div>

    <?php if(count($drivers)>0){?>

        <div id="map"></div>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgCnKKXcbfDHhiyfjum75uIuRE0ZtvvOo&callback=initMap&callback=initMap&libraries=places&v=weekly"
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
