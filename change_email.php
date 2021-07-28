<?php 
include_once 'head.php';

$content = sql_read("select * from content where id = ? limit 1", 'i', 1);



if(!empty($_SESSION['auth_user']['id'])){

    if(!empty($_POST['save'])){


        $exist = sql_read("select id from merchant where username=? and id !=? limit 1", 'si', array($_POST['email'], $_SESSION['auth_user']['id']));

        if(!empty($exist['id'])){

            $_SESSION['session_msg'] = '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
                style="position:relative; top:-2px;">×</a>
                Email not available, please use other email.</div>';

        }else{
           
            $data['id'] = $_SESSION['auth_user']['id'];
            if(!empty($_POST['email'])){
                $data['username'] = $_POST['email'];
            }
            if(!empty($_POST['password'])){
                $data['password'] = hash('md5',$_POST['password']);
            }
            
            sql_save('merchant', $data);

            $_SESSION['session_msg'] = '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Save successfully.</div>';

        }
        
    }

}
?>


<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">


<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background: rgb(255,227,0); background: linear-gradient(180deg, rgba(0, 247, 152 , .3) 10%, rgba(245, 245, 245, 1) 18%);">

    <?php include 'header.php'?>
    
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">

            <div class="row p-4">
                <?php include ROOT.'back.php';?>

                <div class="row">

                    <div class="col-12 col-md-10 offset-md-2">
                        <h1>Email & Password</h1>
                        <div class="pb-4">
                        Change your account's email & password.
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 offset-md-2">                        
                        
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="post" enctype="multipart/form-data" class="form-pink-shadow">
                                  
                            
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            Email
                                            <input name="email" type="email" class="form-group" autocomplete="off">
                                        </div>
                                        <div class="col-12">
                                            Password
                                            <input name="password" type="password" class="form-group"  autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                                            <div class="password_text_toggle" for="#password_register"></div>
                                            <div class="text-muted" style="font-size:12px; top:-14px; position:relative;">
                                            Must contain number, uppercase, one lowercase & minimum 6 characters.
                                            </div>
                                        </div>
                                                                     
                                        <div class="col-12 pt-3">
                                            <button type="submit" name="save" value="save" class="btn btn-block p-3 btn-default">
                                                <i class="fas fa-user pr-2"></i>
                                                <span class="center-word">SAVE</span>
                                            </button>
                                        </div>
                                        
                                    </div>
                        
                                </form>
                            </div>

                        </div>                        
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <h3 class="pt-4">Tips</h3>
                     
                        <div style="">
                            1. You can change both/either email & password.<br>
                            2. To change email only, leave password empty.<br>
                            3. To change password only, leave email empty.<br>
                            <br><br>                            
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
   
    <div class="row">
        <div class="col-12 pt-5">
            <?php include 'footer.php';?>
        </div>
    </div>



</body>
</html>


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            