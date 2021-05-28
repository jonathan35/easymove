<?php 

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