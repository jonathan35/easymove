<?php 
require_once '../config/ini.php';


 
$peak = sql_read('select point from merit_setup where id=? limit 1', 'i', 4);//Peak picked = 12am-2pm and 5pm-7pm. 

$slow = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 10);//Slow pick
$slow_deliverd = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 11);//Slow deliver



function fastDelivery($driver_id, $order_id, $perform_time){//During POD, validate & gain points against now
    
    $result = false;
    $note = 'fast delivery';
    
    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
    
        if(empty($exist['id'])){
            $order = sql_read('select distance, created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 7);

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){//Rules Availabled
                
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





function fastCollect($driver_id, $order_id, $perform_time){//During POD, validate & gain points against collected time

    $result = false;
    $note = 'fast pick';
    
    if(!empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));

        if(empty($exist['id'])){
            $order = sql_read('select created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 6);

            if(!empty($rule['rule1']) && !empty($rule['point'])){//Rules Availabled
                
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


function season($driver_id, $order_id, $perform_time){//During POD, validate perform time against season period

    $result = false;
    $note = 'season reward';
    
    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
        
        if(empty($exist['id'])){

            $order = sql_read('select created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, rule2, point from merit_setup where id=? limit 1', 'i', 5);

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){//Rules Availabled
                
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

            if(!empty($rule['rule1']) && !empty($rule['rule2']) && !empty($rule['point'])){//Rules Availabled
                
                $standard = strtotime(substr($order['created'],0,10).' '.$order['time']) + ($rule['rule2'] * 60);

                if($order['distance'] < $rule['rule1'] && $perform_time > $standard){//Qualified fast delivery merit 
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

    if(!empty($driver_id) && !empty($order_id) && !empty($perform_time)){
        
        $exist = sql_read('select id from merit where order_id=? and note=? limit 1', 'is', array($order_id, $note));
    
        if(empty($exist['id'])){

            $order = sql_read('select created, time from orders where id=? limit 1', 'i', $order_id);
            $rule = sql_read('select rule1, point from merit_setup where id=? limit 1', 'i', 10);

            if(!empty($rule['rule1']) && !empty($rule['point'])){//Rules Availabled
                
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






?>