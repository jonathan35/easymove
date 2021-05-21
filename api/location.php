<?php 
require_once '../config/ini.php';
require 'merit_component.php';

$driver_id = $_POST['uid'];
$location = $_POST['location'];
$result = array('result' => false, 'message' => 'Api started.');


if(!empty($driver_id) && !empty($location)){

    $data['id'] = $driver_id;
    $data['location'] = $location;
    $data['location_time'] = time();
    sql_save('driver', $data);
    
    $result = array('result' => true, 'message' => 'Location inserted');
}else{
    $result = array('result' => false, 'message' => 'Not enough input.');
}

$data = json_encode($result);
echo $data;
?>
