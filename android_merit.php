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


            <div class="row">
                <div class="col-12 text-center" style="z-index:1;border-bottom:1px solid #FFF; background:#EFEFEF;">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="background: linear-gradient(0deg, rgba(222,222,222,1) 0%, rgba(238,238,238,1) 100%);border-right:1px solid #CCC;">
                            
                            <div style="color:#6ABE45;">
                                <div style="font-size:30px;">126
                                    <i class="fa fa-star" aria-hidden="true" style="font-size:14px; position:relative; top:-5px;"></i>
                                </div>
                                <div style="font-size:11px; position:relative; top:-10px;">
                                MERIT SCORE
                                </div>
                            </div>
                            
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-10 offset-1">

               
                    <div class="row pt-4">
                        <div class="col-1 p-2 text-center" style="color:#CCC;">
                            <i class="fa fa-filter" aria-hidden="true" style="margin-top:11px; font-size:90%; "></i>
                        </div>
                        <div class="col-5 p-2">
                            <select name="year" type="text">
                                <option value="">2021</option>
                                <option value="">2020</option>
                            </select>
                        </div>
                        <div class="col-6  p-2">
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
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12 pt-3 pb-1" style="font-size:180%;">
                    2021 March
                </div>
            </div>

           




            <div class="row item item3" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-10">
                            FAST PICK S0000231
                            
                        </div>
                        <div class="col-2 text-right">
                            <div style="font-size:12px; color:#6ABE45;">
                                +2p
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row item item3" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-10">
                            SLOW PICK S0000234
                        </div>
                        <div class="col-2 text-right">
                            <div style="font-size:12px; color:#ff6e63;">
                                -2p
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row item item3" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-10">
                            SLOW PICK S0000235
                        </div>
                        <div class="col-2 text-right">
                            <div style="font-size:12px; color:#ff6e63;">
                                -2p
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row item item3" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-10">
                            SLOW PICK S0000236
                        </div>
                        <div class="col-2 text-right">
                            <div style="font-size:12px; color:#ff6e63;">
                                -2p
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row item item3" data-toggle="modal" data-target="#confirmModal">
                <div class="col-12 pt-2 pb-2 order">
                    <div class="row">
                        <div class="col-10">
                            SLOW PICK S0000237
                        </div>
                        <div class="col-2 text-right">
                            <div style="font-size:12px; color:#ff6e63;">
                                -2p
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            


            <div class="row">
                <div class="col-12 pt-3 pb-3" style="background:#EDEDED; border-top:1px solid #CCC; font-size:80%;">
                    <div class="row pt-4">
                        <div class="col-12"><u>DAILY DELIVERED</u></div>
                        <div class="col-12">
                            Gain 1 points for at least 100 delivery case daily.
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12"><u>MONTHLY DELIVERED</u></div>
                        <div class="col-12">
                            Gain 3 points for at least 100 delivery case monthly.
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-12"><u>PEAK TIME</u></div>
                        <div class="col-12">Gain 1 point for peak time picked, peak time referring to 12.00pm-2.00pm 5.00pm-7.00pm.</div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12"><u>SEASON REWARD</u></div>
                        <div class="col-12">Gain 1 point for delivery on 2021-01-12, 2021-01-13,  2021-01-19,  2021-02-14,  2021-01-10,  2021-05-01.</div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-12"><u>FAST PICK</u></div>
                        <div class="col-12">Gain 1 point for fast pick up within 8 minutes.</div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-12"><u>FAST DELIVER</u></div>
                        <div class="col-12">Gain 1 point for fast delivery.</div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12"><u>ATTENDANCE REWARD</u></div>
                        <div class="col-12">Gain 2 points for total online duration more than 31 hours within 10 days.</div>
                    </div>

                </div>

            </div>





        </div>


    </div>


</div>

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
.btn-on-off {
    cursor:pointer;
}
.order {
    border-top:1px solid #e0e0e0;
}
.tab1, .tab2, .tab3 {
    border-top:1px solid #CCC;
    padding:12px 0 12px 0;    
    cursor:pointer;    
    border-bottom:3px solid #d6edd3;
    transition: border-bottom .5s;
    background:#EFEFEF;
}
.tab1:hover, .tab2:hover, .tab3:hover {    
    border-bottom:3px solid green;
    background:#cdffc7;
}
.tab-active {
    background:#d6edd3;
    border-bottom:3px solid #32a852;
}
select{
    box-shadow:none;
}

</style>

<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            