<?php 
require_once '../config/ini.php';
$result = 0;

if(!empty($_POST['uid']) && !empty($_POST['token'])){

    $data['id'] = $_POST['uid'];
    $data['push_token'] = $_POST['token'];
    sql_save('driver', $data);
    $result = 1;
}
echo $result;
?>