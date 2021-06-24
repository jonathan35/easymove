<?php 
session_start();
session_regenerate_id();
require_once 'config/ini.php';
include_once 'head.php';
?>


<html lang="en">
<body class="container-fluid p-0 wave" style="background-position: 0 200px;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5" style="min-height:calc(100vh - 150px)">
            
            <?php 
            $gateway = sql_read('select * from payment_gateway where id=1 limit 1');
            $payment_return = false;
            $payment_msg = 'Transaction Failed';
            $payment_num = '-';
            $payment_amt = '0.00';

            if($gateway['para1'] == 'eghl'){
                if($_POST['TxnMessage'] == 'Transaction Successful'){
                    $payment_return = true;
                    $payment_msg = $_POST['TxnMessage'];
                }
                $pid  = $_POST['PaymentID'];
            }elseif($gateway['para1'] == 'paypal'){
                if($_GET['tx'] == 'success'){
                    $payment_return = true;
                    $payment_msg = 'Transaction Successful';
                }
                $pid  = $defender->encrypt('decrypt', $_GET['p']);
            }else{
                echo 'No payment option available.';
            }


            $order = sql_read('select * from orders where pid=? limit 1', 's',$pid);


            if($order['id']){
                if($payment_return){
                    $data['id'] = $order['id'];
                    $data['payment_date'] = date('Y-m-d H:i:s');
                    $data['payment_status'] = 'Paid';
                    $data['status'] = 'Confirmed';
                    
                    sql_save('orders', $data);
               
                    $payment_num = sprintf("%08d", $order['id']);
                    $payment_amt = number_format(0+$order['total'],2,'.',',');

                }
                
                echo "<div class=\"no_show\"></div><script>$(document).ready(function(){ $('.no_show').load('regen_session_id.php');})</script>";
            }
            ?>
            
            <div class="d-block d-sm-none"><br><br><br></div>


            <div class="d-flex align-items-center mt-xs-5 pt-5" style=" justify-content: center;">
                <?php if($payment_return){?>
                    <h1 style="padding-left:14px; color: green;">Thank you for your payment</h1>
                <?php }else{?>
                    <h1 style="padding-left:14px; color:orange;">No payment, please try again.</h1>
                <?php }?>
            </div>
            <div class="d-flex pt-3" style="justify-content: center; font-size:14px;">
                <div>
                    <div>Payment Status: <?php echo $payment_msg;?></div>
                    <div>Order ID: <?php echo $payment_num;?></div>
                    <div>Order Amount: RM<?php echo $payment_amt;?></div>

                    <div class="pt-5">
                        <?php /*if(!empty($data['id'])){?>
                        <div class="pt-2"><a href="the_order/<?php echo $defender->encrypt('encrypt', $data['id'])?>" target="_blank">VIEW RECEIPT</a></div>
                        <?php }*/?>
                        <div class="pt-2"><a href="home" target="_blank">CONTINUE SHOPPING</a></div>                        
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



