<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'api/send_notification.php';

if(empty($_SESSION['auth_user']['id'])){
    header("Location: please_login");
}

include_once 'head.php';
?>

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

                                    <div class="col-12 col-md-8 offset-md-2">
                                        <h2><?php echo $_SESSION['auth_user']['branch_name']?></h2>
<?php 
$trips = sql_read("select * from trip where branch=? order by id asc", 'i', $_SESSION['auth_user']['branch']);
$balance = 0;

?>
<div style="margin: 20px 0; padding: 10px; background:#fff1cc; border-radius:20px; border:1px solid #edd698; box-shadow:1px 1px 2px rgba(0,0,0,.2)">
    <div style="border-bottom:1px solid orange; font-size:20px; color:orange">
        <img src="<?php echo ROOT?>images/ticker-32.png" style="margin-bottom:3px; opacity:0.8">
        Your Trip Packages
    </div>
    <table class="table table-sm table-white mb-1" >
        <tr style="border-top:none;">
            <th style="border-top:none;">Topup Date<th>
            <th style="border-top:none;">Trip<th>
            <th style="border-top:none;">Topup<th>
            <th style="border-top:none;">Used<th>
            <th style="border-top:none;">Balance<th>
        </tr>
        <?php 
        foreach($trips as $trip){
            $balance += $trip['trip_balance'];
            ?>
            <tr>
                <td><?php echo date_format(date_create($trip['created']), 'd-m-y')?><td>
                <td><?php echo $trip['trip_distance']?>KM<td>
                <td><?php echo $trip['topup_trip']?><td>
                <td><?php echo $trip['topup_trip']-$trip['trip_balance']?><td>
                <td><?php if(!empty($trip['trip_balance'])) echo $trip['trip_balance']; else echo '0';?><td>
            </tr>
        <?php }?>
    </table>
</div>

                                    </div>
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
