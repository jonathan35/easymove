<?php 
require_once '../config/ini.php';
require 'merit_component.php';

$driver_id = $_POST['uid'];
$order_id = $_POST['oid'];


$result = array('result' => false, 'message' => 'Api started.');
$gains = $loses = array();


if(!empty($order_id) && !empty($_POST['action'])){

    $order = sql_read('select id, collected_datetime, time, distance from orders where id=? limit 1', 'i', $order_id);

    $deadline = 'expired';

    if($_POST['action'] == 'decline'){

        $data['assign'] = '';
        $data['decline'] = $driver_id;
        $data['decline_datetime'] = date('Y-m-d H:i:s');

    }elseif($_POST['action'] == 'report'){

        $data['report'] = 'no internet';
        $data['report_datetime'] = date('Y-m-d H:i:s');

        $unmerit = sql_exec('delete from merit where driver=? and order_id=? and (note=? or note=?)', 'iiss', array($driver_id, $order_id, 'slow pick', 'fast pick'));

    }elseif($_POST['action'] == 'accept'){

        $taken = sql_read('select id from orders where id=? limit 1', 'i', $driver_id);
        $deadline = getFastPickDeadline($order['id']);

        if(!empty($taken['id'])){
            $result = array('result' => false, 'message' => 'Taken', 'deadline' => $deadline);
        }else{
            $driver = sql_read('select driver, name, mobile_number from driver where id=? limit 1', 's', $driver_id);
            $data['driver_name'] = $driver['name'];
            $data['driver_phone'] = $driver['mobile_number'];
            $data['status'] = 'Accepted';
            $data['accepted_datetime'] = date('Y-m-d H:i:s');
            $data['id'] = $order_id;
            $data['driver'] =$driver_id;
            sql_save('orders', $data);
            $result = array('result' => true, 'message' => 'Accepted', 'deadline' => $deadline);
        }

        

    }elseif($_POST['action'] == 'collect'){//wating client permit on qr scan component.

        $data['status'] = 'Collected';
        $data['collected_datetime'] = date('Y-m-d H:i:s');
        $data['id'] = $order_id;
        $data['driver'] =$driver_id;
        sql_save('orders', $data);
        $result = array('result' => true, 'message' => 'Collected', 'deadline' => $deadline);

    }elseif($_POST['action'] == 'pod'){

        $gains['peak'] = peakCollect($driver_id, $order['id'], strtotime($order['collected_datetime']));        
        $gains['delivery'] = fastDelivery($driver_id, $order['id'], time());
        $gains['season'] = season($driver_id, $order['id'], time());

        if($order['report'] != 'no internet'){
            $gains['pick'] = fastCollect($driver_id, $order['id'], strtotime($order['collected_datetime']));
            $gains['slow_pick'] = slowCollect($driver_id, $order['id'], strtotime($order['collected_datetime']));
        }

        $gains['slow_delivery'] = slowDelivery($driver_id, $order['id'], time());  

        standardMeritChecker($driver_id);

        $data['status'] = 'Delivered';
        $data['delivered_datetime'] = date('Y-m-d H:i:s');


        //------- Create Commission - Start ----------- 
        $standard_commission = sql_read("select commission from basic_commission where commission !='' and max_distance >= ? order by commission asc limit 1", 's', $order['distance']);
 
        if(!empty($standard_commission['commission'])){
            
            //------- Bonus - Start -----------
            $driver = sql_read('select merit from driver where id=? limit 1', 's', $driver_id);
            $bonus_rules = sql_read("select commission from bonus where min_point <=? and max_distance >= ? order by min_point desc, max_distance asc limit 1", 'ss', array($driver['merit'], $order['distance']));
            if(!empty($bonus_rules['commission'])){
                $commission['bonus'] = $bonus_rules['commission'];
            }
            //------- Bonus - End -----------

            $commission['commission'] = $standard_commission['commission'];
            $commission['driver'] = $driver_id;
            $commission['order_id'] = $order['id'];
            sql_save('commission', $commission);
        }

        $data['id'] = $order_id;
        $data['driver'] =$driver_id;
        sql_save('orders', $data);
        $result = array('result' => true, 'message' => 'POD', 'deadline' => $deadline);
        //------- Create Commission - End -----------

    }

    
    
    


}else{
    $result = array('result' => false, 'message' => 'No driver or order id.');
}
$data = json_encode($result);
echo $data;
?>
