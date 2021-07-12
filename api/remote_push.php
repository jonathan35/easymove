<?php 
if(empty($DB)){
    require_once '../config/ini.php';
}


if($title && $body && $driver_id){

    $driver = sql_read('select push_token from driver where id=? limit 1', 'i', $driver_id);
    //$driver['push_token'] = 'ExponentPushToken[TT1n5_MWlZqy_thPbmbccG]';
    if($driver['push_token']){
         
        ?>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script>
        $(document).ready(function(){
            $("#remote_box").load('https://mingmingtravel.com/easyapi/api/send_notification.php?i=<?php echo urlencode($driver['push_token'])?>&t=<?php echo urlencode($title)?>&b=<?php echo urlencode($body)?>');   
        });
        </script>

        <div id="remote_box" style="display:none;"></div>

<?php }}?>