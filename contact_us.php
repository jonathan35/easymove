<?php 
include_once 'head.php';

$content = sql_read("select * from content where id = ? limit 1", 'i', 1);




if(!empty($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
    if(empty($_POST['g-recaptcha-response'])){
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Please fill in captcha.</div>';
    }else{
        
        $to      = 'jonathan.wphp@gmail.com';
        $subject = 'Contact Us Enquiry';
        $headers[] = 'From: Easy Delivery Sdn. Bhd.';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$subject.'</title>
        </head>
        <body>
            Dear Staff,
            '.$_POST['name'].' sent a message to you from Easy Delivery. Please can login CMS to view or view below:<br><br>
            Company/Organisation: '.$_POST['company'].'<br><br>
            Name: '.$_POST['designation'].' '.$_POST['name'].'<br><br>
            Email: '.$_POST['email'].'<br><br>
            Contact: '.$_POST['contact'].'<br><br>
            Address: '.$_POST['address'].'<br><br>
            Message: '.$_POST['message'].'<br><br>
        </body>
        </html>';
        
        unset($_POST['submit'], $_POST['g-recaptcha-response']);
        $_POST['status'] = 'New';
        $_POST['date'] = date('Y-m-d H:i:s');
        if(sql_save('message_contact', $_POST)){

            $_SESSION['session_msg'] = '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
            style="position:relative; top:-2px;">×</a>
            Thank you for sent us the message, we will reply you through email soon.</div>';

            mail($to, $subject, $message, implode("\r\n", $headers));
        }
        
    }
}


?>



<html lang="en">
<body class="container-fluid p-0">
    
    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5 mt-4 mt-md-0">
  
            <div class="row">
                <div class="col-12 col-md-7 p-0">
                    <?php
                    $content['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $content['content']);                
                    echo $content['content'];?>
                </div>
                <div class="col-12 col-md-4 offset-md-1">

                    <div class="row"><div class="col-12"><br></div></div>
                    <div class="row">
                        <div class="col-12 p-2">
                            <h1>Contact Us</h1>
                        </div>
                    </div>
                    <form action="" class="form-group" method="post">
                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="text" name="company" placeholder="Company / Organisation" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <select name="designation" class="form-control">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mdm.">Mdm.</option>
                                    <option value="Dr.">Dr.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="text" name="name" placeholder="Name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="email" name="email" placeholder="Email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="text" name="address" placeholder="Address" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="text" name="contact" placeholder="Contact number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <textarea type="text" name="message" placeholder="Message" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-2">
                                <div id="recaptcha" title="no"></div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-12 p-2">
                                <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
                            </div>
                        </div>
                    </form>


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

