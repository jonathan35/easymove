<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
//include_once 'head.php';
//


?>

<html lang="en">
<body class="container-fluid p-0 wave" style="background-position: 0 200px;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5" style="min-height:calc(100vh - 150px)">

            <div class="row">
                <h1>Your Order</h1>        
            </div>

            <div class="row">


                <div class="col-12 col-md-9 p-0">
                    <div class="tour_list">
                        
                        <table class="cart">
                            <tr>
                                <th class="text-left">Tour Package</th>
                                <th class="d-none d-md-table-cell">Guest Qty.</th>
                                <th class="d-none d-md-table-cell">Unit Price</th>
                                <th class="text-right d-none d-md-table-cell">Total Price</th>
                            </tr>

                            <?php foreach((array)$items as $item){?>
                                <tr>
                                    <td>
                                        <div class="row d-flex">
                                            <div class="col-12 col-md-3">
                                                <img src="<?php echo ROOT.$item['photo']?>" class="img-fluid">
                                            </div>
                                            <div class="col-12 pl-3 pr-3 pt-0 p-md-0 col-md-9">
                                                <div style="font-size:140%;">
                                                <a href="<?php echo ROOT?>tour_details/<?php echo $str_convert->to_url($item['name'])?>" style="color:#555;"><?php echo $item['name']?></a>
                                                </div>
                                                <div>
                                                    <span class="text-muted">Date:</span>
                                                    <?php echo $item['date']?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 d-md-none pt-3 pb-3">
                                                        <div>
                                                            <?php echo 'Guest Qty.:'.$item['quantity'].' person(s)'?>
                                                        </div>
                                                        <div>
                                                            <?php echo 'Unit Price: RM'.number_format($item['unit_price'],2,'.',',')?>
                                                        </div>
                                                        <div>
                                                            <?php echo 'Total Price: RM'.number_format($item['total_price'],2,'.',',')?>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="col-6 p-0 text-left pl-3">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="tour" value="<?php echo $defender->encrypt('encrypt', $item['id'])?>">
                                                            <input type="submit" name="remove" class="btn btn-sm btn-danger pt-0 pb-0" value="Remove" >
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </td>
                                    <td class="text-center d-none d-md-table-cell">
                                        <?php echo $item['quantity']?>
                                    </td>
                                    <td class="text-center d-none d-md-table-cell">
                                        <?php echo $item['unit_price']?>
                                    </td>
                                    <td class="text-right d-none d-md-table-cell">
                                        <?php echo $item['total_price']?>
                                    </td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>


                <div class="col-12 col-md-3 pl-md-5 pt-3 pt-md-0">
                    
                    <div class="row" style="overflow:hidden; background-color:#de7e00; color:white;">
                        <h4 class="col-12 text-white pt-2 pb-2 text-center" style="background-color: var(--main); box-shadow:0 2px 4px rgba(0,0,0,.2)">Summary</h4>
                        <div class="col-12 p-2 pt-4 pb-4">
                            <table class="col-12 text-right p-3" style="color:white;">
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
                            <a href="<?php echo ROOT?>guest">
                            <input type="submit" class="form-control btn btn-lg btn-success pb-4 pt-2" value="Confirm">
                            </a>
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
