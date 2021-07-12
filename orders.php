<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';

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

        header("Location:order");

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
            Order successfully, please wait for a response.</div>';


            //-----Notify nearby (<=10km) drivers - Start -----------
            $earlier = time()-(60*30);//30 minutes early than now
            $region_id = $data['region'];
            $nearby_drivers = sql_read('select id from driver where region=? and status=? and location_time>?', 'iii', array($region_id, 1, $earlier));
            
            foreach((array)$nearby_drivers as $driver){
                $title = 'Nearby Order';
                $body = 'A nearby order, accept delivery order now!';
                
                if($driver['id']){
                    //$driver_id = $driver['id'];
                    //include 'api/remote_push.php';
                    
                    sendNotification($driver['id'], $title, $body);
                }
            }
            //-----Notify nearby (<=10km) drivers - End -----------

        }
        
        //debug($data);
    }
}




$company_id = $_SESSION['auth_user']['company'];
$branch_id = $_SESSION['auth_user']['branch'];
$branch_type = $_SESSION['auth_user']['type'];
          
if($_POST['submit'] == 'RESET'){ 
    unset($_REQUEST);
}


/*
$_SESSION['session_msg'] = '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
style="position:relative; top:-2px;">×</a>
Failed to submit error. '.$msg.'</div>';
$_SESSION['session_msg'] = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
Order successfully.</div>';
*/

?>

<?php /*
<script src="js/jquery-3.4.1.js"></script>
<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
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
                    
                    <div class="col-12 pb-5" style="min-height:60vh;">
                        <div class="row">
                            <div class="col-12 pl-4 p-md-auto">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-auto p-1 pt-2">
                                            <div class="text-muted">DATE FROM</div>
                                            <input type="date" name="from" value="<?php echo $_REQUEST['from']?>">
                                        </div>
                                        <div class="col-auto p-1 pt-2">
                                            <div class="text-muted">DATE TO</div>
                                            <input type="date" name="to" value="<?php echo $_REQUEST['to']?>">
                                        </div>
                                        <?php 
                                        if($branch_type == 'Headquarter'){//Branch

                                            $branches = sql_read("select id, branch_name from branch where company_id=?", 'i', $_SESSION['auth_user']['company']);
                                            ?>                                            
                                            <div class="col-auto p-1 pt-2">
                                                <div class="text-muted">BRANCH</div>
                                                <select name="branch" id="">
                                                    <option value="">All BRANCH</option>
                                                    <?php foreach((array)$branches as $branch){?>
                                                        <option value="<?php echo $defender->encrypt('encrypt', $branch['id'])?>" <?php if($_REQUEST['branch'] == $defender->encrypt('encrypt', $branch['id'])){?>selected<?php }?>><?php echo $branch['branch_name']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        <?php }?>
                                        <div class="col-auto p-1 pt-2">
                                            <div class="text-muted">STATUS</div>
                                            <select name="status" id="">
                                                <option value="">All STATUS</option>
                                                <option value="Ordered" <?php if($_REQUEST['status'] == 'Ordered'){?>selected<?php }?>>Ordered</option>
                                                <option value="Accepted" <?php if($_REQUEST['status'] == 'Accepted'){?>selected<?php }?>>Accepted</option>
                                                <option value="Collected" <?php if($_REQUEST['status'] == 'Collected'){?>selected<?php }?>>Delivering</option>
                                                <option value="Delivered" <?php if($_REQUEST['status'] == 'Delivered'){?>selected<?php }?>>Received</option>
                                            </select>
                                        </div>
                                        <div class="col-auto p-1 pt-2">

                                            <div>&nbsp;</div>
                                            <div class="row">
                                                <div class="col-6 pr-0">
                                                    <input type="submit" value="FILTER" class="btn btn-default btn-md p-1 pr-3 pl-3" >                                                
                                                </div>
                                                <div class="col-6 pl-1">
                                                    <input type="submit" name="submit" value="RESET" class="btn btn-default btn-md p-1 pr-3 pl-3" style="background:gray;">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 pt-4"><h1>Orders</h1></div>
                        </div>
                        <table class="table">
                            <?php 

                            $params = 1;
                            $param_vals = array();
                            $branch_query = '';
                            $param_vals[] = $_SESSION['auth_user']['company'];

                            if($branch_type == 'Branch' || !empty($_POST['branch'])){//Headquarter
                                $branch_query = ' and branch=? ';
                                $params++;
                                if(!empty($_POST['branch'])){
                                    $param_vals[] = $defender->encrypt('decrypt', $_POST['branch']);
                                }else{
                                    $param_vals[] = $_SESSION['auth_user']['branch'];
                                }                                
                            }
                            if(!empty($_POST['status'])){
                                $status_query = ' and status=? ';
                                $params++;
                                $param_vals[] = $_POST['status'];
                            }
                            if(!empty($_POST['from'])){
                                $from_query = ' and created >=? ';
                                $params++;
                                $param_vals[] = $_POST['from'];
                            }
                            if(!empty($_POST['to'])){
                                $to_query = ' and created <=? ';
                                $params++;
                                $param_vals[] = $_POST['to'];
                            }


                            $orders = sql_read("select * from orders where company = ? $branch_query $status_query $from_query $to_query order by id desc", str_repeat('s', $params), $param_vals);                        
                            ?>
                            

                            <tr>
                                <th>No.</th>
                                <th>ORDER</th>
                                <?php if($branch_type == 'Headquarter'){?>
                                    <th>BRANCH</th>
                                <?php }?>
                                <th>CUSTOMER</th>
                                <th>PHONE</th>
                                <th>STATUS</th>
                            </tr>

                            <?php 
                            $itemCount=1;
                            $maxPerPage=10;
                            
                            foreach((array)$orders as $order){?>
                            <tr class="page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                                <td><?php echo $itemCount?></td>
                                <td style="font-weight:bold;">
                                    <a href="<?php echo ROOT?>the_order/<?php echo $defender->encrypt('encrypt', $order['id'])?>" target="_blank" style="font-size:130%;"><?php echo sprintf("%08d", $order['id']);?></a>
                                </td>
                                <?php if($branch_type == 'Headquarter'){?>
                                    <td><?php echo $order['branch_name']?></td>
                                <?php }?>
                                <td>
                                    <?php echo $order['customer_name']?>
                                </td>
                                <td>
                                    <?php echo $order['phone']?>
                                </td>
                                <td>
                                    <?php echo $order['status']?>
                                </td>
                            </tr>
                        
                            <?php 
                            $itemCount++;
                            }?>
                            
                        </table>
                        <?php include 'paging.php'?>

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


<script src="js/functions.jquery.js"></script>
<?php include_once ROOT.'config/session_msg.php';?>
            