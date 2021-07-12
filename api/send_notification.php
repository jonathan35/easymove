<?php 
/*
This page need to be install in mingmingtravel.com/easyapi/api/, because expo server only accept https request
Flow to be: A (http) --> B (https) --> Expo --> Google Firebase --> Phone Notification

if(!empty($_GET['i'])){ $token = $_GET['i'];}else{$token = 'ExponentPushToken[ouHslCDPEokBuNyk0LMT8x]';}
if(!empty($_GET['t'])){ $title = $_GET['t'];}else{$title = 'DEFAULT TITLE ('.$_SERVER['SERVER_NAME'].')';}
if(!empty($_GET['b'])){ $body = $_GET['b'];}else{$body = 'DEFAULT CONTENT';}

if($token && $title && $body){

    if($token){
        //echo $token;

        header('Host: exp.host');
        header('Accept: application/json');
        header('Accept-encoding: gzip, deflate');
        header('Content-type:application/json');
        
        $post = ['to' => $token, 'title' => $title, 'body'   => $body];

        $ch = curl_init('https://exp.host/--/api/v2/push/send');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
    }        
}

header('Content-type:text/html');*/
?>


<?php 

if(empty($DB)){
    require_once '../config/ini.php';
}



function sendNotification($driver_id, $title, $body){
    
    if($title && $body){

        $driver = sql_read('select push_token from driver where id=? limit 1', 'i', $driver_id);

        if($driver['push_token']){

            header('Host: exp.host');
            header('Accept: application/json');
            header('Accept-encoding: gzip, deflate');
            header('Content-type:application/json');

            
            $post = ['to' => $driver['push_token'], 'title' => $title, 'body'   => $body];

            $ch = curl_init('https://exp.host/--/api/v2/push/send');

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);
        }        
    }
    
    header('Content-type:text/html');

}


?>