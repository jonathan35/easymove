<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api started.');


if(!empty($_POST['uid'])){

    $result = array('result' => false, 'message' => 'No commissions');
    $uid = $_POST['uid'];
    $filter_cond = "";
    $total = 0;

    if(!empty($_POST['year']) && !empty($_POST['month'])){
        $filter_cond = " and created like '".sprintf("%02d", $_POST['year']).'-'.sprintf("%02d", $_POST['month'])."-%'";
    }

    $commissions = sql_read("select order_id, commission, created from commission where driver=? and commission !='' $filter_cond order by id desc", 'i', $uid);
    //$commissions = sql_read("select * from commission order by id desc");
    
    foreach($commissions as $k => $v){
        $total += $v['commission'];
        $commissions[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
        $commissions[$k]['sid'] = sprintf("%08d", $v['order_id']);
    }
    
    $result = array('result' => true, 'message' => 'Get commissions successfully', 'commissions' => $commissions, 'total' => $total);
    
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = json_encode($result);
echo $data;
?>
