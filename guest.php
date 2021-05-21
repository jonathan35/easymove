<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';


?>


<html lang="en">
<body class="container-fluid p-0 wave" style="background-position: 0 200px;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5" style="min-height:calc(100vh - 150px)">
            <form action="<?php echo ROOT?>checkout" method="post">
                <div class="row">


                    <div class="col-12 p-0">
                        <div class="tour_list">
                            <div class="row">
                                <div class="col-9"><h1>Your Guest</h1></div>
                                <div class="col-3 text-right pt-3">
                                    <a href="<?php echo ROOT?>cart"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Cart</a>
                                </div>
                            </div>
                            <?php 
                            $n = 1;
                            foreach((array)$items as $item){
                                $enc_item_id = $defender->encrypt('encrypt', $item['id']);
                                ?>
                                <div class="row mb-5 p-0">
                                    <div class="col-12 mb-2" style="font-size:140%; background:#333;">
                                        <a href="<?php echo ROOT?>tour_details/<?php echo $str_convert->to_url($item['name'])?>" style="color:#CCC;"><?php echo $item['name']?></a>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <table class="guest">
                                            <tr>
                                                <td class="text-muted">Date:</td>
                                                <td class=""><?php echo date('M d, Y', strtotime($item['date']))?></td>
                                            </tr>
                                            <tr>
                                                <td class=" text-muted">Unit Price:</td>
                                                <td class=""><?php echo 'RM'.number_format($item['unit_price'],2,'.',',')?></td>
                                            </tr>
                                            <tr>
                                                <td class=" text-muted">Total Price:</td>
                                                <td class=""><?php echo 'RM'.number_format($item['total_price'],2,'.',',')?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <?php 
                                        $gs = sql_read('select * from guest where item_id=? and session=? order by id asc', 'is', array($item['id'], session_id()));

                                        foreach((array)$gs as $g){
                                            $guests[$g['item_id']][] = $g;
                                        }
                                                                        
                                        for($g=0; $g<$item['quantity']; $g++){?>
                                            <table class="guest pt-3" style="border-bottom:1px solid #CCC;">
                                                <tr>
                                                    <td class="pt-4" width="10"><?php echo $n?></td>
                                                    <td>
                                                        <div class="row pb-3">
                                                            <div class="col-12 col-md-6 pt-2">
                                                                <input type="hidden" name="item[]" value="<?php echo $enc_item_id?>">
                                                                <input name="first_name<?php echo $enc_item_id?>" type="text" value="<?php echo $guests[$item['id']][$g]['first_name']?>" class="form-control" placeholder="First Name" required>
                                                            </div>
                                                            <div class="col-12 col-md-6 pt-2">
                                                                <input name="last_name<?php echo $enc_item_id?>" type="text" value="<?php echo $guests[$item['id']][$g]['last_name']?>" class="form-control" placeholder="Last Name" required>
                                                            </div>
                                                            <div class="col-12 pt-2">
                                                                <input name="ic<?php echo $enc_item_id?>" type="text" value="<?php echo $guests[$item['id']][$g]['ic']?>" class="form-control" placeholder="IC number / Work Permit / MM2H Pass / Others relevant document(s) / number(s)" required>
                                                            </div>
                                                            <?php /*
                                                            <div class="col-12 pt-2">
                                                                <label>
                                                                    <input name="sarawakian<?php echo $enc_item_id?>" type="checkbox" class="form-control d-inline" style="width:20px;" <?php if($guests[$item['id']][$g]['sarawakian'] == 'on'){?>checked<?php }?>>
                                                                    <span style="position:relative; top:-14px;">
                                                                    Sarawakian (50% rebate)
                                                                    </span>
                                                                </label>
                                                            </div>*/?>
                                                            
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                        <?php }?>
                                    </div>
                                </div>
                            <?php 
                            $n++;
                            }?>
                        
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
                                <input type="submit" class="form-control btn btn-lg btn-success pb-4 pt-2" value="Save Guests">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>


</body>
</html>
