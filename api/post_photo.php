<?php 
require_once '../config/ini.php';


$msg = 'Started but not upload & save.';


function upload_file($file){

	$target = basename($file['name']);
	$type = pathinfo($target, PATHINFO_EXTENSION);
	$is_img = getimagesize($file['tmp_name']);
	
	if($is_img){
		$destination = 'images/'.date('Ymd-His').uniqid().'.'.$type;
		move_uploaded_file($file['tmp_name'], $destination);
	}else{
		$destination = 'type: '.$type.' target: '.$target.'file: '.json_encode($file);
	}
	return $destination;
}


if($_FILES){

	if(!empty($_POST['username'])){//Applying driver account
	
		$driver = sql_read('select id from driver where username = ? order by id desc limit 1', 's', $_POST['username']);

		if(!empty($driver['id'])){
			$info['id'] = $driver['id'];

			if($_FILES['ic']){
				$info['photo_of_ic'] = upload_file($_FILES['ic']);
			}
			if($_FILES['license']){
				$info['photo_of_driving_license'] = upload_file($_FILES['license']);
			}
			if($_FILES['front']){
				$info['vehicle_front_view'] = upload_file($_FILES['front']);
			}
			if($_FILES['back']){
				$info['vehicle_back_view'] = upload_file($_FILES['back']);
			}

			sql_save('driver', $info);
			$msg = 'Uploaded & Saved';

		}
	}elseif(!empty($_FILES['pod']) && !empty($_POST['oid'])){//Proof of delivery
		
		$info['id'] = $_POST['oid'];
		$info['proof_of_delivery'] = upload_file($_FILES['pod']);
		sql_save('orders', $info);
		$msg = 'Uploaded & Saved';
		
	}
}


header('Access-Control-Allow-Origin: *');
header('Content-type:application/json');
echo '{"message":'.$msg.'}';
?>
