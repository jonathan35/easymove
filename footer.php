
<div class="row" style="background:#353740;">



    <div class="col-12">
       <div class="row" style="background:#222;">
            <div class="col-12 col-md-12 text-muted text-center" style="padding:18px;">
                <?php echo date('Y')?>. Easy Delivery sdn. bhd. All rights reserved. Powered by Easymove & Quest Marketing.
            </div>
        </div>
        

        <div class="back-top-outter">    
            <div class="back-top-inner" onclick="scroll_top();">
            <i class="fa fa-angle-double-up" aria-hidden="true" style="opacity:.5;"></i>
            </div>
        </div>
        <script>
        function scroll_top(){
            var body = $("html, body");
            body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
        }
        </script>
        
    </div>

</div>


<?php include ROOT.'modal/login.php';?>
<?php include ROOT.'modal/forget_password.php';?>
<?php //include 'modal/edit_delivery_address.php';?>
<?php //include 'modal/edit_delivery_address2.php';?>
<?php //include 'modal/no_points_alert.php';?>
<?php //include 'modal/alert_modal.php'; ?>
<?php include_once ROOT.'config/session_msg.php';?>

<script src="<?php echo ROOT?>js/custom.js"></script>
<script src="<?php echo ROOT?>js/fewlines.js"></script>
<script src="<?php echo ROOT?>js/functions.jquery.js"></script>
<script src="<?php echo ROOT?>js/add_to_cart_button.js"></script>
