<?php 
require_once '../config/ini.php';

$driver_id = $_POST['uid'];
$withdraw_merit = $_POST['withdraw_merit'];

$result = array('result' => false, 'message' => 'Api started.');
$gains = $loses = array();

if(!empty($driver_id)){

    $data['driver'] = $driver_id;
    $data['status'] = 0;
    if(!empty($driver_id)){ $data['withdraw'] = $withdraw_merit; }
    sql_save('withdraw_request', $data);
    $result = array('result' => true, 'message' => 'Request sent successfully.');
    
}else{
    $result = array('result' => false, 'message' => 'No driver or order id.');
}
$data = json_encode($result);
echo $data;
?>
