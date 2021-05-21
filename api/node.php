<?php 
require_once '../config/ini.php';


$result = array('result' => false, 'message' => 'Api initial.');
$today = date('Y-m-d');
$now = time();//time() is in second not millisecond





function getTodayDuration($uid){    
    //Today's total online duration
    global $now, $conn, $today;

    $total = $closed = $ongoing = 0;

    //----------Duration for all Closed Session------------------
    $today_qry = mysqli_query($conn, "select SUM(duration) as total_duration from driver_on_off where driver=$uid and date='".date('Y-m-d')."'");
    $today_onoff = mysqli_fetch_assoc($today_qry);

    if(!empty($today_onoff['total_duration'])){
        $closed += $today_onoff['total_duration'];
    }

    //----------Duration for Unclosed/Last/Current/Ongoing Session------------------
    $on_existed = sql_read("select id, start_time from driver_on_off where driver=? and date=? and end_time is null order by id desc limit 1", 'is', array($uid, $today));
    if(!empty($on_existed['id'])){
        $ongoing = $now - $on_existed['start_time'];
    }

    $total = $closed + $ongoing;

    return $total;//.' closed: '.$closed.' ongoing: '.$ongoing.' uid: '.$uid;
}



if(!empty($_POST['uid']) && !empty($_POST['onoff'])){

    $uid = $_POST['uid'];

    if($_POST['onoff'] == 'on'){

        $on_existed = sql_read("select id, start_time from driver_on_off where driver=? and date=? and end_time is null order by id desc limit 1", 'is', array($uid, $today));

        if(empty($on_existed['id'])){
            $start_time = $now;
            $data['start_time'] = $now;
            $data['driver'] = $uid;
            $data['date'] = $today;
            sql_save('driver_on_off', $data);
        }

        $result = array(
            'result' => 'started', 
            'message' => 'On successfully.',
            'duration' => getTodayDuration($uid)
        );

    }elseif($_POST['onoff'] == 'off'){

        $on_record = sql_read("select * from driver_on_off where driver=? and date=? and end_time is null and start_time !='' order by id desc limit 1", 'is', array($uid, $today));

        if(!empty($on_record['id'])){
            $data['id'] = $on_record['id'];
            $data['end_time'] = $now;
            $data['duration'] = $now - $on_record['start_time'];

            sql_save('driver_on_off', $data);

            //Delete sessions with less than 60sec duration
            sql_exec("delete from driver_on_off where duration <?", 'i', array(60));

            $result = array(
                'result' => 'ended', 
                'message' => 'Off successfully.',
                'duration' => getTodayDuration($uid)
            );
        }
        
    }


}else{
    $result = array('result' => false, 'message' => 'Not enough input.');
}

$data = json_encode($result);
echo $data;
?>
