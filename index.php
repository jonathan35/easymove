<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';


?>

<html lang="en">
<body class="container-fluid p-0" style="background:#EFEfEf;">

    <?php include 'header.php'?>
    
    <div class="row">
        <div class="col-12 text-center">
            <?php include 'banner.php'?>
        </div>
    </div>

    
    <?php include 'search.php'?>        
   
    <?php /*
    <div class="row">
        <div class="col-12 text-center bg-dark" style="padding:100px 0;">
            <div class="line-btn">Order Now</div>
        </div>
    </div>*/?>

    <div class="row">
        <div class="col-10 offset-1 pb-4 pt-3">
            <div class="row">
            <!--
                <div class="cat-trigger d-sm-none" onclick="$('.category-panel-outter').fadeToggle();"><i class="fa fa-search" aria-hidden="true"></i></div>

                $('.category-panel-outter').toggleClass('category-active');-->
      
                <div class="col-12 p-0">
                    <div>
                        <?php include 'home_news.php';?>
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
