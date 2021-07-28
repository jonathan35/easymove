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
    $on_exist = sql_read("select id, start_time from driver_on_off where driver=? and date=? and end_time is null order by id desc limit 1", 'is', array($uid, $today));
    if(!empty($on_exist['id'])){
        $ongoing = $now - $on_exist['start_time'];
    }

    $total = $closed + $ongoing;

    return $total;//.' closed: '.$closed.' ongoing: '.$ongoing.' uid: '.$uid;
}


function nodeCloseSession(){

    global $now, $conn, $today;
    $nodes = sql_read("select id, node_time, start_time from driver_on_off where node_time is not null and end_time is null");

    foreach($nodes as $node) {
        $data['id'] = $node['id'];
        $data['end_time'] = $node['node_time'];
        $data['duration'] = $data['end_time'] - $node['start_time'];
        $data['note'] = 'nodeCloseSession';

        sql_save('driver_on_off', $data);
    }
}




function offSession($uid){

    global $now, $today;

    $on_record = sql_read("select * from driver_on_off where driver=? and date=? and end_time is null and start_time !='' order by id desc limit 1", 'is', array($uid, $today));

    if(!empty($on_record['id'])){
        $data['id'] = $on_record['id'];
        $data['end_time'] = $now;
        $data['duration'] = $now - $on_record['start_time'];

        $data['note'] = 'offSession';

        sql_save('driver_on_off', $data);


    }
}




function onSession($uid){

    global $now, $today;

    $data['start_time'] = $now;
    $data['driver'] = $uid;
    $data['date'] = $today;
    sql_save('driver_on_off', $data);

}



function removeShortSession(){
 //Delete sessions with less than 60sec duration
 sql_exec("delete from driver_on_off where duration <?", 'i', array(60));
}


if(!empty($_POST['uid']) && !empty($_POST['onoff'])){


    $uid = $_POST['uid'];

    if($_POST['onoff'] == 'on'){

        $on_exist = sql_read("select id, start_time, node_time from driver_on_off where 
            driver=? and 
            date=? and 
            end_time is null 
        order by id desc limit 1", 'is', array($uid, $today));
        $node_gap = $on_exist['node_time']+300;//expired after 300sec/5m
        
        if(!empty($on_exist['id'])){//Session started before
            
            if(empty($on_exist['node_time']) || $node_gap >= $now){//Update node

                $node_update['id'] = $on_exist['id'];
                $node_update['node_time'] = $now;
                $node_update['note'] = 'Update session node'.$node_gap.'<'.$now;
                sql_save('driver_on_off', $node_update);
            
            }elseif($node_gap < $now){//Reset node

                nodeCloseSession($uid);
                onSession($uid);
                removeShortSession();
            }
        }else{//Start pure new session
            onSession($uid);
        }

        

            //$last['id'] = $on_exist['id'];
            // $last['note'] = 'xxxx'.$on_exist['id'];
            //sql_save('driver_on_off', $last);

        $result = array(
            'result' => 'started', 
            'message' => 'On successfully.',
            'duration' => getTodayDuration($uid)
        );


    }elseif($_POST['onoff'] == 'off'){

        offSession($uid);
        removeShortSession();

        $result = array(
            'result' => 'ended', 
            'message' => 'Off successfully.',
            'duration' => getTodayDuration($uid)
        );

    }

}else{
    $result = array('result' => false, 'message' => 'Not enough input.');
}

$data = json_encode($result);
echo $data;
?>
