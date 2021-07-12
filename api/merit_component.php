<?php 
require_once '../config/ini.php';
require_once 'send_notification.php';



function peakCollect($driver_id, $order_id, $perform_time){
    
    $result = false;
    $note = 'peak pick';
    
    $driver = sql_read('select id, merit, working_time from driver where id=? limit 1', 'i', $driver_id);
    
    if($driver['working_time'] == 'full'){

        if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
            
            $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
        
            if(empty($exist['id'])){
                $order = sql_read('select distance, created, time from orders where id=? limit 1', 'i', $order_id);
                $rule = sql_read('select point from merit_setup where id=? limit 1', 'i', 4);
 
                if(!empty($rule['point'])){
                    
                    $midnoon = strtotime(date('Y-m-d 12:00:00'));
                    $earlynoon = strtotime(date('Y-m-d 14:00:00'));
                    $mideve = strtotime(date('Y-m-d 17:00:00'));
                    $earlyeve = strtotime(date('Y-m-d 19:00:00'));
            
                    if(($perform_time>=$midnoon && $perform_time<=$earlynoon) || ($perform_time>=$mideve && $perform_time<=$earlyeve)){////Peak picked = 12am-2pm and 5pm-7pm. 
                        //Update Driver's Merit Statement --------------
                        $statement = array();
                        $statement['driver'] = $driver_id;
                        $statement['order_id'] = $order_id;
                        $statement['note'] = $note;
                        $statement['points'] = $rule['point'];
                        sql_save('merit', $statement);

                        //Update Driver's Merit Balance --------------
                        $driver['merit'] = $driver['merit'] + $rule['point'];
                        sql_save('driver', $driver);
                        $result = true;
                    }
                }
            }
        }
    }
    return $result;
}


function fastDelivery($driver_id, $order_id, $perform_time){//During POD, validate & gain points against now
    
    $result = false;
    $note = 'fast delivery';
    
    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
    
        if(empty($exist['id'])){
            $order = sql_read('select distance, created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 7);

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){
                
                $standard = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($rule['rule2'] * 60);

                if($order['distance'] > $rule['rule1'] && $perform_time < $standard){//Qualified fast delivery merit 
                    //Update Driver's Merit Statement --------------
                    $statement = array();
                    $statement['driver'] = $driver_id;
                    $statement['order_id'] = $order_id;
                    $statement['note'] = $note;
                    $statement['points'] = $rule['point'];
                    sql_save('merit', $statement);

                    //Update Driver's Merit Balance --------------
                    $driver = sql_read('select id, merit from driver where id=? limit 1', 'i', $driver_id);
                    $driver['merit'] = $driver['merit'] + $rule['point'];
                    sql_save('driver', $driver);
                    $result = true;
                }
            }
        }
    }
    return $result;
}





function fastCollect($driver_id, $order_id, $perform_time){//During POD, validate & gain points against collect time

    $result = false;
    $note = 'fast pick';

    $driver = sql_read('select id, merit, working_time from driver where id=? limit 1', 'i', $driver_id);
    

    if($driver['working_time'] == 'full'){
        
        if(!empty($order_id) && !empty($perform_time)){
            
            $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));

            if(empty($exist['id'])){
                $order = sql_read('select created, time, branch from orders where id=? limit 1', 'i', $order_id);
                $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 6);
                $branch = sql_read('select no_internet from branch where id=? limit 1', 'i', $order['branch']);
       
                if($branch['no_internet'] != 'no internet' && !empty($rule['rule1']) && !empty($rule['point'])){
                    
                    $standard = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($rule['rule1'] * 60);

                    if($perform_time < $standard){//Qualified fast pick merit 
                        //Update Driver's Merit Statement --------------
                        $statement = array();
                        $statement['driver'] = $driver_id;
                        $statement['order_id'] = $order_id;
                        $statement['note'] = $note;
                        $statement['points'] = $rule['point'];
                        sql_save('merit', $statement);
                        
                        //Update Driver's Merit Balance --------------
                        $driver['merit'] = $driver['merit'] + $rule['point'];
                        sql_save('driver', $driver);
                        $result = true;
                    }
                }
            }
        }
    }
    return $result;
}


function season($driver_id, $order_id, $perform_time){//During POD, validate perform time against season period

    $result = false;
    $note = 'season reward';
    
    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
        
        if(empty($exist['id'])){

            $order = sql_read('select created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 5);

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){
                
                $standard_from = strtotime($rule['rule1'] * 60);
                $standard_to = strtotime($rule['rule2'] * 60) + (24*60*60);

                if($perform_time >= $standard_from && $perform_time <= $standard_to){//Qualified fast pick merit
                    //Update Driver's Merit Statement --------------
                    $statement = array();
                    $statement['driver'] = $driver_id;
                    $statement['order_id'] = $order_id;
                    $statement['note'] = $note;
                    $statement['points'] = $rule['point'];
                    sql_save('merit', $statement);
                    
                    //Update Driver's Merit Balance --------------
                    $driver = sql_read('select id, merit from driver where id=? limit 1', 'i', $driver_id);
                    $driver['merit'] = $driver['merit'] + $rule['point'];
                    sql_save('driver', $driver);
                    $result = true;
                }
            }
        }
    }
    return $result;
}




function slowDelivery($driver_id, $order_id, $perform_time){//During POD, validate & gain points against now
    
    $result = false;
    $note = 'slow delivery';

    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
    
        if(empty($exist['id'])){

            $order = sql_read('select distance, created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 11);

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){
                
                $standard = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($rule['rule2'] * 60);

                if($order['distance'] < $rule['rule1'] && $perform_time > $standard){//Qualified slow delivery demerit 
                    //Update Driver's Merit Statement --------------
                    $statement = array();
                    $statement['driver'] = $driver_id;
                    $statement['order_id'] = $order_id;
                    $statement['note'] = $note;
                    $statement['points'] = '-'.$rule['point'];
                    sql_save('merit', $statement);

                    //Update Driver's Merit Balance --------------
                    $driver = sql_read('select id, merit from driver where id=? limit 1', 'i', $driver_id);
                    $driver['merit'] = $driver['merit'] - $rule['point'];
                    sql_save('driver', $driver);
                    $result = true;
                }
            }
        }
    }
    return $result;
}





function slowCollect($driver_id, $order_id, $perform_time){//During POD, validate & gain points against collected time

    $result = false;
    $note = 'slow pick';

    $driver = sql_read('select id, merit, working_time from driver where id=? limit 1', 'i', $driver_id);
    
    if($driver['working_time'] == 'full'){

        if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
            
            $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
        
            if(empty($exist['id'])){

                $order = sql_read('select created, time, branch from orders where id=? limit 1', 'i', $order_id);
                $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 10);
                $branch = sql_read('select no_internet from branch where id=? limit 1', 'i', $order['branch']);
 
                if($branch['no_internet'] != 'no internet' && !empty($rule['rule1']) && !empty($rule['point'])){
                    
                    $standard = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($rule['rule1'] * 60);

                    if($perform_time > $standard){//Qualified fast pick merit 
                        //Update Driver's Merit Statement --------------
                        $statement = array();
                        $statement['driver'] = $driver_id;
                        $statement['order_id'] = $order_id;
                        $statement['note'] = $note;
                        $statement['points'] = '-'.$rule['point'];
                        sql_save('merit', $statement);
                        
                        //Update Driver's Merit Balance --------------
                        $driver['merit'] = $driver['merit'] - $rule['point'];
                        sql_save('driver', $driver);
                        $result = true;
                    }
                }
            }
        }
    }
    return $result;
}




function getFastPickDeadline($order_id){

    $deadline = 'expired';
    $order = sql_read('select id, status, time, created from orders where id=? limit 1', 'i', $order_id);
    $fast_pick = sql_read('select rule1 from merit_setup where id=? limit 1', 'i', 6);
    
    if(($order['status'] == 'Accepted' || $order['status'] == 'Ordered') && !empty($fast_pick['rule1'])){

        $now = time();

        $deadtime = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($fast_pick['rule1'] * 60);

        if($deadtime > $now){
            if(date('Ymd') == date('Ymd', $deadtime)){
                $deadline = date('g.ia', $deadtime);
            }else{
                $deadline = date('M Y g.ia', $deadtime);
            }
        }
    }
    return $deadline;
}



/*
function sendNotification($driver_id, $title, $body){
    
    if($title && $body){

        $driver = sql_read('select push_token from driver where id=? limit 1', 'i', $driver_id);

        if($driver['push_token']){

            header('Host: exp.host');
            header('Accept: application/json');
            header('Accept-encoding: gzip, deflate');
            header('Content-type:application/json');

            $post = ['to' => $driver['push_token'], 'title' => $title, 'body'   => $body];

            $ch = curl_init('https://exp.host/--/api/v2/push/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);
        }        
    }
}*/




function standardMeritChecker($driver_id){

    if(!empty($driver_id)){

        $driver = sql_read('select id, name, merit, notify_note from driver where id=? and status=? limit 1', 'ii', array($driver_id, 1));



        if(!empty($driver['merit'])){
            
            if($driver['merit'] <=70 && $driver['notify_note'] !='70'){

                $data['id'] = $driver['id'];
                $data['status'] = 0;
                $data['notify_note'] = '70';
                sql_save('driver', $data);

                //$title = 'Account Rejected!';
                //$body = 'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Account rejected.';
                //include 'remote_push.php';

                sendNotification(
                    $driver_id,
                    'Account Rejected!', 
                    'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Account rejected.'
                );

            }elseif($driver['merit'] <=75 && $driver['notify_note'] !='75'){

                $data['id'] = $driver['id'];
                $data['notify_note'] = '75';
                sql_save('driver', $data);

                /*$title = 'Warning!';
                $body = 'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. It is dangerously close to account suspension.';
                include 'remote_push.php';*/

                sendNotification(
                    $driver_id,
                    'Warning!', 
                    'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. It is dangerously close to account suspension.'
                );
            }elseif($driver['merit'] <=85 && $driver['notify_note'] !='85'){

                $data['id'] = $driver['id'];
                $data['notify_note'] = '85';
                sql_save('driver', $data);

                /*$title = 'Keep it up!';
                $body = 'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Keep it up!';
                include 'remote_push.php';*/

                sendNotification(
                    $driver_id,
                    'Keep it up!', 
                    'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Keep it up!'
                );
            }elseif($driver['merit'] >=120 && $driver['merit'] <140 && $driver['notify_note'] !='120'){

                $data['id'] = $driver['id'];
                $data['notify_note'] = '120';
                sql_save('driver', $data);

                /*$title = 'Well Done!';
                $body = 'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Well done!';
                include 'remote_push.php';*/

                sendNotification(
                    $driver_id,
                    'Well Done!', 
                    'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Well done!'
                );
            }elseif($driver['merit'] >=140 && $driver['notify_note'] !='140'){

                $data['id'] = $driver['id'];
                $data['notify_note'] = '140';
                sql_save('driver', $data);

                /*$title = 'Excellence!';
                $body = 'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Excellence!';
                include 'remote_push.php';*/

                sendNotification(
                    $driver_id,
                    'Excellence!', 
                    'Hi '.$driver['name'].', your merit are now '.$driver['merit'].'. Excellence!'
                );
            /*}else{
                $data['notify_note'] = 'NOTHING';
                sendNotification(
                    $driver_id,
                    'No msg!', 
                    'Hi no message found!'
                );*/
            }

        }
    }
}


?>