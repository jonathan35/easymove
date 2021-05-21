<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Application not submitted.');

if(!empty($_POST['region']) || !empty($_POST['type']) || !empty($_POST['name']) || !empty($_POST['time']) || !empty($_POST['mobile']) || !empty($_POST['emergency']) || !empty($_POST['plate']) || !empty($_POST['owner']) || !empty($_POST['username']) || !empty($_POST['password'])){

    $data['region'] = $_POST['region'];
    $data['vehicle_type'] = $_POST['type'];
    $data['name'] = $_POST['name'];
    $data['working_time'] = $_POST['time'];
    $data['mobile_number'] = $_POST['mobile'];
    $data['emergency_contact_number'] = $_POST['emergency'];
    $data['plate_number'] = $_POST['plate'];
    $data['vehicle_belonging'] = $_POST['owner'];
    $data['merit'] = 100;
    $data['username'] = $_POST['username'];
    $data['password'] = hash('md5',urldecode($_POST['password']));

    $validate_username = sql_read("select username from driver WHERE username=? limit 1", 's', array($data['username']));

    if(!empty($validate_username['username'])){
        $result = array('result' => false, 'message' => 'Username taken, please use other username.');
    }else{
        sql_save("driver", $data);
        $result = array('result' => true, 'message' => 'Apply successfully, we will contact you for approval process.');


        //----- Email notify - Start ----------------------
        //$to      = 'jonathan.wphp@gmail.com';
        $subject = 'New Driver Application';
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
            '.$data['name'].' ('.$data['username'].') apply a driver account from Easy Delivery App. Please login CMS to view the application:<br><br>
        </body>
        </html>';
        
        $targets = sql_read("select email from email_notification where notify1 =? and email !=''" ,'s', 'Yes');
        foreach($targets as $target){
            $to = $target['email'];
            mail($to, $subject, $message, implode("\r\n", $headers));
        }
        
        //----- Email notify - End ----------------------

    }
}else{
    $result = array('result' => false, 'message' => 'Not enough input.');
}

echo '{"application":'.json_encode(array_merge($result, $_POST)).'}';
?>
