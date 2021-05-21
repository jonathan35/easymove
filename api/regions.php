<?php 
require_once '../config/ini.php';

$regions = sql_read("select id, region from region where status=? order by region asc", 'i', array(1));
$data = array('options' => $regions);
$data = json_encode($data);
$data = str_replace(array('id', 'region'), array('value', 'label'), $data);
echo $data;
?>