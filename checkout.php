<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
require_once 'cart_function.php';


if($_POST){
    foreach((array)$_POST['item'] as $enc_item_id){

        $item_id = $defender->encrypt('decrypt', $enc_item_id);
        $exist_guest = sql_read('select id from guest where item_id=? limit 1', 'i', $item_id);
     
        if(!empty($exist_guest['id'])) $guest_data['id'] = $exist_guest['id'];
        $guest_data['session'] = session_id();
        $guest_data['item_id'] = $item_id;
        $guest_data['first_name'] = $_POST['first_name'.$enc_item_id];
        $guest_data['last_name'] = $_POST['last_name'.$enc_item_id];
        $guest_data['ic'] = $_POST['ic'.$enc_item_id];
        $guest_data['sarawakian'] = 'off';
        

        if(!empty($_POST['sarawakian'.$enc_item_id])){

            $guest_data['sarawakian'] = $_POST['sarawakian'.$enc_item_id];
            
            $sarawakian_rate = 0.5;
            $item_data = sql_read('select * from items where id=? limit 1', 'i', $item_id);

            $item_data['sarawakian_unit_price'] = $item_data['unit_price'] * $sarawakian_rate;
            $item_data['sarawakian_total_price'] = $item_data['total_price'] * $sarawakian_rate;
            sql_save('items', $item_data);
        }
        sql_save('guest', $guest_data);
    }



    $order_exist = sql_read('select * from orders where session=? limit 1', 's', session_id());
    if($order_exist['id']){
        $order_data['id'] = $order_exist['id'];
    }
    $order_data['session'] = session_id();
    $items = sql_read("select * from items where session=?", 's', session_id());
    $order_data['total'] = str_replace(',','', item_total());
    $order_data['status'] = 'Ordering';
    $order_data['pid'] = 'PID'.strtoupper(uniqid());

    sql_save('orders', $order_data);
    $order = sql_read('select * from orders where session=? limit 1', 's', session_id());
 
}

$items = sql_read("select * from items where session=?", 's', session_id());

?>


<html lang="en">
<body class="container-fluid p-0 wave" style="background-position: 0 200px;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5" style="min-height:calc(100vh - 150px)">
            
            <div class="row">
                <div class="col-12 p-0">
                    <div class="tour_list">
                        <div class="row">
                            <div class="col-12 col-md-9"><h1>Checkout</h1></div>
                            <div class="col-12 col-md-3 text-right pt-3">
                                <a href="<?php echo ROOT?>cart"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Cart</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo ROOT?>guest"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Guest</a>
                            </div>
                        </div>
                        <?php foreach((array)$items as $item){?>
                            <div class="row mb-5 p-0">
                                <div class="checkout-head col-12">
                                    <a href="<?php echo ROOT?>tour_details/<?php echo $str_convert->to_url($item['name'])?>"><?php echo $item['name']?></a>
                                </div>

                                <div class="col-12 col-md-8">
                                    <table class="checkout">
                                    <?php 
                                    $guests = sql_read("select * from guest where item_id=? and session=?", 'is', array($item['id'], session_id()));
                                    $g = 1;
                                    foreach((array)$guests as $guest){?>
                                        <tr>
                                            <td width="10">
                                                <div class="label">No.</div><?php echo $g?>
                                            </td>
                                            <td>
                                                <div class="label">First Name</div>
                                                <?php echo $guest['first_name']?>
                                            </td>
                                            <td>
                                                <div class="label">Last Name</div>
                                                <?php echo $guest['last_name']?>
                                            </td>
                                            <td>
                                                <div class="label">IC / Passport / Permit, etc</div>
                                                <?php echo $guest['ic']?>
                                            </td>
                                            <td>
                                                <div class="label">Sarawakian</div>
                                                <?php echo $guest['sarawakian']?>
                                            </td>
                                        </tr>
                                    
                                    <?php 
                                    $g++;
                                    }?>
                                    </table>
                                </div>


                                <div class="col-12 col-md-4">
                                    
                                    <table class="checkout" style="width:100%;">
                                        <tr>
                                            <td>
                                                <div class="label">Date</div>
                                                <?php echo date('M d, Y', strtotime($item['date']))?>
                                            </td>
                                            <td>
                                                <div class="label">Qty.</div>
                                                <?php echo $item['quantity']?>
                                            </td>

                                            <td>
                                                <div class="label">Unit Price</div>
                                                <?php 
                                                if($item['sarawakian_unit_price']>0){
                                                    echo '<div style="text-decoration: line-through;">RM'.number_format($item['unit_price'],2,'.',',').'</div><div>RM'.number_format($item['sarawakian_unit_price'],2,'.',',').'</div>';;
                                                }else{
                                                    echo '<div>RM'.number_format($item['unit_price'],2,'.',',').'</div>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="label">Total Price</div>
                                                <?php 
                                                if($item['sarawakian_total_price']>0){
                                                    echo '<div style="text-decoration: line-through;">RM'.number_format($item['total_price'],2,'.',',').'</div><div>RM'.number_format($item['sarawakian_total_price'],2,'.',',').'</div>';;
                                                }else{
                                                    echo '<div>RM'.number_format($item['total_price'],2,'.',',').'</div>';
                                                }
                                                ?>
                                            </td>
                                        </tr>



                                    </table>
                                </div>

                            </div>
                        <?php }?>
                    
                    </div>
                </div>

        

                <div class="col-12 col-md-3 offset-md-9">
                    
                    <div class="row">
                        
                        <div class="col-12 p-2 pt-4 pb-4" >
                            <table class="col-12 text-right p-3">
                                <tr>
                                    <td>Sub Total:</td>
                                <td><b>RM <?php echo $item_total;?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-bottom:1px dashed #999;"></td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td><b>RM <?php echo $item_total;?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-0">
                            <?php include 'payment_paypal.php';?>

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
