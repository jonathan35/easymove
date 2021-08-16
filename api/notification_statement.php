<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api started.');


if(!empty($_POST['uid'])){

    $result = array('result' => false, 'message' => 'No notifications');
    $uid = $_POST['uid'];
    $filter_cond = "";

    if(!empty($_POST['year']) && !empty($_POST['month'])){
        $filter_cond = " and created like '".sprintf("%02d", $_POST['year']).'-'.sprintf("%02d", $_POST['month'])."-%'";
    }

    $notifications = sql_read("select * from app_notification where driver=? $filter_cond order by id desc", 'i', $uid);
    
    foreach($notifications as $k => $v){
        $notifications[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
    }
    
    $result = array('result' => true, 'message' => 'Get notifications successfully', 'notifications' => $notifications);
    
}else{
    $result = array('result' => false, 'message' => 'No driver id.');
}

$data = json_encode($result);
echo $data;
?>
