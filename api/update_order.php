<?php 
require_once '../config/ini.php';
require 'merit_component.php';

$driver_id = $_POST['uid'];
$order_id = $_POST['oid'];


$result = array('result' => false, 'message' => 'Api started.');
$gains = $loses = array();

if(!empty($order_id) && !empty($_POST['action'])){

    $order = sql_read('select id, collected_datetime, time from orders where id=? limit 1', 'i', $order_id);

    $deadline = 'expired';

    if($_POST['action'] == 'accept'){

        $data['status'] = 'Accepted';
        $data['accepted_datetime'] = date('Y-m-d H:i:s');
        $deadline = getFastPickDeadline($order['id']);

    }elseif($_POST['action'] == 'collect'){//wating client permit on qr scan component.

        $data['status'] = 'Collected';
        $data['collected_datetime'] = date('Y-m-d H:i:s');

    }elseif($_POST['action'] == 'pod'){
        
        $gains['pick'] = fastCollect($driver_id, $order['id'], strtotime($order['collected_datetime']));
        $gains['delivery'] = fastDelivery($driver_id, $order['id'], time());
        $gains['season'] = season($driver_id, $order['id'], time());
        $gains['slow_pick'] = slowCollect($driver_id, $order['id'], strtotime($order['collected_datetime']));
        $gains['slow_delivery'] = slowDelivery($driver_id, $order['id'], time());

        $data['status'] = 'Delivered';
        $data['delivered_datetime'] = date('Y-m-d H:i:s');
    }

    $data['id'] = $order_id;
    $data['driver'] =$driver_id;
    
    sql_save('orders', $data);
    
    $result = array('result' => true, 'message' => 'Accepted', 'deadline' => $deadline);

}else{
    $result = array('result' => false, 'message' => 'No driver or order id.');
}

$data = json_encode($result);
echo $data;
?>
