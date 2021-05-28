<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'api/send_notification.php';

if(empty($_SESSION['auth_user']['id'])){
    header("Location: please_login");
}

if($_POST){

    $msg = '';
    $error = 0;
    $data = array();
    //$data['session'] =                  session_id();
    $data['region'] =                   $_SESSION['auth_user']['region'];
    $data['zone'] =                     $_POST['zone'];
    $data['company'] =                  $_SESSION['auth_user']['company'];
    $data['branch'] =                   $_SESSION['auth_user']['branch'];
    $data['branch_name'] =              $_SESSION['auth_user']['branch_name'];    
    $data['merchant'] =                 $_SESSION['auth_user']['id'];
    $data['customer_name'] =            $_POST['customer_name'];
    $data['phone'] =                    $_POST['phone'];
    $data['origin'] =                   $_POST['sendfrom'];
    $data['destination'] =              $_POST['sendto'];
    $data['origin_coordinate'] =        $_POST['sendfrom_coordinate'];
    $data['destination_coordinate'] =   $_POST['sendto_coordinate'];
    $data['distance'] =                 $_POST['distance'];
    $data['address'] =                  $_POST['address'];
    $data['time'] =                     $_POST['time'];
    $data['zone'] =                     $_POST['zone'];
    $data['message'] =                  $_POST['message'];
    $data['requirement'] =              $_POST['requirement'];
    $data['status'] =                   'Ordered';//Accepted, Collected, Delivering, Delivered


    //if(empty($data['session'])){                $msg .= ' No session.'; $error++;}
    if(empty($data['region'])){                 $msg .= ' No region.'; $error++;}
    if(empty($data['zone'])){                   $msg .= ' No zone.'; $error++;}
    if(empty($data['branch'])){                 $msg .= ' No branch.'; $error++;}
    if(empty($data['merchant'])){               $msg .= ' No merchant.'; $error++;}    
    if(empty($data['customer_name'])){          $msg .= ' No customer name.'; $error++;}
    if(empty($data['phone'])){                  $msg .= ' No phone.'; $error++;}
    if(empty($data['origin'])){                 $msg .= ' No origin.'; $error++;}
    if(empty($data['destination'])){            $msg .= ' No destination.'; $error++;}
    if(empty($data['origin_coordinate'])){      $msg .= ' No origin coordinate.'; $error++;}
    if(empty($data['destination_coordinate'])){ $msg .= ' No destination coordinate.'; $error++;}
    if(empty($data['distance'])){               $msg .= ' No distance detected.'; $error++;}
    if(empty($data['address'])){                $msg .= ' No Property number (Lot/Sublot/Unit).'; $error++;}
    if(empty($data['time'])){                   $msg .= ' No time.'; $error++;}


    if($error>0){
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Failed to submit error. '.$msg.'</div>';
    }else{
        $trip = sql_read("select id, trip_balance from trip where trip_balance > ? and branch =? and trip_distance >= ? order by trip_distance asc limit 1", 'iis', array(0, $data['branch'], $data['distance'] ));

        if(empty($trip['id'])){
            $_SESSION['session_msg'] = '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
            style="position:relative; top:-2px;">×</a>
            Your trip credit is not enough, please contact administrator to top-up.</div>';
        }else{
            /*-------- Trip - Start --------- */
            $trip['id'];
            $trip['trip_balance'] = $trip['trip_balance'] - 1;
            sql_save('trip', $trip);
            /*-------- Trip - End --------- */

            $data['trip'] = $trip['id'];//trip source's id
            sql_save('orders', $data);
            $_SESSION['session_msg'] = '<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
            Order successfully.</div>';


            //-----Notify nearby (<=10km) drivers - Start -----------
            $earlier = time()-(60*30);//30 minutes early than now
            $region_id = $data['region'];
            $nearby_drivers = sql_read('select id from driver where region=? and status=? and location_time>?', 'iii', array($region_id, 1, $earlier));
            
            foreach((array)$nearby_drivers as $driver){
                $title = 'Nearby Order';
                $body = 'A nearby order, accept delivery order now!';
                
                if($driver['id']){
                    sendNotification($driver['id'], $title, $body);
                }
            }
            //-----Notify nearby (<=10km) drivers - End -----------

        }
        
        //debug($data);
    }
}


?>

<?php /*
<script src="js/jquery-3.4.1.js"></script>
<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">

<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
*/?>

<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background:#F5F5F5;">

    <?php include 'header.php'?>    
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">

            <div class="row p-4">

                <?php include ROOT.'back.php';?>

                <div class="row" style="width:100%;">
                    <div class="col-12 pt-5 pb-5">
                        
                        
                        <div class="row">
                            <div class="col-12">
                                
                                
                                <div class="row">

                                    <div class="col-12 col-md-6 offset-md-3">
                                        <h2><?php echo $_SESSION['auth_user']['branch_name']?></h2>
<?php 

$trips = sql_read("select SUM(trip_balance) as balance, SUM(topup_trip) as topup, trip_distance as distance from trip where trip_balance > ? and branch =? group by trip_distance order by trip_distance asc", 'ii', array(0, $_SESSION['auth_user']['branch']));//id, trip_balance, distance
?>
<div style="margin: 20px 0; padding: 10px; background:#fff1cc; border-radius:20px; border:1px solid #edd698; box-shadow:1px 1px 2px rgba(0,0,0,.2)">
    <div style="border-bottom:1px solid orange; font-size:20px; color:orange">
        <img src="<?php echo ROOT?>images/ticker-32.png" style="margin-bottom:3px; opacity:0.8">
        Your Trip Packages
    </div>
    <table class="table table-sm table-white mb-1" >
        <tr style="border-top:none;">
            <th style="border-top:none;">Trip<th>
            <th style="border-top:none;">Used<th>
            <th style="border-top:none;">Balance<th>
        </tr>
    <?php foreach($trips as $trip){?>
        <tr>
            <td><?php echo $trip['distance']?>KM<td>
            <td><?php echo $trip['topup']-$trip['balance']?><td>
            <td><?php echo $trip['balance']?><td>
        </tr>
    <?php }?>
    </table>
</div>

                                    </div>

                                    <form action="" method="post" enctype="multipart/form-data" style="width:100%">
                                    <div class="col-12 col-md-6 offset-md-3">
                                    
                                        <div class="row">
                                            <div class="col-12 pt-3">
                                                Customer Name
                                                <input name="customer_name" placeholder="Customer Name" type="text" class="form-group" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Phone
                                                <input name="phone" placeholder="Phone Number" type="number" class="form-group" required>
                                            </div>
                                        </div>

                                        <?php include 'google_map_distance.php'?>

                                        <div class="row">
                                            <div class="col-12 pt-4">
                                                Customer Property No.
                                                <input name="address" placeholder="Lot/Sublot/Unit" type="text" class="form-group" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Time<br>
                                                <input name="time" type="time" value="<?php echo date('H:i')?>" class="form-group" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php 
                                                    $zones = sql_read("select id, zone from zone where region=?", 'i', $_SESSION['auth_user']['region']);
                                                    //debug($zones);
                                                ?>
                                                Zone
                                                <select name="zone" class="form-group">
                                                    <?php foreach((array)$zones as $zone){?>
                                                    <option value="<?php echo $zone['id']?>">
                                                        <?php echo $zone['zone']?><?php echo $zone['id']?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <?php 
                                                    $vehicle_types = sql_read("select id, vehicle_type from vehicle_type where status=?", 'i', 1);
                                                ?>
                                                Vehicle Requirement
                                                <select name="requirement" class="form-group">
                                                    <?php foreach((array)$vehicle_types as $vehicle_type){?>
                                                    <option value="<?php echo $vehicle_type['id']?>">
                                                        <?php echo $vehicle_type['vehicle_type']?><?php echo $vehicle_type['id']?>
                                                    </option>
                                                    <?php }?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                Additional Message
                                                <textarea name="message" class="form-group"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 pt-4">
                                                <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span class="center-word">ORDER</span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </form>
                                    



                                </div>
                                



                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        
        </div>
    </div>
   
    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>



</body>
</html>
