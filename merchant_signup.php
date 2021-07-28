<?php 
include_once 'head.php';

$content = sql_read("select * from content where id = ? limit 1", 'i', 1);




if($_POST['action'] == 'signup'){
    
    $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Failed to submit, please try again later.</div>';

    if(empty($_POST['g-recaptcha-response'])){
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Please fill in captcha.</div>';
    }else{
        
        //$to      = 'jonathan.wphp@gmail.com';
        $subject = 'Merchant Application';
        $headers[] = 'From: Easy Delivery Sdn. Bhd.';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Merchant Application</title>
        </head>
        <body>
            Dear Staff,
            '.$_POST['company_name'].' sent a message to you from website merchant application form. Please find application details in CMS.<br><br>
            Company Name: '.$_POST['company_name'].'<br><br>
            Business Field: '.$_POST['business_field'].'<br><br>
            Email: '.$_POST['email'].'<br><br>
            Mobile Number: '.$_POST['mobile_number'].'<br><br>
            Region: '.$_POST['region'].'<br><br>
            Zone: '.$_POST['zone'].'<br><br>
            Address: '.$_POST['address'].'<br><br>
        </body>
        </html>';
        
        unset($_POST['submit'], $_POST['g-recaptcha-response'], $_POST['action'], $_POST['tc']);
      
        $_POST['status'] = 'New';
        $_POST['date'] = date('Y-m-d H:i:s');

        $_POST['region'] = $defender->encrypt('decrypt',$_POST['region']);
        $_POST['zone'] = $defender->encrypt('decrypt',$_POST['zone']);
        

        if(sql_save('message_contact', $_POST)){

            $_SESSION['session_msg'] = '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
            style="position:relative; top:-2px;">×</a>
            Thank you for your application, we will contact you soon.</div>';
            
            $targets = sql_read("select email from email_notification where notify2 =? and email !=''" ,'s', 'Yes');
            foreach((array)$targets as $target){
                $to = $target['email'];
                mail($to, $subject, $message, implode("\r\n", $headers));
            }
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
                        <h1>Application</h1>
                        <div class="pb-4">
                        Apply a merchant account to get our delivery services.
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 offset-md-2">                        
                        
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="post" enctype="multipart/form-data" class="form-pink-shadow">
                                  
                            
                                    <div class="row">
                                        <div class="col-12">
                                            Company Name
                                            <input name="company_name" type="text" class="form-group" required>
                                        </div>
                                        <div class="col-12">
                                            Email
                                            <input name="email" type="email" class="form-group" required>
                                        </div>
                                        <div class="col-12">
                                            Business Field
                                            <input name="business_field" type="text" class="form-group" required>
                                        </div>
                                        
                                        <!--
                                        <div class="col-12">
                                            Email
                                            <input name="email" type="email" class="form-group" required>
                                        </div>-->
                                        <div class="col-12">
                                            Mobile Number (MY)
                                            <div class="row">
                                                <div class="col-2" style="padding-right:0;">
                                                    <div style="padding:7px 0; width:100%; height:36px; border-radius:10px; background:#555; color:white; text-align:center; ">+6</div>
                                                </div>
                                                <div class="col-10" style="padding-left:6px;">
                                                    <input name="mobile_number" type="number" class="form-group" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <?php $regions = sql_read('SELECT * FROM region WHERE status=? ORDER BY position ASC, region ASC', 's', 1);?>           
                                            Region
                                            <select name="region" class="form-group parent-filter-child" required>
                                                <option value="">Select Region</option>
                                                <?php foreach((array)$regions as $reg){?>
                                                    <option value="<?php echo $defender->encrypt('encrypt',$reg['id'])?>"><?php echo $reg['region']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        
                                        <?php $zones = sql_read('SELECT * FROM zone WHERE status=? ORDER BY position ASC, zone ASC', 's', 1);?>
                                        <div class="col-12">
                                            Zone
                                            <select name="zone" class="form-group" required>
                                                <option value="">Select Zone</option>
                                                <?php foreach((array)$zones as $zone){?>
                                                    <option value="<?php echo $defender->encrypt('encrypt',$zone['id'])?>" parent-name="region" parent-value="<?php echo $defender->encrypt('encrypt',$zone['region'])?>"><?php echo $zone['zone']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            Company Address
                                            <textarea name="address" class="form-group" required></textarea>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div id="recaptcha" title="no"></div>
                                        </div>

                                        <div class="col-12 pt-3" style="align-items: start; display:flex;">
                                            <input type="checkbox" id="tc" name="tc" value="tc" required >
                                            <label for="tc" style="font-size:14px; width:calc(100% - 40px); padding: 8px; margin-top:-12px;">I agree to the <a href="page?i=NG1NYnNKckw4QzRhOGhkT0M5NXNMUT09" target="_blank">Privacy Policy</a>, <a><a href="page?i=eEdKY0RXYW8zR3pUZCt4OUVvVi9vUT09" target="_blank">Terms and Conditions</a>. </label>
                                        </div>
                                    
                                        <div class="col-12">
                                            <input type="hidden" name="action" value="signup">
                                            <button type="submit" name="submit" value="apply" class="btn btn-block p-3 btn-default">
                                                <i class="fas fa-user pr-2"></i>
                                                <span class="center-word">SUBMIT APPLICATION</span>
                                            </button>
                                        </div>
                                        
                                    </div>
                        
                                </form>
                            </div>

                        </div>                        
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <?php /*<img src="<?php echo ROOT?>images/vectorfair061829.jpg" class="img-fluid"><br><br>*/?>
                       
                        <h3 class="pt-4">Become our Merchant</h3>
                     
                        <div style="">
                            
                            1. Submit Application Form.<br>
                            2. Easy Delivery contact you.<br>
                            3. Approve/Reject your application.<br>
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
            