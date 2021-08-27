<?php 
require_once '../config/ini.php';

$driver = array();
$result = array('result' => false, 'message' => 'Api started.');



if(!empty($_POST['uid'])){

    $result = array('result' => false, 'message' => 'No order');
    $uid = $_POST['uid'];
    
    //Use region instead of nearby 10km
    $driver = sql_read("select region from driver where id=? limit 1", 'i', $uid);


    if(empty($driver['region'])){

        $result = array('result' => true, 'message' => 'Driver no region.');

    }else{
        
        $sql = " select id, distance as dis, created as date, assign, requirement, status from orders where (assign is null or assign=? or assign = '0') and region=? and created like ? and ";//WHERE
        $order = " order by id desc";//distance asc, created desc

        //-- Vehicle ----------------
        $vehicle_types = array();
        $vts = sql_read('select id, vehicle_type from vehicle_type');
        foreach($vts as $vt) $vehicle_types[$vt['id']] = $vt['vehicle_type'];
        
        $news = sql_read("$sql status = ? and driver is null $order", 'iiss', array($uid, $driver['region'], date('Y-m-').'%', 'Ordered'));
        
        $delivers = sql_read("$sql driver=? and (status=? OR status=? OR status=?) $order", 'iisisss', array($uid, $driver['region'], date('Y-m-').'%', $uid, 'Accepted', 'Collected', 'Delivering'));
        
        $delivereds = sql_read("$sql (driver is null or driver=?) and status=? $order", 'iisis', array($uid, $driver['region'], date('Y-m-').'%', $uid, 'Delivered'));

        //$new_count = $del_count = $his_count = 0;

        foreach($news as $k => $v){
            $news[$k]['sid'] = sprintf("%08d", $v['id']);
            $news[$k]['date'] = date_format(date_create($v['date']), 'd-m-y, g:ia');
            $news[$k]['type'] = $vehicle_types[$v['requirement']];
            //$new_count++;
        }
        foreach($delivers as $k => $v){
            $delivers[$k]['sid'] = sprintf("%08d", $v['id']);
            $delivers[$k]['date'] = date_format(date_create($v['date']), 'd-m-y, g:ia');
            $delivers[$k]['type'] = $vehicle_types[$v['requirement']];
            //$del_count++;
        }
        foreach($delivereds as $k => $v){
            $delivereds[$k]['sid'] = sprintf("%08d", $v['id']);
            $del_count[$k]['date'] = date_format(date_create($v['date']), 'd-m-y, g:ia');
            $del_count[$k]['type'] = $vehicle_types[$v['requirement']];
            //$his_count++;
        }

        $n= '';
        
        $orders = array(
            'new_count' => count($news),
            'del_count' => count($delivers),
            'his_count' => count($delivereds),
            'news' => $news,
            'delivers' => $delivers,
            'delivereds' => $delivereds
        );
        $result = array('result' => true, 'message' => 'Orders loaded successfully.', 'orders' => $orders);
    }
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = '{"driver_orders":'.json_encode($result).'}';

echo $data;
?>
