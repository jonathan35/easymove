<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';
require_once 'config/auth.php';

if(!empty($_GET['c'])){
    $loc_name = $str_convert->to_query($_GET['c']);
    $slocation = sql_read('select * from location where location like ? limit 1', 's', '%'.$loc_name.'%');
}


$locs = sql_read('select * from location where status= ?', 'i', 1);
foreach((array)$locs as $loc){
    $locations[$loc['id']] = $loc['location'];
}

?>
<!DOCTYPE html>
<head>
    <title>Easy Delivery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo ROOT?>images/icon.png">

    <script src="<?php echo ROOT?>js/jquery.min.js"></script>
    <script src="<?php echo ROOT?>js/popper.min.js"></script>
    <script src="<?php echo ROOT?>js/4.3.1/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.min.css">

    
    <script src="<?php echo ROOT?>js/animate.js"></script>
    <link rel="stylesheet" href="<?php echo ROOT?>css/animate.css">
    
    
    <link href="<?php echo ROOT?>css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer></script>
    
    <script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
            'sitekey' : '6LdPR5gUAAAAAObMmAHwsTGWbMNB4veEV1u4lTJU'
        });
    };
    </script>

    
</head>