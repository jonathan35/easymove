<?php 
require_once 'config/ini.php';
require_once 'config/security.php';

require_once 'config/auth.php';



if($_POST['action'] == 'signup' && !empty($_SESSION['auth_user']['id'])){
  
    if($_SESSION['auth_user']['region']){
        $_SESSION['region'] = $_SESSION['auth_user']['region'];
    }

    header("Location: home");
}


if(!empty($_GET['i'])){
    $user = array(
        'name' => 'John',
        'mobile' => '0113449855',
        'emergency' => '0163449855',
        'plate' => 'QAZ9833',
        'owner' => 'Jonny',
        'ic' => '80121244568923',
        'license' => '29837642938742',
        'front' => 'yes',
        'back' => 'yes'
    );
}

?>


<script src="js/jquery-3.4.1.js"></script>


<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">


<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background:#000; ">

<div style="position:fixed; z-index:11; width:100%; height:100vh; pointer-events: none; margin:0 calc((100% - 310px )/2);">    
    <img src="<?php echo ROOT?>images/phone-frame.png" style="margin-left:auto;">
</div>

<div style=" margin:40px calc((100% - 310px )/2 + 19px); width:320px; background:green;">


    <?php include 'android_header.php'?>


                                    
    <div class="row">

        <div style="width:328px; margin-left:10px; padding:30px 16px 60px 16px; background:#F5F5F5;">

            <h3>Driver Application</h3>
            <div class="row pt-3">
                <div class="col-12">
                    Driver Name
                    <input name="name" value="<?php echo $user['name']?>" placeholder="Driver Name" type="text" class="form-group" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Full/Part Time
                    <select name="time" class="form-group" >
                        <option value="Full">Full Time</option>
                        <option value="Part">Part Time</option>
                    </select>
                    
                </div>
            </div>

            
            <div class="row">
                <div class="col-12">
                    Mobile number
                    <input name="phone" value="<?php echo $user['mobile']?>" type="text" class="form-group" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Emergency Contact Number
                    <input name="phone" value="<?php echo $user['emergency']?>" type="text" class="form-group" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Vehicle Type
                    <select name="time" class="form-group" >
                        <option value="Full">Motocycle</option>
                        <option value="Part">Van</option>
                        <option value="Part">Lori</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Region
                    <select name="time" class="form-group" >
                        <option value="Full">Islam</option>
                        <option value="Part">Christian</option>
                        <option value="Part">Other</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Plate Number
                    <input name="plate" value="<?php echo $user['plate']?>" type="text" class="form-group" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Vehicle Owner
                    <input name="vehicle_owner" value="<?php echo $user['owner']?>" type="text" class="form-group" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Photo of IC
                    <input name="ic" type="text" value="<?php echo $user['ic']?>" class="form-group" required style="padding-left:30px;">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Photo of Driving License
                    <input name="photo_license" value="<?php echo $user['license']?>" type="text" class="form-group" required required style="padding-left:30px;">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if(!empty($user['front'])){?>
                        <img src="<?php echo ROOT?>images/car_front.jpg" alt="" class="img-fluid">
                    <?php }?>
                    Photo of vehicle (Front View)
                    <input name="photo_front" type="text" class="form-group" required accept=".jpg,.jpeg,.png,capture=camera" required style="padding-left:30px;">
                    <i class="fa fa-camera" aria-hidden="true"></i>                    
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Photo of vehicle (Back View)
                    <?php if(!empty($user['back'])){?>
                        <img src="<?php echo ROOT?>images/car_side.jpg" alt="" class="img-fluid">
                    <?php }?>
                    
                    <input name="photo_back" type="text" class="form-group" required accept=".jpg,.jpeg,.png,capture=camera" required style="padding-left:30px;">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
            </div>

            <div class="row">
                <div class="col-12 pt-3">
                    <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default">
                        <span class="center-word">APPLY NOW</span>
                    </button>
                </div>
            </div>
        </div>


    </div>


</div>



</body>
</html>
<style>
.fa {
    color:#999;
    display:inline-block;
    position:relative;
    height:0;
    top:-43px;
    left:10px;

}


</style>

<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            