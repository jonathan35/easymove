<?php
include_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'cart_function.php';
require_once 'head.php';

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

if($_GET['i']){
    $oid = $defender->encrypt('decrypt',$_GET['i']);
    $order = sql_read('select * from orders where id=? limit 1', 's', $oid);
    $branch = sql_read("select * from branch where id=? limit 1", 'i', array($order['branch']));
    $region = sql_read("select * from region where id=? limit 1", 'i', array($order['region']));
    $zone = sql_read("select * from zone where id=? limit 1", 'i', array($order['zone']));

}

if(!$auth){

    if($_GET['s'] == 1){
        echo '
        <h4 class="text-center pt-5 mt-5">Authentication Blocked</h4>
        <div class="text-center pt-3">
            Please <a href="'.A_ROOT.'cms">login</a> to view
        </div>';        
    }else{
        include 'member_login.php';
    }

}else{

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


    <div class="container mt-2 mb-3" style="border:1px solid #CCC; box-shadow:1px 0 3px rgba(0,0,0,.3);">
       
        <div class="row content">

            <div class="col-12 col-md-4 header-content">
                <img src="<?php echo ROOT?>images/logo.jpg" class="img-fluid mt-2">
                
                <div class="title">ORDER</div>
                <div class="text-label2 pr-2">ORDER</div>
                <div class="pb-3"><?php echo $mo = sprintf("%06d", $order['id']); ?></div>   

                <div class="text-label2 pr-2">STATUS</div>
                <div class="pb-3"><?php echo $order['status'];?></div> 

                <div class="text-label2 pr-2">DATE</div>
                <div class="pb-3"><?php echo date('d/m/Y', strtotime($order['modified']));?></div>
                
                
                <div class="title">DRIVER</div>

                <div class="text-label2 pr-2">DRIVER</div>
                <div class="pb-3"><?php echo $order['driver_name'];?></div>
                
                <div class="text-label2 pr-2">PHONE</div>
                <div class="pb-3"><?php echo $order['driver_phone'];?></div>

                <div class="text-label2 pr-2">DESTANCE</div>
                <div class="pb-3"><?php echo $order['distance'];?>KM</div>


            </div>

            <div class="col-12 col-md-4">
    
                <div class="title">FROM</div>
              
                <div class="text-label pr-2" width="170px;">COMPANY</div>
                <div class="pb-3"><?php echo $branch['branch_name'];?></div>
            
                <div class="text-label pr-2">CONTACT PERSON</div>
                <div class="pb-3"><?php echo $branch['contact_person'];?></div>
            
                <div class="text-label pr-2">PHONE</div>
                <div class="pb-3"><?php echo $branch['mobile_number'];?></div>
            
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
                <div class="pb-3"><?php echo date('h:ia', strtotime($order['time']));?></div>
                                
                <div class="text-label pr-2">MESSAGE</div>
                <div class="pb-3"><?php echo $order['message'];?></div>
                                
                <div class="text-label pr-2">REQUIREMENT</div>
                <div class="pb-3"><?php echo $order['requirement'];?></div>
                    

                </table>
            </div>
            


        </div>


    </div>
<?php }
}?>


<body>
</html>

<?php include_once 'config/session_msg.php';?>