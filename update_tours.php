<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';




$tours = sql_read('select * from tour');

foreach((array)$tours as $tour){
    $data['id'] = $tour['id'];
    $tour['full_description'] = str_replace('2016', '2021', $tour['full_description']);
    $data['full_description'] = $tour['full_description'];


    sql_save('tour', $data);
}

?>