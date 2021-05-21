<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';

if(!empty($_POST['keyword'])){
    $order_id = 0 + $_POST['keyword'];
    if($order_id>0){
        $order = sql_read("select status from orders where id=? limit 1", 'i', $order_id);
    }
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
<body class="container-fluid p-0" style="background:#F5F5F5;">

    <?php include 'header.php'?>    
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">

            <div class="row p-4">

                <?php include ROOT.'back.php';?>

                <div class="col-12 pt-5 pb-5">
                               
                    <div class="row">

                        <div class="col-12 ">

                            <div class="d-none d-md-inline"><br><br><br><br><br><br></div>
                            <div class="row d-none d-md-inline-block" style="width:100%;">
                                <div class="text-block">Orders in</div>
                                <div class="text-block">Accepted by driver</div>
                                <div class="text-block">Collected from merchant</div>
                                <div class="text-block">Delivering</div>
                                <div class="text-block" data-toggle="modal" data-target="#deliveredModal">Received by customer</div>                        
                            </div>

                            <div class="step-chart">

                                <?php 
                                $active_class1 = $active_class2 = $active_class3 = $active_class4 = $active_class5 = '';
                                
                                if($order['status'] == 'Ordered'){
                                    $done = 1;
                                    $active_class1 = 'dock-active';
                                }elseif($order['status'] == 'Accepted'){
                                    $done = 2;
                                    $active_class2 = 'dock-active';
                                }elseif($order['status'] == 'Collected'){
                                    $done = 3;
                                    $active_class3 = 'dock-active';
                                }elseif($order['status'] == 'Delivering'){
                                    $done = 4;
                                    $active_class4 = 'dock-active';
                                }elseif($order['status'] == 'Delivered'){
                                    $done = 5;
                                    $active_class5 = 'dock-active';
                                }?>

                                <div class="line"></div>
                                <div class="dock <?php if($done>0) echo 'dock-done '; $done--; echo $active_class1?>">
                                    <div class="text-v-block"><div>Orders in</div></div>
                                </div>
                                <div class="devider">&nbsp;</div>
                                <div class="dock <?php if($done>0) echo 'dock-done '; $done--; echo $active_class2?>">
                                    <div class="text-v-block"><div>Accepted by driver</div></div>
                                </div>
                                <div class="devider">&nbsp;</div>
                                <div class="dock <?php if($done>0) echo 'dock-done '; $done--; echo $active_class3?>">
                                    <div class="text-v-block"><div>Collected from merchant</div></div>
                                </div>
                                <div class="devider">&nbsp;</div>
                                <div class="dock <?php if($done>0) echo 'dock-done '; $done--; echo $active_class4?>">
                                    <div class="text-v-block"><div>Delivering</div></div>
                                </div>
                                <div class="devider">&nbsp;</div>
                                <div class="dock <?php if($done>0) echo 'dock-done '; $done--; echo $active_class5?>" data-toggle="modal" data-target="#deliveredModal" style="cursor:pointer;">
                                    <div class="text-v-block" data-toggle="modal" data-target="#deliveredModal"><div>Received by customer</div></div>
                                </div>
                            </div>                            
                        </div>


                        <div class="row" style="width:100%;">
                            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 pt-5 mb-5">

                                <?php if($order['status'] == 'Ordered'){?>
                                    <div class="col-12 pb-3">
                                        <div class="title">Orders in</div>
                                        order was made by MERCHANT_NAME from BRANCH_NAME
                                    </div>
                                <?php }elseif($order['status'] == 'Accepted'){?>
                                    <div class="col-12 pb-3">
                                        <div class="title">Accepted</div>
                                        Driver DRIVER_NAME are accepting the job at order and will collect immediately.
                                    </div>
                                <?php }elseif($order['status'] == 'Collected'){?>
                                    <div class="col-12 pb-12">
                                        <div class="title">Collected</div>
                                        Driver is reaching outlet and took the goods to destination.
                                    </div>
                                <?php }elseif($order['status'] == 'Delivering'){?>
                                    <div class="col-12 pb-3">
                                        <div class="title">Delivering</div>
                                        Driver is on the way to destination. It taking time based on weather and traffic condition.
                                    </div>
                                <?php }elseif($order['status'] == 'Delivered'){?>
                                    <div class="col-12 pb-3">
                                        <div class="title">Received</div>
                                        The goods/parcel have been received by customer successfully.
                                    </div>
                                <?php }?>
                                                   
                            </div>                        
                        </div>

<style>
.title {
    font-size:20px;
    font-weight:bold;
    color: var(--clr-positive);
}
:root {
--clr-main: #ffcb5c;
--clr-positive: #ffae00;
}

@keyframes beating {
0%   {box-shadow: 0 0 6px rgba(0,0,0,0.3), 0 0 1px 1px rgba(255, 177, 0, .5);}
50%  {box-shadow: 0 0 6px rgba(0,0,0,0.3), 0 0 10px 10px rgba(255, 177, 0, .8);}
100% {box-shadow: 0 0 6px rgba(0,0,0,0.3), 0 0 1px 1px rgba(255, 177, 0, .5);}
}
.step-chart {
    width:82%;
    margin:0 8%;
}
.text-v-block {
    display:none;
}
@media (max-width: 575px) {
    .step-chart {
        transform: rotate(90deg);
        margin:0 8%;
        position:relative;
        left:-260px;
        height:300px;/**/
    }
    .text-v-block {
        display:inline-block;
        position:relative;
        width:0;
        height:0;
        top:-14px;
        left:-2px;
        width:250px;
        text-align:left;
        transform: rotate(-90deg);
        transform-origin: top left;
    }
    
    
}


.line {
    z-index:1;
    width: calc(100% - 30px);
    margin:0;
    border-bottom:5px solid var(--clr-main);
    /*outline:2px solid var(--clr-main);*/
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
    position: relative;
    top:15px;
}
.dock {
    display:inline-block;
    position: relative;
    width:26px;
    height:26px;
    background: #CCC;
    border-radius:17px;
    z-index:2;
    border:4px solid #FFF;
    box-shadow: 0 0 6px rgba(0,0,0,0.3);
}
.devider {
    display:inline-block;
    width: calc(25% - 42px);
}
.dock-active {
    animation: beating 1s infinite;
}
.dock-done {
    background: var(--clr-main);
}
.text-block {
    transform: rotate(-35deg);
    transform-origin: top left;
    display:inline-block;
    position:relative;
    left:10%;

    width:19.5%;
    text-align:left;    
}
</style>




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
    

    <div id="deliveredModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel">
            <div class="modal-body">
                <div class="row float-right pr-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-black" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="login-panel form-rounded">
                    <div class="row">                        
                        <img src="<?php echo ROOT?>images/proof-of-delivery-form-template.jpg" alt="" style="width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            