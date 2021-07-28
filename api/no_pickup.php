<?php 
require_once '../config/ini.php';
require_once 'send_notification.php';

$result = false;
$note = 'no pick';
$rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 13);
$dateline = date('Y-m-d H:i:s', (strtotime(date('Y-m-d H:i:s')) - ($rule['rule1'] * 60)));


if(!empty($rule['rule1']) && !empty($rule['point'])){

    $orders = sql_read("select id, driver, created, time from orders where created like ? and driver is not null and accepted_datetime < ? and collected_datetime is null ", 'ss', array(date('Y-m-d').' %', $dateline));

    foreach($orders as $order){

        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order['id'], $note));

        if(empty($exist['id'])){

            //Update Driver's Merit Statement --------------
            $statement = array();
            $statement['driver'] = $order['driver'];
            $statement['order_id'] = $order['id'];
            $statement['note'] = $note;
            $statement['points'] = '-'.$rule['point'];
            sql_save('merit', $statement);
            
            //Update Driver's Merit Balance --------------
            $driver['merit'] = $driver['merit'] - $rule['point'];
            sql_save('driver', $driver);
            $result = true;

            sendNotification(
                $order['driver'],
                'No Pickup',
                'Demerit due to no pickup for '.sprintf("%08d", $order['id']).'!'                
            );

        }
    }

   
}

print_r($result);


?>