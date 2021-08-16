<?php 
require_once '../config/ini.php';
require 'fastpick_deadline.php';




$result = array('result' => false, 'message' => 'Api started.');

/* 
if(!empty($_GET['oid'])){
    $_POST['oid'] = $_GET['oid'];
}
*/

if(!empty($_POST['oid'])){

    $result = array('result' => false, 'message' => 'No order');
    $oid = $_POST['oid'];

    $order = sql_read("select id, zone, branch_name, customer_name, phone, origin, destination,origin_coordinate as o_coor, destination_coordinate as d_coor, distance, address, time, message, requirement, status, proof_of_delivery as pod, accepted_datetime as accepted, collected_datetime as collected, delivered_datetime as delivery, created , report , decline, assign, time_to_delivery from orders where id=? limit 1", 'i', $oid);
    

    if(empty($order['origin']) || empty($order['destination']) || empty($order['o_coor']) || empty($order['d_coor']) || empty($order['distance'])){

        $result = array('result' => false, 'message' => 'Geo data missing.');

    }else{

        $order['deadline'] = fastpick_deadline($order['id']);

        if(strtotime(substr($order['created'], 0, 10).' '.$order['time']) > strtotime($order['created'])){
            $order['scheduled'] = true;
        }else{
            $order['scheduled'] = false;
        }

        //$order['TimeVScreated'] = strtotime(substr($order['created'], 0, 10).' '.$order['time']) .'VS'. strtotime($order['created']);

        //-- Zone ----------------
        $zones = array();
        $zs = sql_read('select id, zone from zone');
        foreach($zs as $z) $zones[$z['id']] = $z['zone'];
        $order['zone'] = $zones[$order['zone']];

        //-- Vehicle ----------------
        $vehicle_types = array();
        $vts = sql_read('select id, vehicle_type from vehicle_type');
        foreach($vts as $vt) $vehicle_types[$vt['id']] = $vt['vehicle_type'];
        $order['requirement'] = $vehicle_types[$order['requirement']];
        

        $order['sid'] = sprintf("%08d", $order['id']);
        
        if(empty($order['created'])){
            $order['created'] = '-';
        }else{
            $order['created'] = date('d/m/y, h:ia', strtotime($order['created']));
        }
        if(empty($order['accepted'])){
            $order['accepted'] = '-';
        }else{
            $order['accepted'] = date('d/m/y, h:ia', strtotime($order['accepted']));
        }
        if(empty($order['collected'])){
            $order['collected'] = '-';
        }else{
            $order['collected'] = date('d/m/y, h:ia', strtotime($order['collected']));
        }
        if(empty($order['delivery'])){
            $order['delivery'] = '-';
        }else{
            $order['delivery'] = date('d/m/y, h:ia', strtotime($order['delivery']));
        }
        if(empty($order['time'])){
            $order['time'] = '-';
        }else{
            $order['time'] = date('h:ia', strtotime($order['time']));
        }
        if(empty($order['time_to_delivery'])){
            $order['time_to_delivery'] = '-';
        }else{
            $order['time_to_delivery'] = date('h:ia', strtotime($order['time_to_delivery']));
        }

        if(empty($order['zone'])) $order['zone'] = '-';
        if(empty($order['branch_name'])) $order['branch_name'] = '-';
        if(empty($order['customer_name'])) $order['customer_name'] = '-';
        if(empty($order['phone'])) $order['phone'] = '-';
        if(empty($order['address'])) $order['address'] = '-';
        
        if(empty($order['message'])) $order['message'] = '-';
        if(empty($order['requirement'])) $order['requirement'] = '-';
        if(empty($order['pod'])) $order['pod'] = '-';
        


        //------ MAP - Start ------------
        $o_coor = explode(',', $order['o_coor']);
        $d_coor = explode(',', $order['d_coor']);
        
        $order['o_lat'] = $o_coor[0];
        $order['o_lon'] = $o_coor[1];
        $order['d_lat'] = $d_coor[0];
        $order['d_lon'] = $d_coor[1];

        if($order['distance'] <= 5){            $order['diff'] = 0.05;
        }elseif($order['distance'] <= 10){      $order['diff'] = 0.12;
        }elseif($order['distance'] <= 20){      $order['diff'] = 0.3;
        }elseif($order['distance'] <= 30){      $order['diff'] = 0.49;
        }elseif($order['distance'] <= 40){      $order['diff'] = 0.66;
        }elseif($order['distance'] <= 60){      $order['diff'] = 0.8;
        }elseif($order['distance'] <= 70){      $order['diff'] = 1;
        }elseif($order['distance'] <= 100){     $order['diff'] = 2;
        }elseif($order['distance'] <= 500){     $order['diff'] = 3;
        }elseif($order['distance'] <= 1000){    $order['diff'] = 4;
        }else{                                  $order['diff'] = 5;
        }
        

        $y_diff = $d_coor[0] - $o_coor[0];
        $x_diff = $d_coor[1] - $o_coor[1];
        $order['c_lat'] = $o_coor[0] + ($y_diff/2);
        $order['c_lon'] = $o_coor[1] + ($x_diff/2);
        //------ MAP - End ------------


        $result = array('result' => true, 'message' => $_POST, 'order' => $order);
    }
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = json_encode($result);
echo $data;
?>
