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

?>


<script src="js/jquery-3.4.1.js"></script>


<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">


<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background:#000;">

<div style="position:fixed; z-index:11; width:100%; height:100vh; pointer-events: none; margin:0 calc((100% - 310px )/2);">    
    <img src="<?php echo ROOT?>images/phone-frame.png" style="margin-left:auto;">
</div>

<div style=" margin:40px calc((100% - 310px )/2 + 19px); width:320px; background:white; min-height:100vh;">


    <?php include 'android_header.php'?>


                                    
    <div class="row">

        <div style="width:328px; margin-left:10px; padding:0 16px 60px 16px; background:#F5F5F5;">
            
            <?php if($_GET['new'] == 1){?>
            <div class="row">
                <div class="col-12 text-center" style="z-index:1; border-bottom:1px solid #FFF; background:#EFEFEF;">
                    <div class="row">
                        <div class="col-12 pb-3 pt-4" style="background: linear-gradient(180deg, rgb(95, 173, 61) 0%, rgb(75, 135, 49) 100%); border-right:1px solid #CCC; color:white;">
                            <div>FAST PICK COUNTDOWN</div>
                            <div id="demo" style="font-size:180%; height:40px;"></div>
                        </div>                        
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="row">
                <div class="col-12 text-left" style="z-index:1; border-bottom:1px solid #FFF; background:#EFEFEF;">
                    <div class="row">
                        <div class="col-12 pb-3 pt-4" style="background: linear-gradient(0deg, rgba(222,222,222,1) 0%, rgba(238,238,238,1) 100%); border-right:1px solid #CCC; ">
                            <div class="row pb-2">
                                <div class="col-12 label">Assignee</div>
                                <div class="col-12">Michael Jackson</div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-12 label">Status</div>
                                <div class="col-12">Delivered</div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-12 label">Merit</div>
                                <div class="col-12">Fast Pick</div>
                            </div>
                            
                                                      
                        </div>                        
                    </div>
                </div>
            </div>


            <?php }?>
    
            <div class="row pt-3">

                                

                <div class="col-12">
                    <div class="row pb-4">
                        <div class="col-12" style="font-size:160%;">
                            TAKA sdn. bhd. HQ Branch
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">                                        
                            <div class="label">Branch</div>
                            HQ Kuching 10th Mile                                        
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Customer Name</div>
                            Mr. Tan Kie Hua
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Phone</div>
                            012-882 9013
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Send From</div>
                            <img src="<?php echo ROOT?>images/place-search-bar.png" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12 pt-4">
                            <div class="label">Send To</div>
                            <img src="<?php echo ROOT?>images/place-search-bar.png" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12 pt-4">
                            <div class="label">House number (Lot/Sublot/etc)</div>
                            Sublot 12
                        </div>
                    </div>


                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Time</div>
                            12:00pm
                        </div>
                    </div>
                    
                    
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Zone</div>
                            Kuching 10th Mile
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Additional Message</div>
                            He had three simple rules by which he lived. The first was to never eat blue food. There was nothing in nature that was edible that was blue. 
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="label">Vehicle requirement</div>                            
                            -
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-12">

                        <?php if($_GET['new'] == 1){?>

                            <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default" style="background:green;">
                                <i class="fa fa-check pr-1" aria-hidden="true"></i>
                                <span class="center-word">PICKUP NOW</span>
                            </button>
                            
                            <?php }else{?>

                            <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default">
                                <i class="fas fa-camera pr-1"></i>
                                <span class="center-word">PROVE OF DELIVERY</span>
                            </button>

                            <?php }?>
                        </div>
                    </div>

                 


                </div>



            </div>




        </div>


    </div>


</div>





</body>
</html>
<style>
.label {
    color:#999;
    font-size:80%;
}

</style>



<?php 

$eight_minutes = date("H:i:s",strtotime(date("H:i:s")." +8 minutes"));
?>

<script>

// Set the date we're counting down to
var countDownDate = new Date("Mar <?php echo date('d')?>, <?php echo date('Y')?> <?php echo $eight_minutes?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  //document.getElementById("demo").innerHTML = days + "d " + hours + "h "  + minutes + "m " + seconds + "s ";
  document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            