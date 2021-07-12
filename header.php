<div class="row">

    <div class="col-12 p-0" id="header" style="position:fixed; z-index:100; background:#ffa800;
            width:100%; left:0; box-shadow:2px 2px 10px rgba(0,0,0,.2);">

        <div class="row">
            <div class="col-10 p-0 offset-1">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 pl-0 pr-0 d-flex justify-content-between">
                                <div class="col-9 col-md-12 p-1 text-left">
                                    <a href="<?php echo A_ROOT?>home">
                                        <img src="<?php echo ROOT?>images/logo.jpg" class="img-fluid d-inline">
                                    </a>
                                </div>
                                <div class="col-3 p-2 pt-3 text-right">
                                    <button class="d-inline d-md-none navbar-toggler menu-toggler" type="button" onclick="$('#mainMenu').slideToggle();">
                                        <span class="navbar-toggler-icon">
                                            <i class="fas fa-bars burger-menu"></i>
                                        </span>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse d-md-inline col-md-7" id="mainMenu">
                        <div class="row">


                            <?php if($_SESSION['auth_user']){?>
                            <div class="col-12 pt-2 pb-4 text-center">
                        

                                <div class="btn btn-signup account-menu-trigger float-right" style="border-radius: 20px 20px 20px 20px;">
                                    <img src="<?php echo ROOT?>images/user.svg" width="16px">&nbsp;
                                    <?php 
                                    echo substr($_SESSION['auth_user']['username'],0,29);
                                    if(strlen($_SESSION['auth_user']['username'])>29) echo '..';
                                    ?>&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-chevron-down" aria-hidden="true" style="font-size:70%;"></i>


                                    <div id="account-menu" style="z-index:3;">
                                        <div class="account-menu-block">
                                        
                                            <a href="<?php echo ROOT?>order.php"><div>Order Delivery</div></a>
                                            <a href="<?php echo ROOT?>orders"><div>History Orders</div></a>
                                            <a href="<?php echo ROOT?>staff"><div>Create Account</div></a>
                                            <a href="<?php echo ROOT?>staff_list"><div>List Accounts</div></a>
                                            <a href="<?php echo ROOT?>trip"><div>Trip</div></a>
                                            <br>
                                            <a href="<?php echo ROOT?>signout"><div>Sign Out</div></a>
                                        </div>
                                    </div>
                                


                                </div>

                            </div>
                            <?php }else{?>
                            <div class="col-12 pt-2 pb-4 text-center text-md-right">
                                <a href="<?php echo ROOT?>signup"><div class="btn btn-signup <?php if(strpos($_SERVER['PHP_SELF'], 'merchant_signup.php')) echo 'btn-signup-visited';?>" style="border-radius: 20px 0 0 20px;">
                                    <img src="<?php echo ROOT?>images/user.svg" width="16px">&nbsp;
                                    Sign Up
                                </div></a><div class="btn btn-signup" data-toggle="modal" data-target="#loginModal" style="border-radius: 0 20px 20px 0; border-left:0;">
                                    <img src="<?php echo ROOT?>images/login.svg" width="19px">&nbsp;
                                    Sign In
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-9 p-0">
                                <div class="d-md-inline col-12 p-0">

                                    <?php 
                                    $locs = sql_read('select * from location where status =1 order by position asc, id desc');
                                    $pages = sql_read('select * from pages where status =1 order by position asc, id desc');

                                    $menu_items = array();
                                    $menu_width = $menu_str = '';
                            
                                    $menu_items[] = 'Delivery Goods';
                                    $menu_items[] = 'Announcement';
                                    foreach((array)$pages as $p){
                                        $menu_items[] = $p['title'];
                                    }
                                    foreach((array)$menu_items as $a => $b){$menu_items[$a] .= $b.'...........................................';}
                                    foreach((array)$menu_items as $item){$menu_str .= $item;}
                                    $each_char_percent = 100/strlen($menu_str);

                                    foreach((array)$menu_items as $item_str){
                                        $menu_width .= round(strlen($item_str)*$each_char_percent,2,PHP_ROUND_HALF_DOWN).'% ';
                                    }                                        
                                    ?>

                                    <div class="text-center text-black navigator" style="grid-template-columns: <?php echo $menu_width?>;" style="font-size:14px !important;">
                    
                                        <script>
                                        $('.hd-menu').hover(function(){
                                            var i = $(this).attr('child');
                                            $('#smenu'+i).fadeToggle();
                                        })
                                        </script>
                                        <a href="<?php echo ROOT?>order" style="color:#333;">
                                        <div class="col-12 col-md p-1 hd-menu <?php if(strpos($_SERVER['PHP_SELF'], '/order.php')) echo 'active-hd-menu';?>">
                                        Order Delivery
                                        </div></a>

                                        <a href="<?php echo ROOT?>news" style="color:#333;">
                                        <div class="col-12 col-md p-1 hd-menu <?php if(strpos($_SERVER['PHP_SELF'], '/news.php')) echo 'active-hd-menu';?>">
                                        Announcement
                                        </div></a>
                                        
                                        <!--
                                        <a href="<?php echo ROOT?>contact_us" style="color:#333;">
                                        <div class="col-12 col-md p-1 hd-menu <?php if(strpos($_SERVER['PHP_SELF'], '/contact_us.php')) echo 'active-hd-menu';?>">
                                            Contact Us
                                        </div></a>-->
                                        
                                        <?php 
                                        foreach((array)$pages as $page){?>
                                        <a href="<?php echo ROOT?>page/<?php echo $str_convert->to_eye($page['title'])?>" style="color:#333;">
                                        <div class="col-12 col-md p-1 hd-menu <?php if($_GET['t'] == $page['title']) echo 'active-hd-menu';?>">
                                            <?php echo $page['title']?>
                                        </div></a>
                                        <?php }?>

                                                    
                                    </div>
                                </div>
                            </div>


                            <div class="d-none d-md-inline col-3 text-right">

                                <a href="https://www.facebook.com/easymove2u/" target="_blank">
                                    <img src="<?php echo ROOT?>images/facebook-f.svg" width="14px" style="margin-left:20px">
                                </a>
                                <a href="https://wa.me/60168653947" target="_blank">
                                    <img src="<?php echo ROOT?>images/whatsapp.svg" width="20px" style="margin-left:20px">
                                </a>
                                <a href="" target="_blank">
                                <img src="<?php echo ROOT?>images/instagram.svg" width="20px" style="margin-left:20px">
                                </a>
                            </div>

                        </div>

                   

                    </div>


                    
                </div>
                
            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-12 header-spacer" style="height:144px;"><br></div>    
</div>

<style>
@media (max-width: 576px) { 
#mainMenu {
    border-top: 1px solid rgba(255,255,255,.4); padding-top:10px;
}
}
</style>


<script>
$(document).ready(function(){
    reheight();
});
$(window).resize(function() {
    reheight();
});
function reheight(){
    var h = $('#header').height();
    h += 0;
    $('.header-spacer').css('height', h+'px');
}


$('.account-menu-trigger').click(function(){
    $('#account-menu').fadeIn();//.delay(2000)
})


$(function() {
  $("body").click(function(e) {

    var btn = $(e.target).attr("class");

    if (e.target.id == "account-menu" || $(e.target).parents("#account-menu").length || btn == 'btn btn-signup account-menu-trigger float-right') {
      //alert("Inside div");
    } else {
        $('#account-menu').fadeOut(1);
    }
  });
})

</script>
