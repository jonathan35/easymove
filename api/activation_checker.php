<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api initial.');

if(!empty($_POST['uid'])){

    $uid = $_POST['uid'];
    $driver = sql_read("select id, status from driver where id=? limit 1", 'i', $uid);

    if($driver['status'] == 1){//Approved
        $result = array('result' => true, 'message' => $driver['id'].'Account approved.');
    }elseif($driver['status'] == 0){//Rejected
        $result = array('result' => false, 'message' => $driver['id'].'Account suspended.');
    }elseif($driver['status'] == 2){//Applying
        $result = array('result' => false, 'message' => $driver['id'].'Account pending for approval.');
    }

}else{
    $result = array('result' => false, 'message' => 'Not enough input.');
}

$data = json_encode($result);
echo $data;
?>
