<?php 
require_once '../config/ini.php';



function fastpick_deadline($order_id){

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