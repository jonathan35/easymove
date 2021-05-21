<?php 
require_once '../config/ini.php';

$driver = array();
$result = array('result' => false, 'message' => 'Username or Password is empty.');

if(!empty($_POST['username']) && !empty($_POST['username'])){
    //$_POST['username'] = 'Q';
    //$_POST['password'] = 'admin';
    $username = ($_POST['username']);
    $password = hash('md5',urldecode($_POST['password']));
    $result = array('result' => false, 'message' => 'Wrong username or Password.');//. username:'.$username.' pass: '.$password

    $sqldriver = sql_read("select id, region, vehicle_type, name, working_time, mobile_number, emergency_contact_number, plate_number, branch_location_coordinate, vehicle_belonging, photo_of_ic, photo_of_driving_license, vehicle_front_view, vehicle_back_view, username, status, merit from driver WHERE status=? AND username=? AND (password=? OR temp_password=?) limit 1", 'isss', array(1, $username, $password, $password));

    if(!empty($sqldriver['username'])){
        $result = array('result' => true, 'message' => 'Login successfully.');
        $driver = $sqldriver;
    }
}

$data = array_merge($driver, $result);
$data = '{"auth_user":'.json_encode($data).'}';

echo $data;//{"auth_user":{"username":1,"password":"Motobyte"}}
?>
