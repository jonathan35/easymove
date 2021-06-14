<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api started.');


if(!empty($_POST['uid'])){

    $result = array('result' => false, 'message' => 'No orders');
    $uid = $_POST['uid'];
    $filter_cond = "";

    if(!empty($_POST['year']) && !empty($_POST['month'])){
        $filter_cond = " and created like '".sprintf("%02d", $_POST['year']).'-'.sprintf("%02d", $_POST['month'])."-%'";
    }

    $orders = sql_read("select id, distance, created, status from orders where driver=? and status=? $filter_cond order by id desc", 'is', array($uid, 'Delivered'));

    foreach($orders as $k => $v){
        $orders[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
        $orders[$k]['sid'] = sprintf("%08d", $v['id']);
    }

    $result = array('result' => true, 'message' => 'Get orders successfully', 'orders' => $orders, 'count' => count($orders));
    
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = json_encode($result);
echo $data;
?>
