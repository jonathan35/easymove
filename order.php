<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'api/send_notification.php';

if(empty($_SESSION['auth_user']['id'])){
    header("Location: please_login");
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

                                    <form action="<?php echo ROOT.'orders'?>" method="post" enctype="multipart/form-data" style="width:100%">
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
                                                Zone <span style="color:red; font-size:90%;">(Choose your nearby location)</span>
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
                                                        <?php echo $vehicle_type['vehicle_type']?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                Additional Message <span style="color:red; font-size:90%;">(eg. Fragile)</span>
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
