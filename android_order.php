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
<body class="container-fluid p-0" style="background:#000; ">

<div style="position:fixed; z-index:11; width:100%; height:100vh; pointer-events: none; margin:0 calc((100% - 310px )/2);">    
    <img src="<?php echo ROOT?>images/phone-frame.png" style="margin-left:auto;">
</div>

<div style=" margin:40px calc((100% - 310px )/2 + 19px); width:320px; background:white; min-height:100vh;">


    <?php include 'android_header.php'?>


                                    
    <div class="row">

        <div style="width:328px; margin-left:10px; padding:0 16px 60px 16px; background:#F5F5F5;">


            <div class="row">
                <div class="col-12 text-center" style="z-index:1;border-bottom:1px solid #FFF; background:#EFEFEF;">
                    <div class="row">
                        <div class="col-6 p-2 pt-2 btn-on-off" style="background: linear-gradient(0deg, rgba(222,222,222,1) 0%, rgba(238,238,238,1) 100%);border-right:1px solid #CCC;">
                            <div style="font-size:30px;">
                                <span class="on">ON
                                <i class="fa fa-check-circle" aria-hidden="true" style="font-size:14px; position:relative; top:-5px;"></i>
                                </span>
                                <span class="off collapse">OFF
                                <i class="fa fa-circle" aria-hidden="true" style="font-size:14px; position:relative; top:-5px;"></i>
                                </span>
                            </div>
                            <div style="font-size:11px; position:relative; top:-10px; color:;">
                                <span class="on">TODAY: 4hrs 30m</span>
                                <span class="off collapse">TODAY: 4hrs 30m</span>
                            </div>
                        </div>
                        <script>
                        $('.btn-on-off').click(function(){
                            $('.on').toggle();
                            $('.off').toggle();
                        })
                        </script>



                        
                        <div class="col-6 p-2 pt-2 pb-2" style="background: linear-gradient(0deg, rgba(222,222,222,1) 0%, rgba(238,238,238,1) 100%); border-left:1px solid #FFF;">
                            
                            <a href="<?php echo ROOT?>android_merit.php">
                                <div style="font-size:30px;">126
                                    <i class="fa fa-star" aria-hidden="true" style="font-size:14px; position:relative; top:-5px;"></i>
                                </div>
                                <div style="font-size:11px; position:relative; top:-10px;">
                                MERIT SCORE
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!--<h3>ORDERS</h3>-->
            <div class="row text-center" style="z-index:2;box-shadow:0 -2px 2px rgba(0,0,0,.4);">
                <div class="col-4 tab1 tab-active">
                    <div>NEW</div>
                    <div class="tab_label">4</div>
                </div>
                <div class="col-4 tab2">
                    <div>DELIVER</div>
                    <div class="tab_label">1<!--Assigned/Accepted--></div>
                </div>
                <div class="col-4 tab3">
                    <div>DONE</div>
                    <div class="tab_label">1,004<!--Delivered/Cancelled--></div>
                </div>
                
            </div>



            <?php for($a=1; $a<=4; $a++){?>
            <a href="<?php echo ROOT?>android_details.php?new=1">
            <div class="row item item1" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-7" style="color:#333;">
                            S000023<?php echo $a?>
                            <div style="font-size:12px;">
                                <?php echo rand(1,12)?>.<?php echo rand(0,5); echo rand(1,9)?>pm, Mar 20
                            </div>
                        </div>
                        <div class="col-5 text-right">                            
                            <div>
                                <span style="font-size:70%; color:#999;">est.</span>
                                <?php echo rand(1,12)?>KM 
                            </div>
                        </div>
                    </div>
                </div>
            </div></a>
            <?php }?>


            <?php 
            $Assigned = '<span style="color:green;">Assigned</span>';
            $Accepted = '<span style="color:green;">Accepted</span>';
            $working_status = array(1=>$Accepted, 2=>$Assigned);
            ?>
            <a href="<?php echo ROOT?>android_details.php">
            <div class="row item item2 collapse">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-7" style="color:#333;">
                            S000023<?php echo $a?>
                            <div style="font-size:12px;">
                                <?php echo rand(1,12)?>.<?php echo rand(0,5); echo rand(1,9)?>pm, Mar 20
                            </div>
                        </div>
                        <div class="col-5 text-right">                            
                            <div>
                                <?php echo $working_status[rand(1,2)]?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div></a>
         
            <!--
         
            <div class="row item item3" style="display:none">
                <div class="col-1 p-2 text-center" style="color:#CCC;">
                    <i class="fa fa-filter" aria-hidden="true" style="margin-top:11px; font-size:90%; margin-left:4px;"></i>
                </div>
                <div class="col-6 p-2">
                    <select name="year" type="text">
                        <option value="">2021</option>
                        <option value="">2020</option>
                    </select>
                </div>
                <div class="col-5  p-2">
                    <select name="month" type="text">
                        <option value="">Jan</option>
                        <option value="">Feb</option>
                        <option value="">Mar</option>
                        <option value="">Apr</option>
                        <option value="">May</option>
                        <option value="">Jun</option>
                        <option value="">Jul</option>
                        <option value="">Aug</option>
                        <option value="">Sep</option>
                        <option value="">Oct</option>
                        <option value="">Nov</option>
                        <option value="">Dec</option>
                    </select>
                </div>
            </div>-->



            <?php 
            $Delivered = '<span style="color:green;">Delivered</span>';
            $Cancelled = '<span style="color:red;">Cancelled</span>';
            $history_status = array(1=>$Delivered, 2=>$Cancelled,3=>$Delivered, 4=>$Delivered, 5=>$Delivered,6=>$Delivered,7=>$Delivered,8=>$Delivered);

            for($a=1; $a<=40; $a++){?>
            <a href="<?php echo ROOT?>android_details.php">
            <div class="row item item3 collapse" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-7" style="color:#333;">
                            S000023<?php echo $a?>
                            <div style="font-size:12px;">
                                <?php echo rand(1,12)?>.<?php echo rand(0,5); echo rand(1,9)?>pm, Mar 20
                            </div>
                        </div>
                        <div class="col-5 text-right">
                            <div>
                                <?php echo $history_status[rand(1,8)]?>
                            </div>
                        </div>
                    </div>
                </div>
            </div></a>
            <?php }?>
           

        </div>


    </div>


</div>


<?php /*
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel"  style="width:305px; margin-top:30vh; margin-left: calc(50% - 120px);">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <div class="row">
                    
                        <div class="col-12 p-0 text-center mb-4 pt-3">
                            <p style="font-size:160%;">ACCEPT ORDER?</p>
                        </div>
                                                    
                        <div class="col-12 p-0 text-center form-group">
                            <button type="submit" value="login-submit" class="btn btn-block p-3 btn-default" style="background:green;">
                                <i class="fa fa-check pr-2" aria-hidden="true"></i>
                                <span class="center-word">PICKUP NOW</span>
                            </button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>*/?>




<script>
$('.tab1').click(function(){
    $('.item').fadeOut();
    $('.item1').fadeIn();
    $('.tab-active').toggleClass('tab-active');
    $(this).addClass('tab-active');
})
$('.tab2').click(function(){
    $('.item').fadeOut();
    $('.item2').fadeIn();
    $('.tab-active').toggleClass('tab-active');
    $(this).addClass('tab-active');
})
$('.tab3').click(function(){
    $('.item').fadeOut();
    $('.item3').fadeIn();
    $('.tab-active').removeClass('tab-active');
    $(this).addClass('tab-active');
})


</script>




</body>
</html>
<style>
.on {
    color:#6ABE45;
}
.off {
    color:#ff6e63;
}

.btn-on-off {
    cursor:pointer;
}
.order {
    border-top:1px solid #e0e0e0;
}
.tab1, .tab2, .tab3 {
    padding:12px 0 12px 0;    
    cursor:pointer;    
    border-bottom:3px solid #333;
    transition: border-bottom .5s;
    background:#666;
    color: white;
}
.tab1:hover, .tab2:hover, .tab3:hover {    
    border-bottom:3px solid green;
    background:#6ABE45;
}
.tab-active {
    background:#5ea83d;
    border-bottom:3px solid #4b8731;
}
.tab_label {
    font-size:90%; color:#FFF;
}
select{
    box-shadow:none;
}
.item {
    cursor:pointer; 
    transition: background .5s;
}
.item:hover {
    background:#cdffc7;
}

</style>

<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            