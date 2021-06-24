<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';

if(!empty($_SESSION['auth_user']['id'])){
    header("Location: home");
}

?>


<?php include_once 'head.php';?>

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
                            <div class="col-12 col-md-10 offset-md-1 text-center">
                                <h1>Please login to view that page. </h1>
                                <br><br>

                                <div class="btn btn-default" data-toggle="modal" data-target="#loginModal" style="border-radius: 20px; padding:10px 50px;">
                                    <img src="<?php echo ROOT?>images/login.svg" width="19px">&nbsp;
                                    LOGIN NOW
                                </div>
                                <br><br><br><br><br>
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


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            