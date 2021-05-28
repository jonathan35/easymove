<?php 
require_once '../config/ini.php';


if(!empty($_POST['uid']) && !empty($_POST['token'])){

    $data['id'] = $_POST['uid'];
    $data['push_token'] = $_POST['token'];
    sql_save('driver', $data);
}
?>