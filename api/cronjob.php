<?php 
require_once '../config/ini.php';
require_once 'send_notification.php';


/*
This page must be call at 11.59pm/23.59. which is last minutes before next day.

1 daily delivery
2 monthly delivered
8 Attendance reward
14 Minimum Hour Weekly
*/

/*
$test['message'] = date('Y-m-d H:i:s');
sql_save('test', $test);
*/

$drivers = sql_read('select id from driver where status=?', 'i', 1);


foreach($drivers as $driver){
    
    //echo $driver['id'].'<br>';
    //  59 * * * * function here not working


    if(date('H') == '23' && date('i') == '59'){///check is last minute of the day
        dailyDelivery($driver['id'], date('Y-m-d'));//check every day
    }
    if(date('Y-m-d') == date('Y-m-t')){//Is last day of a month
        monthlyDelivery($driver['id'], date('Y-m-'));
    }
    if(date('H') == '23' && date('i') == '59'){///check is last minute of the day
        attendanceReward($driver['id']);
    }
    if(strtolower(date("l", strtotime(date('Y-m-d')))) == "sunday"){//Is a sunday
        minimumWeekly($driver['id']);
    }
}



function dailyDelivery($driver_id, $date){

    $note = 'daily delivery';
    
    $exist = sql_read("select id from merit where driver =? and note=? and created like '".$date."%' limit 1", 'is', array($driver_id, $note));

    if(empty($exist['id'])){

        $order = sql_read("select count(id) as total_order from orders where driver=? and delivered_datetime like '".$date."%' limit 1", 'i', array($driver_id));
        $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 1);

        if($order['total_order'] >= $rule['rule1']){

            //Update Driver's Merit Statement --------------
            $statement = array();
            $statement['driver'] = $driver_id;
            $statement['note'] = $note;
            $statement['points'] = $rule['point'];
            sql_save('merit', $statement);
            
            //Update Driver's Merit Balance --------------
            $driver['merit'] = $driver['merit'] + $rule['point'];
            sql_save('driver', $driver);
            
            sendNotification(
                $driver_id,
                'Daily Delivery',
                'Merit gain from daily delivery!'                
            );

        }
    }
}





function monthlyDelivery($driver_id, $date){

    $note = 'monthly delivery';
    
    $exist = sql_read("select id from merit where driver =? and note=? and created like '".$date."%' limit 1", 'is', array($driver_id, $note));

    if(empty($exist['id'])){

        $order = sql_read("select count(id) as total_order from orders where driver=? and delivered_datetime like '".$date."%' limit 1", 'i', array($driver_id));
        $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 2);

        if($order['total_order'] >= $rule['rule1']){

            //Update Driver's Merit Statement --------------
            $statement = array();
            $statement['driver'] = $driver_id;
            $statement['note'] = $note;
            $statement['points'] = $rule['point'];
            sql_save('merit', $statement);
            
            //Update Driver's Merit Balance --------------
            $driver['merit'] = $driver['merit'] + $rule['point'];
            sql_save('driver', $driver);
            
            sendNotification(
                $driver_id,
                'Monthly Delivery',
                'Merit gain from monthly delivery!'
            );

        }
        
    }
}



function attendanceReward($driver_id){

    $note = 'attendance reward';    
    $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 8);
    $dateline = date('Y-m-d', strtotime('-'.$rule['rule1'].' days', strtotime(date('Y-m-d'))));
    $exist = sql_read("select id from merit where driver =? and note=? and created > '".$dateline."%' limit 1", 'is', array($driver_id, $note));

    if(empty($exist['id'])){//no update within standard range
        
        $valid_count = 0;
        $minimum_online = $rule['rule2'] * 60 * 60;//hour to minutes to second, no need milisecond
        
        for($d=0; $d<$rule['rule1']; $d++){
            if($d==0){
                $date = date('Y-m-d');
            }else{
                $date = date('Y-m-d', strtotime('-'.$d.' days', strtotime(date('Y-m-d'))));
            }

            $online = sql_read("select SUM(duration) as total_duration from driver_on_off where driver=? and date=? limit 1", 'is', array($driver_id, $date));
            
            if($online['total_duration'] >= $minimum_online){
                $valid_count++;
            }
            $result = '('.$date.' '.$online['total_duration'] .'>='. $minimum_online.'vc:'.$valid_count.')';
        }
        

        if(!empty($rule['rule1']) && $valid_count == $rule['rule1']){

            //Update Driver's Merit Statement --------------
            $statement = array();
            $statement['driver'] = $driver_id;
            $statement['note'] = $note;
            $statement['points'] = $rule['point'];
            sql_save('merit', $statement);
            
            //Update Driver's Merit Balance --------------
            $driver['merit'] = $driver['merit'] + $rule['point'];
            sql_save('driver', $driver);
            
            sendNotification(
                $driver_id,
                'Attendance reward',
                'Merit gain from Attendance reward!'
            );

        }
    }
    return $result;
}



function minimumWeekly($driver_id){

    $result = '';
    $note = 'minimum weekly';    
    $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 14);
    $dateline = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
    $exist = sql_read("select id from merit where driver =? and note=? and created > '".$dateline."%' limit 1", 'is', array($driver_id, $note));
    $minimum_online = $rule['rule1'] * 60 * 60;//hour to minutes to second, no need milisecond

    if(empty($exist['id'])){//not been updated within 1 week

        $online = sql_read("select SUM(duration) as total_duration from driver_on_off where driver=? and date >? limit 1", 'is', array($driver_id, $dateline));
        
        if($online['total_duration'] < $minimum_online){
            //Update Driver's Merit Statement --------------
            $statement = array();
            $statement['driver'] = $driver_id;
            $statement['note'] = $note;
            $statement['points'] = '-'.$rule['point'];
            sql_save('merit', $statement);

            //Update Driver's Merit Balance --------------
            $driver['merit'] = $driver['merit'] - $rule['point'];
            sql_save('driver', $driver);

            sendNotification(
                $driver_id,
                'Minimum Online Weekly',
                'You have been demerit due to short online duration!'
            );

        }
        
    
    }
    return $result;

}

?>