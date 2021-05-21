
<?php 

require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>


<link rel="stylesheet" href="../css/wphp-calendar.css">

<?php
$tour = sql_read('select * from tour where status=? and id = ? limit 1', 'ii', array(1,$_SESSION['tour']));

$items = sql_read('select * from items where status=? and created >=? and created <=?', 'sss', array('Paid', $tour['validity_from'], $tour['validity_to']));


foreach((array)$items as $item){
    $item;
}


$start = strtotime($tour['validity_from']);
$end = strtotime($tour['validity_to'] . '+1 day');
$tomorrow = strtotime(date('Y-m-d') . '+1 day');

if($tomorrow > $start){
    $start = $tomorrow;
}

$start_js = $tour['validity_from'];
$end_js = $tour['validity_to'];

if($tomorrow > $start){
    $start_js = date('Y-m-d', strtotime(date('Y-m-d') . '+1 day'));
}
if($end<0){
    $end_js = date('Y-m-d', strtotime(date('Y-m-d') . '+1 year'));
}
$left_btn = true;



$year = date('Y');
$month = date('m');

if($_GET['y']){
    $year = $_GET['y'];
}
if($_GET['m']){
    $month = $_GET['m'];
}
if((($year)*12+$month) == ((substr($start_js,0,4))*12+substr($start_js,5,2))){
    $left_btn = false;
}
$right_btn = true;
if((($year)*12+$month) == ((substr($end_js,0,4))*12+substr($end_js,5,2))){
    $right_btn = false;
}

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstdayofweek = date('w', strtotime($year.'-'.$month.'-01'));

$startnode = 1;
$day = 0;
$max_row = 5;
if($firstdayofweek+$days_in_month>35){
    $max_row = 6;
}

?>


<table id="wphp-cal">
    <tr class="panel-outter">
        <td class="panel-btn" <?php if($left_btn){?>onclick="go_month('left')"<?php }else{?>style="opacity:.2"<?php }?>>
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </td>


        <td class="panel-body" colspan="5" id="year-month" data-year="<?php echo $year?>" data-month="<?php echo $month?>" start-year="<?php echo substr($start_js,0,4)?>" start-month="<?php echo substr($start_js,5,2)?>" start-day="<?php echo substr($start_js,8,2)?>" end-year="<?php echo substr($end_js,0,4)?>" end-month="<?php echo substr($end_js,5,2)?>" end-day="<?php echo substr($end_js,8,2)?>">
        <!--id="cal-year-month" -->
            <?php echo $year.' '.date('F', mktime(0, 0, 0, $month, 10))?>
        </td>
        <td class="panel-btn" <?php if($right_btn){?>onclick="go_month('right')"<?php }else{?>style="opacity:.2"<?php }?>>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </td>
    </tr>
    <tr>
        <td class="dayofweek">Sun</td>
        <td class="dayofweek">Mom</td>
        <td class="dayofweek">Tue</td>
        <td class="dayofweek">Wed</td>
        <td class="dayofweek">Thu</td>
        <td class="dayofweek">Fri</td>
        <td class="dayofweek">Sat</td>
    </tr>
    <?php for($row=1; $row<=$max_row; $row++){?>
        <tr class="cal-row">
            <?php for($col=1; $col<=7; $col++){
                                    
                $cell = (($row-1)*7)+$col;
                $available = false;
                
                $maxing = 0;
                if($day==$days_in_month){
                    $maxing++;
                }

                if($cell >= $firstdayofweek+1 && $day < $days_in_month){
                    $day++;
                    if(
                    ($col == 1 && $tour['sunday_sales'] != 'No') || 
                    ($col == 2 && $tour['monday_sales'] != 'No') || 
                    ($col == 3 && $tour['tuesday_sales'] != 'No') || 
                    ($col == 4 && $tour['wednesday_sales'] != 'No') || 
                    ($col == 5 && $tour['thursday_sales'] != 'No') || 
                    ($col == 6 && $tour['friday_sales'] != 'No') || 
                    ($col == 7 && $tour['saturday_sales'] != 'No') 
                    ){
                        $date = $year.'-'.sprintf("%02d", $month).'-'.$day;
                        //$date_sql = $year.'-'.sprintf("%02d", $month).'-'.$day;
                        $datetime = strtotime($date);
                        if($datetime >= $start && $datetime <= $end){
                            $available = true;
                        }
                    }
                }

                ?>
                <td id="<?php echo $date?>" class="cell 
                    <?php if($available) echo 'available'; else echo 'not-available';?>" 
                    <?php if($available){?>onclick="pick('<?php echo $date?>', '<?php echo date('D, M d, Y', strtotime($date))?>')"
                    <?php }else{?>
                        title="Not Available" style="color:#CCC;"
                    <?php }?>
                >
                    <?php 

                        //echo '<div style="font-size:8px; color:gray;">'.$maxing.'</div>';
                        if($day>0 && $maxing==0){
                            echo $day;
                       
                        }
                    ?>
                </td>
            <?php 

            }?>
        </tr>
    <?php 
    }
    ?>
</table>



<script>
function pick(date, show_date){
    $('.cell').removeClass('choosen-cell');
    $('#'+date).addClass('choosen-cell');
    $('#date').val(date);
    $('.show_date').text(show_date);
    
    if(date != ''){
        $('#add_to_cart').prop("disabled", false);
    }
}



function go_month(direction){

    var go_year, go_month, go_day, go, valid, valid_year, valid_month, valid_day, datum, current_year, current_month;
  
    current_year = Number($('#year-month').attr('data-year'));
    current_month = Number($('#year-month').attr('data-month'));

    if(direction == 'left'){
        valid_year = Number($('#year-month').attr('start-year'));
        valid_month = Number($('#year-month').attr('start-month'));
        valid_day = Number($('#year-month').attr('start-day'));

        if(current_month==1){ go_year = current_year-1; go_month = 12;}else{ go_year = current_year; go_month = current_month - 1;}
        go_day = new Date(go_year, go_month, 0).getDate();
    }else{
        valid_year = Number($('#year-month').attr('end-year'));
        valid_month = Number($('#year-month').attr('end-month'));
        valid_day = Number($('#year-month').attr('end-day'));

        if(current_month==12){ go_year = current_year+1; go_month = 1;}else{ go_year = current_year; go_month = current_month + 1;}
        go_day = '1';
    }
    
    datum = new Date(Date.UTC(valid_year,valid_month,valid_month));
    valid = datum.getTime()/1000;

    //alert(go_year+'-'+go_month+'-'+go_day);

    datum = new Date(Date.UTC(go_year,go_month,go_day));
    //datum = new Date(Date.UTC(2020,12,18));
    go = datum.getTime()/1000;
    
    //alert(go+'<'+valid);
    
    if(direction == 'left' && go < valid){
        alert('Invalid book date.');
        //alert(go+'<'+valid);
    }else if(direction == 'right' && go > valid){
        alert('Invalid book date.');
        //alert(go+'>'+valid);
    }else{
        $('#book-calendar').load('../book.php?y='+go_year+'&m='+go_month);
    }

}

</script>

