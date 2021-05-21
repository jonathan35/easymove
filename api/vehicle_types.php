<?php 
require_once '../config/ini.php';

$vehicle_types = sql_read("select id, vehicle_type from vehicle_type where status=? order by vehicle_type asc", 'i', array(1));
$data = array('options' => $vehicle_types);
$data = json_encode($data);
$data = str_replace(array('id', 'vehicle_type'), array('value', 'label'), $data);
echo $data;
?>