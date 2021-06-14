<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api started.');


if(!empty($_POST['uid'])){

    $result = array('result' => false, 'message' => 'No merit');
    $uid = $_POST['uid'];
    $filter_cond = "";

    if(!empty($_POST['year']) && !empty($_POST['month'])){
        $filter_cond = " and created like '".sprintf("%02d", $_POST['year']).'-'.sprintf("%02d", $_POST['month'])."-%'";
    }

    $merits = sql_read("select points, note, order_id, created from merit where driver=? $filter_cond order by id desc", 'i', $uid);
    $merit = sql_read("select merit from driver where id=? limit 1", 'i', $uid);
    
    foreach($merits as $k => $v){
        $merits[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
        $merits[$k]['sid'] = sprintf("%08d", $v['order_id']);
        $merits[$k]['note'] = ucwords($v['note']);
    }
    
    $result = array('result' => true, 'message' => 'Get merit successfully', 'merits' => $merits, 'merit' => $merit['merit']);
    
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = json_encode($result);
echo $data;
?>
