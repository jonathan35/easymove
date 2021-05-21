<?php 
require_once '../config/ini.php';

$result = array('message' => 'Api initial.', 'duration' => 0 );

if(!empty($_POST['uid'])){
   
    $uid = $_POST['uid'];
    $today_qry = mysqli_query($conn, "select SUM(duration) as total_duration from driver_on_off where driver=$uid and date='".date('Y-m-d')."'");
    $today = mysqli_fetch_assoc($today_qry);
    $closed_duration += $today['total_duration'];
    
    $result = array(
        'message' => 'Get duration successfully.', 
        'duration' => $closed_duration
    );

}else{
    $result = array('message' => 'Not enough input.', 'duration' => 0);
}

$data = json_encode($result);
echo $data;
?>
