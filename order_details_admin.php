<?php
include_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'cart_function.php';
require_once 'head.php';
require_once 'api/send_notification.php';


$auth = false;

if($_SESSION['validation'] == 'YES'){//Is admin
    $auth = true;
}elseif(!empty($_SESSION['auth_user']['id'])){//Is merchant
    $auth = true;
}elseif(!empty($_GET['t'])){//Is valid token
  
    $check_token = sql_read('select * from token where token=? AND expiry > ? limit 1', 'ss', array($_GET['t'], date('Y-m-d H:i:s')));

    if($check_token['id']){
        $auth = true;
    }
}
if(!$auth) void;




function getTimePass($time){

    $return = '';

    $minutes = round((time()-$time)/60);//convert $time in second to minute
    if($minutes>0) $return .= '(';

    $hr = round($minutes/60);
    if($hr>0){
        $minutes = $minutes - ($hr*60);
        $return .= $hr.'h';
    }
    if($minutes>0)  $return .= $minutes.'m';
    $return .= ' ago)';
    return $return;
}


function get_coor($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


if($_GET['i']){
    $oid = $defender->encrypt('decrypt',$_GET['i']);
}



if($oid){

    if($_POST['assign'] && $_POST['driver']){

        $data['id'] = $oid;
        $data['assign'] = $_POST['driver'];
        
        sql_save('orders', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Assign driver successfully, waiting driver acceptance.</div>';

        $title = 'Order Assigned';
		$body = 'Order ' .sprintf("%08d", $oid).' has been assigned to you.';

        //$driver_id = $order['driver'];
        //include 'api/remote_push.php';
		
        sendNotification($_POST['driver'], $title, $body);
    }

    if($_POST['cancel'] && $_POST['oid']){

        $data['id'] = $oid;
        $data['status'] = 'Cancelled';
        
        sql_save('orders', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Order cancelled successfully, please inform merchant about cancellation.</div>';

        $order = sql_read('select driver from orders where id=? limit 1', 's', $oid);

        if($order['driver']){
            $title = 'Order Cancelled';
            $body = 'Order ' .sprintf("%08d", $oid).' has been cancelled.';

            //$driver_id = $order['driver'];
            //include 'api/remote_push.php';
            
            sendNotification($order['driver'], $title, $body);
        }
    }


    $order = sql_read('select * from orders where id=? limit 1', 's', $oid);
    $branch = sql_read("select * from branch where id=? limit 1", 'i', array($order['branch']));
    $region = sql_read("select * from region where id=? limit 1", 'i', array($order['region']));
    $zone = sql_read("select * from zone where id=? limit 1", 'i', array($order['zone']));
}



if(!empty($order['id'])){?>
<style>
.text-label {
    color: var(--secondary);
    font-weight:normal;
    opacity: 0.8;
}
.text-label2 {
    color: #FFF;
    font-weight:normal;
    opacity: 0.7;
}
.content {
    color:#333;
    font-weight:bold;
}
.title {
    color: #333;
    font-size:150%;
    border-bottom:1px dashed #000;
    padding-top:24px;
}
.header-content {
    background:#ffa800;
    color:white;
}
@media not|only mediatype and (expressions) {
    .header-content {
        background:#FFF;
        color:black;
    }
}
</style>


    <div style="width:99.5%; padding:0 10px; border:1px solid #ccc; box-shadow:3px 3px 3px rgba(0,0,0,.2);">
       
        <div class="row content">

            <div class="col-12 col-md-4 pl-3 header-content">
                <img src="<?php echo ROOT?>images/logo.jpg" class="img-fluid mt-2">
                
                <div class="row title">
                    <div class="col-6">ORDER</div>
                    <div class="col-6 text-right">
                        [<?php if($order['status'] =='Ordered') echo 'New'; 
                        else echo $order['status'];?>]
                    </div>
                </div>
                
                
                <div class="pt-2">
                    <span class="text-label2">ID: </span>
                    <?php echo $mo = sprintf("%08d", $order['id']); ?>
                </div>   
                <div class="pt-2">
                    <span class="text-label2">DATE: </span>
                    <?php echo date('d/m/Y', strtotime($order['modified']));?>
                </div>

                <div class="row title"><div class="col-6">DRIVER</div></div>
                <div class="pt-2">
                    <span class="text-label2">DRIVER: </span>
                    <?php if($order['driver_name']){ echo $order['driver_name'];}else{echo '-';}?>
                </div>   
                <div class="pt-2">
                    <span class="text-label2">PHONE: </span>
                    <?php if($order['driver_phone']){ echo $order['driver_phone'];}else{echo '-';}?>
                </div>
                <div class="pt-2">
                    <span class="text-label2">DESTANCE: </span>
                    <?php echo $order['distance'];?>KM
                </div>
                <?php if(!empty($order['proof_of_delivery'])){?>
                <div class="pt-2">
                    <span class="text-label2">PROOF OF DELIVERY: </span>
                    <img src="<?php echo ROOT?>api/<?php echo $order['proof_of_delivery']?>" class="img-fluid">
                </div>
                <?php }?>
            </div>

            <div class="col-12 col-md-4">
    
                <div class="title">FROM</div>
              
                <div class="text-label pr-2" width="170px;">COMPANY</div>
                <div class="pb-3"><?php echo $branch['branch_name'];?></div>
            
                <div class="text-label pr-2">CONTACT PERSON</div>
                <div class="pb-3"><?php echo $branch['contact_person'];?></div>
            
                <div class="text-label pr-2">PHONE</div>
                <div class="pb-3">
                    <?php echo $branch['mobile_number'];?>
                </div>
            
                <div class="text-label pr-2">REGION</div>
                <div class="pb-3"><?php echo $region['region'];?></div>
            
                <div class="text-label pr-2">ORIGIN</div>
                <div class="pb-3"><?php echo $order['origin'];?></div>
                   
            </div>
            <div class="col-12 col-md-4 lg-border-left">             
                <div class="title">TO</div>

                <div class="text-label pr-2" width="170px;">RECEIVER</div>
                <div class="pb-3"><?php echo $order['customer_name'];?></div>

                <div class="text-label pr-2">PHONE</div>
                <div class="pb-3"><?php echo $order['phone'];?></div>

                <div class="text-label pr-2">ZONE</div>
                <div class="pb-3"><?php echo $zone['zone'];?></div>
            
                <div class="text-label pr-2">DESTINATION</div>
                <div class="pb-3"><?php echo $order['destination'];?></div>

                <div class="text-label pr-2">
                    PROPERTY UNIT 
                    <span style="font-size:90%;">(Floor/Lot/Sublit/Unit)</span>
                </div>
                <div class="pb-3"><?php echo $order['address'];?></div>
            
                <div class="text-label pr-2">TIME</div>
                <div class="pb-3">
                    <?php echo date('h:ia', strtotime($order['time']));?>
                    <?php echo getTimePass(strtotime(substr($order['created'],0,10).' '.$order['time']))?>
                </div>
                
                <?php if($order['message']){?>
                    <div class="text-label pr-2">MESSAGE</div>
                    <div class="pb-3"><?php echo $order['message'];?></div>
                <?php }?>
                <?php if($order['requirement']){?>
                    <div class="text-label pr-2">REQUIREMENT</div>
                    <div class="pb-3"><?php echo $order['requirement'];?></div>
                <?php }?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-4 header-content"></div>
            <div class="col-12 col-md-8">
                <div class="row" >
                    <div class="col-12 p-3 text-right">
                        <?php 
                        $phone = $order['phone'];
                        if (substr($phone, 0,1) != 6) {
                            $phone = '6'.$phone;
                        }
                        ?>
                        <a class="btn btn-white" href="https://api.whatsapp.com/send/?phone=<?php echo $phone;?>&text=Sorry to cancel your order <?php echo $mo = sprintf("%08d", $order['id']); ?>.&app_absent=0" style="color:#2cb742" target="_blank">
                            
                            <?php if(!empty($branch['contact_person'])){ echo $branch['contact_person'];}else{ echo 'Whatsapp Customer';}?> 
                            <?php if(!empty($branch['mobile_number'])){ echo $phone;}?>
                            <img src="<?php echo ROOT?>images/whatsapp-16.png" style="position:relative; top:-1px; margin-left:6px;">
                        </a>

                        <form action="" method="post" enctype="multipart/form-data" class="d-inline">
                            <input type="hidden" name="oid" value="<?php echo $order['id']?>">
                            <input type="submit" name="cancel" value="CANCEL ORDER" class="btn btn-red">
                        </form>
                    </div>
                </div>    
            
            </div>
        </div>
            
    </div>
<?php 
}
?>


    <div class="pt-3 mt-5"></div>

 
    <iframe id="drivers_location" src="../drivers_location.php?i=<?php echo $_GET['i']?>" frameborder="0" height="300px" width="100%"></iframe>

    <?php 
    //$_GET['r'] = $defender->encrypt('encrypt', $order['region']);
    
    //include 'drivers_location.php?r='.$r;
    ?>

    <div class="pt-3 mt-5 text-center">------------- END -------------</div>

<body>
</html>

<script>
window.setInterval("reloadIFrame();", 20000);

function reloadIFrame() {
    document.getElementById('drivers_location').contentWindow.location.reload();
}
</script>


<?php include_once 'config/session_msg.php';?>

<style>
.card {
    border: 1px solid #ccc;
    box-shadow: 1px 1px 3px rgba(0,0,0,.2);
    padding:10px;
    display:inline-block;
    min-width: 200px;
    background-image: linear-gradient(#FFF, #EFEFEF, #CFCFEF);
}
.fwhite {
    border: 1px solid #ccc;
    background:#EFEFEF;
    padding: .375rem .75rem;
    font-size: 1rem;
    width:100px;
    border-radius: 6px;
}

</style>
