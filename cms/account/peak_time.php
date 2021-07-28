<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}



$table = 'orders';
$module_name = 'Sales by Zone/Merchant';
$php = 'orders';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by id DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('orders', 'contact_person');
$filter = true;
$filFields = array('zone');


$type['zone'] = 'select'; $option['zone'] = array();
$results = sql_read('select * from zone where status=1 order by zone ASC');
foreach((array)$results as $a){
	$option['zone'][$a['id']] = ucwords($a['zone']);
}

$type['branch'] = 'select'; $option['branch'] = array();
$results = sql_read('select * from branch order by branch_name ASC');
foreach((array)$results as $a){
	$option['branch'][$a['id']] = ucwords($a['branch_name']);
}



	
include '../layout/list_cond.php';


$condition_ext = preg_replace('/' . preg_quote("AND (year='") .'.*?' .preg_quote("' )") . '/', '', $condition_ext);
$condition_ext = preg_replace('/' . preg_quote("AND (month='") .'.*?' .preg_quote("' )") . '/', '', $condition_ext);

if(!empty($_SESSION['Sales by Zone/Merchant-filter-year'])){
	$y = $_SESSION['Sales by Zone/Merchant-filter-year'];
	$condition_ext .= " and created like '".$y."-__-__%' ";
}

if($_SESSION['Sales by Zone/Merchant-filter-month']){
	$m = $_SESSION['Sales by Zone/Merchant-filter-month'];
	$condition_ext .= " and created like '____-".$m."-__%' ";
}


$sql = "select count(id) as order_count from orders where status='Delivered' and (delivered_datetime like ";
$sql2 = " or delivered_datetime like ";

if(empty($condition_ext)){
	$sql3 = " and created like '".date('Y-')."%' limit 1 ";
}else{
	$sql3 = $condition_ext." limit 1 ";
}



//echo " $sql '%".date('12:__:__')."' $sql2 '%".date('13:__:__')."') $sql3";

$r1 = sql_read(" $sql '%".date('12:__:__')."' $sql2 '%".date('13:__:__')."') $sql3");
$r2 = sql_read(" $sql '%".date('14:__:__')."' $sql2 '%".date('15:__:__')."') $sql3");
$r3 = sql_read(" $sql '%".date('16:__:__')."' $sql2 '%".date('17:__:__')."') $sql3");
$r4 = sql_read(" $sql '%".date('18:__:__')."' $sql2 '%".date('19:__:__')."') $sql3");
$r5 = sql_read(" $sql '%".date('20:__:__')."' $sql2 '%".date('21:__:__')."') $sql3");
$r6 = sql_read(" $sql '%".date('22:__:__')."' $sql2 '%".date('23:__:__')."') $sql3");

$r7 = sql_read(" $sql '%".date('00:__:__')."' $sql2 '%".date('01:__:__')."') $sql3");
$r8 = sql_read(" $sql '%".date('02:__:__')."' $sql2 '%".date('03:__:__')."') $sql3");
$r9 = sql_read(" $sql '%".date('04:__:__')."' $sql2 '%".date('05:__:__')."') $sql3");
$r10 = sql_read(" $sql '%".date('06:__:__')."' $sql2 '%".date('07:__:__')."') $sql3");
$r11 = sql_read(" $sql '%".date('08:__:__')."' $sql2 '%".date('09:__:__')."') $sql3");
$r12 = sql_read(" $sql '%".date('10:__:__')."' $sql2 '%".date('11:__:__')."') $sql3");

$total_count = $r1['order_count']+$r2['order_count']+$r3['order_count']+$r4['order_count']+$r5['order_count']+$r6['order_count']+$r7['order_count']+$r8['order_count']+$r9['order_count']+$r10['order_count']+$r11['order_count']+$r12['order_count'];


?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>



<div class="row">
<div class="col-12">	

	<h3>Peak Time Report</h3>
	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form class="col-12 pb-4" action="" method="post" enctype="multipart/form-data" target="_self">
			<div class="row">
			<span class="glyphicon glyphicon-search" style="color:gray;"></span>
			
		
			<?php 
			if($filter==true){
			foreach((array)$filFields as $field){?>
				<div class="col-2">
				<select name="<?php echo $field?>">
					<option value="">All <?php echo str_replace("_", " ", $field)?></option>
					<?php 
					foreach((array)$option[$field] as $option_v => $option_name){                        
						$countItem = sql_count('select * from '.$table.' where '.$field.'=?', 's', $option_v);
						if($countItem>0){
							$c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
						}else{
							$c = '';
						}
					?>
					<option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name;?></option>
					<?php }?>
				</select>
				</div>
			<?php 
			}
		}
		
		$max_year = date('Y');
		
		
		?>
				<div class="col-2">
					<select name="year" id="">
						<option value="">All years</option>
						<?php for($y=2021; $y<=$max_year; $y++){?>
						<option value="<?php echo $y?>" <?php if($y==$_SESSION['Sales by Zone/Merchant-filter-year']){?>selected<?php }?>><?php echo $y?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-2">
					<select name="month" type="text">
						<option value="">All months</option>
						<option value="01" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='01'){?>selected<?php }?>>Jan</option>
						<option value="02" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='02'){?>selected<?php }?>>Feb</option>
						<option value="03" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='03'){?>selected<?php }?>>Mar</option>
						<option value="04" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='04'){?>selected<?php }?>>Apr</option>
						<option value="05" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='05'){?>selected<?php }?>>May</option>
						<option value="06" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='06'){?>selected<?php }?>>Jun</option>
						<option value="07" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='07'){?>selected<?php }?>>Jul</option>
						<option value="08" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='08'){?>selected<?php }?>>Aug</option>
						<option value="09" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='09'){?>selected<?php }?>>Sep</option>
						<option value="10" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='10'){?>selected<?php }?>>Oct</option>
						<option value="11" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='11'){?>selected<?php }?>>Nov</option>
						<option value="12" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='12'){?>selected<?php }?>>Dec</option>
					</select>
				</div>
				
				&nbsp;&nbsp;<input type="submit" name="submit" value="Search">
				&nbsp;&nbsp;<input type="submit" name="submit" value="Reset">
			</div>
			</form>
		</div>
	<?php }?>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['12:00pm - 12:00pm', 'Hours per Day'],
          ['12:00pm - 01:59pm',     <?php echo $r1['order_count']?>],
          ['02:00pm - 03:59pm',      <?php echo $r2['order_count']?>],
          ['04:00pm - 05:59pm',  <?php echo $r3['order_count']?>],
          ['06:00pm - 07:59pm', <?php echo $r4['order_count']?>],
          ['08:00pm - 09:59pm',    <?php echo $r5['order_count']?>],
		  ['10:00pm - 11:59pm',    <?php echo $r6['order_count']?>],
		 
          ['12:00am - 01:59am',     <?php echo $r7['order_count']?>],
          ['02:00am - 03:59am',      <?php echo $r8['order_count']?>],
          ['04:00am - 05:59am',  <?php echo $r9['order_count']?>],
          ['06:00am - 07:59am', <?php echo $r10['order_count']?>],
          ['08:00am - 09:59am',    <?php echo $r11['order_count']?>],
		  ['10:00am - 11:59am',    <?php echo $r12['order_count']?>]

        ]);

        var options = {
			backgroundColor: '#DDDDDD',
			chartArea: {left:'10%',top:50,width:'100%',height:'100%'},
          	title: 'Order Count by time zone',
			  
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
	<div class="row">
		<div class="col-12 pl-4">
			
			<?php if($total_count<1){ echo '<div style="font-size:120%;">No data found</div>';}else{?>
				<div id="piechart" style="width: 100%; height: 600px; "></div>
			<?php }?>
		</div>
	</div>
	




</div>
</div>




<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>



</html>
