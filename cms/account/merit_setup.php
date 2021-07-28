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


$gains = array(
	'Daily delivered' => array(
		array(
			'name' => 'daily_rule',			
			'type' => 'number',
			'remark' => 'Delivered standard',
			'placeholder' => 'Delivered count',
		),
		array(
			'name' => 'daily_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
	'Monthly delivered' => array(
		array(
			'name' => 'monthly',			
			'type' => 'number',
			'remark' => 'Number of delivered in a month to achieve',
			'placeholder' => 'Delivered count',
		),
		array(
			'name' => 'monthly_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
	'Peak Time picked' => array(

		array(
			'name' => 'peak_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
	'Season reward' => array(
		array(
			'name' => 'season_start',			
			'type' => 'date',
			'placeholder' => 'Date',
		),
		array(
			'name' => 'season_end',			
			'type' => 'date',
			'placeholder' => 'Date',
		),
		array(
			'name' => 'season_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
	'Fast picked' => array(
		array(
			'name' => 'fast_picked',			
			'type' => 'number',
			'placeholder' => 'Minutes',
		),
		array(
			'name' => 'fast_picked_point',			
			'type' => 'number',
			'placeholder' => 'Merit point',
		)
	),
	'Fast deliver' => array(
		array(
			'name' => 'fast_km',			
			'type' => 'number',
			'placeholder' => 'KM',
		),
		array(
			'name' => 'fast_minutes',			
			'type' => 'number',
			'placeholder' => 'Minutes',
		),
		array(
			'name' => 'fast_deliver_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
	'Attendance reward' => array(
		array(
			'name' => 'attendance_day',			
			'type' => 'number',
			'remark' => 'Number of days to achieve',
			'placeholder' => 'Delivered count',
		),
		array(
			'name' => 'attendance_hour',			
			'type' => 'number',
			'remark' => 'Number of hours each day to achieve',
			'placeholder' => 'Delivered count',
		),
		array(
			'name' => 'attendance_point',			
			'type' => 'number',
			
			'placeholder' => 'Merit point',
		)
	),
);



$losts = array(
	'Slow picked' => array(
		array(
			'name' => 'slow_picked',			
			'type' => 'number',
			'placeholder' => 'Delivered count',
		),
		array(
			'name' => 'slow_picked_point',			
			'type' => 'number',			
			'placeholder' => 'Merit point',
		)
	),
	'Slow deliver' => array(
		array(
			'name' => 'slow_km',			
			'type' => 'number',
			'placeholder' => 'Kilometer',
		),
		array(
			'name' => 'slow_minutes',			
			'type' => 'number',
			'placeholder' => 'Minutes',
		),
		array(
			'name' => 'slow_deliver_point',			
			'type' => 'number',
			'placeholder' => 'Demerit point',
		)
	),
	'No pickup compensate' => array(
		array(
			'name' => 'no_pickup',			
			'type' => 'number',
			'placeholder' => 'Standard time in minutes',
		),
		array(
			'name' => 'no_pickup_point',			
			'type' => 'number',
			'remark' => 'No pickup after accepting order',
			'placeholder' => 'Demerit point',
		)
	),
	'Minimum Hour Weekly' => array(
		array(
			'name' => 'minimun',			
			'type' => 'number',
			'remark' => 'Minimum working weekly',
			'placeholder' => 'Demerit point',
		),
		array(
			'name' => 'minimun_point',			
			'type' => 'number',
			'placeholder' => 'Demerit point',
		)
	),
);


if($_POST){

	$data1['id'] = 1;
	$data1['rule1'] = $_POST['daily_rule'];
	$data1['point'] = $_POST['daily_point'];
	
	$data2['id'] = 2;
	$data2['rule1'] = $_POST['monthly'];
	$data2['point'] = $_POST['monthly_point'];
	
	$data4['id'] = 4;
	$data4['rule1'] = $_POST['peak'];
	$data4['point'] = $_POST['peak_point'];
	
	$data5['id'] = 5;
	$data5['rule1'] = $_POST['season_start'];
	$data5['rule2'] = $_POST['season_end'];
	$data5['point'] = $_POST['season_point'];

	$data6['id'] = 6;
	$data6['rule1'] = $_POST['fast_picked'];
	$data6['point'] = $_POST['fast_picked_point'];

	$data7['id'] = 7;
	$data7['rule1'] = $_POST['fast_km'];
	$data7['rule2'] = $_POST['fast_minutes'];
	$data7['point'] = $_POST['fast_deliver_point'];

	$data8['id'] = 8;
	$data8['rule1'] = $_POST['attendance_day'];
	$data8['rule2'] = $_POST['attendance_hour'];
	$data8['point'] = $_POST['attendance_point'];
	
	$data10['id'] = 10;
	$data10['rule1'] = $_POST['slow_picked'];
	$data10['point'] = $_POST['slow_picked_point'];
	
	$data11['id'] = 11;
	$data11['rule1'] = $_POST['slow_km'];
	$data11['rule2'] = $_POST['slow_minutes'];
	$data11['point'] = $_POST['slow_deliver_point'];
	
	$data13['id'] = 13;
	$data13['rule1'] = $_POST['no_pickup'];
	$data13['point'] = $_POST['no_pickup_point'];
	
	$data14['id'] = 14;
	$data14['rule1'] = $_POST['minimun'];
	$data14['point'] = $_POST['minimun_point'];
	
	sql_save('merit_setup', $data1);
	sql_save('merit_setup', $data2);
	sql_save('merit_setup', $data4);
	sql_save('merit_setup', $data5);
	sql_save('merit_setup', $data6);
	sql_save('merit_setup', $data7);
	sql_save('merit_setup', $data8);
	sql_save('merit_setup', $data10);
	sql_save('merit_setup', $data11);
	sql_save('merit_setup', $data13);
	sql_save('merit_setup', $data14);
	
	$save = '<span style="color:green;">Data saved.</span>';
}

$value1 = sql_read('select * from merit_setup where id=? limit 1', 'i', 1);
$value2 = sql_read('select * from merit_setup where id=? limit 1', 'i', 2);
$value4 = sql_read('select * from merit_setup where id=? limit 1', 'i', 4);
$value5 = sql_read('select * from merit_setup where id=? limit 1', 'i', 5);
$value6 = sql_read('select * from merit_setup where id=? limit 1', 'i', 6);
$value7 = sql_read('select * from merit_setup where id=? limit 1', 'i', 7);
$value8 = sql_read('select * from merit_setup where id=? limit 1', 'i', 8);
$value10 = sql_read('select * from merit_setup where id=? limit 1', 'i', 10);
$value11 = sql_read('select * from merit_setup where id=? limit 1', 'i', 11);
$value13 = sql_read('select * from merit_setup where id=? limit 1', 'i', 13);
$value14 = sql_read('select * from merit_setup where id=? limit 1', 'i', 14);


$gains['Daily delivered'][0]['value'] = $value1['rule1'];
$gains['Daily delivered'][1]['value'] = $value1['point'];

$gains['Monthly delivered'][0]['value'] = $value2['rule1'];
$gains['Monthly delivered'][1]['value'] = $value2['point'];

$gains['Peak Time picked'][0]['value'] = $value4['point'];

$gains['Season reward'][0]['value'] = $value5['rule1'];
$gains['Season reward'][1]['value'] = $value5['rule2'];
$gains['Season reward'][2]['value'] = $value5['point'];

$gains['Fast picked'][0]['value'] = $value6['rule1'];
$gains['Fast picked'][1]['value'] = $value6['point'];

$gains['Fast deliver'][0]['value'] = $value7['rule1'];
$gains['Fast deliver'][1]['value'] = $value7['rule2'];
$gains['Fast deliver'][2]['value'] = $value7['point'];

$gains['Attendance reward'][0]['value'] = $value8['rule1'];
$gains['Attendance reward'][1]['value'] = $value8['rule2'];
$gains['Attendance reward'][2]['value'] = $value8['point'];

$losts['Slow picked'][0]['value'] = $value10['rule1'];
$losts['Slow picked'][1]['value'] = $value10['point'];

$losts['Slow deliver'][0]['value'] = $value11['rule1'];
$losts['Slow deliver'][1]['value'] = $value11['rule2'];
$losts['Slow deliver'][2]['value'] = $value11['point'];

$losts['No pickup compensate'][0]['value'] = $value13['rule1'];
$losts['No pickup compensate'][1]['value'] = $value13['point'];

$losts['Minimum Hour Weekly'][0]['value'] = $value14['rule1'];
$losts['Minimum Hour Weekly'][1]['value'] = $value14['point'];

?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
label {display: inline-block; width:45%;}
.div_input {width:54%;}
.subtitle {font-size:16px; text-transform: capitalize; border-bottom: 1px solid gray;}
remark { color: #999;}
.sm_input {
	display: block;
	width: 130px !important; 
}
</style>


<div class="row">
	<div class="col-12">
		<div class="row pb-1 mb-5">
			<div class="col">
				<div class="row">
					<div class="col-12">
						<h3 class="pl-2">
						Driver Merit Rule Standard

						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<form action="" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone" target="_self">
							<div class="row">
								<div class="col-5" style="padding:30px 0 0 30px;">

<?php 
$labels = array(
	'Order Standard', 'Merit Point', 
	'Order Standard', 'Merit Point', 
	'Merit Point', 
	'Season Start', 'Season End', 'Merit Point', 
	'Duration Standard (Minutes)', 'Merit Point', 
	'Distance Standard (KM)', 'Time Standard (Minutes)', 'Merit Point', 
	'Number of Days (D)', 'Number of Hours (H)', 'Merit Point'
);
$briefs = array(
	'Driver gain point when delivered more order than standard daily.', 
	'Driver gain point when delivered more order than standard monthly.', 
	'Driver gain point when delivered between 12am-2pm and 5pm-7pm.', 
	'Driver gain point when delivered within season period.', 
	'Driver gain point when pickup within standard duration.', 
	'Driver gain point when delivery order faster than standard.', 
	'Driver gain point when continuously serves for “D” of days & “H” of hours.'
);

$a = 0;
$n = 0;
foreach((array)$gains as $title => $fields){?>
<div style="padding-bottom: 50px">
	<div class="subtitle">
		<span style="color: green;">
			<img src="<?php echo ROOT?>images/326712-20.png" style="margin-bottom:6px;">
		</span>
		<?php echo $title?>
	</div>
	<div style="color:gray;">
		<?php echo $briefs[$a]?>
	</div>
	<?php foreach((array)$fields as $input){?>
	<div class="col-12" style="margin-top:12px;">
		<label><?php echo $labels[$n]; $n++;?></label>
		<div class="div_input">
			<input type="<?php echo $input['type']?>" name="<?php echo $input['name']?>" value="<?php echo $input['value']?>"  placeholder="<?php echo $input['placeholder']?>" class="sm_input">
			<!--<remark><?php echo $input['remark']?></remark>-->
		</div>
	</div>
	<?php }?>
</div>
<?php 
$a++;
}?>


								</div>
								<div class="col-1"></div>
								<div class="offset-1 col-5">
									<div class="tips_box mb-5">
									<h4>Tips<img src="<?php echo ROOT?>cms/images/idea-32.png" style="display:inline-block; width:30px;"></h4>
								
										<div class="p-1">General Rules:</div>
										<div class="p-1">Drivers account merit point initial with 100p.</div>
										<div class="p-1">Drivers account terminated once reaches 70p.</div>
										<div class="p-1">Reward below only for full-time but not part-time driver.</div>
										<ul>
											<li class="p-1">Attendance reward</li>
											<li class="p-1">Peak time picked reward</li>
											<li class="p-1">Fast picked reward</li>
										</ul>
									</div>
								
								


<?php 
$labels = array(
	'Duration Standard (Minutes)', 'Merit Point', 
	'Distance Standard (KM)', 'Time Standard (Minutes)', 'Merit Point', 
	'Duration Standard (Minutes)',
	'Merit Point', 
	'Minimum Weekly (Hours)', 'Merit Point'
);
$briefs = array(
	'Driver lost point when pickup within standard duration.',
	'Driver lost point when delivery order slower than standard.', 
	'Driver lost point when no pickup after accepted order.', 
	'Driver lost point when work less than standard hour weekly.', '', 
);

$a = 0;
$n = 0;
foreach((array)$losts as $title => $fields){?>
<div style="padding-bottom: 50px">
	<div class="subtitle">
		<span style="color: green;">
			<img src="<?php echo ROOT?>images/3844427-20.png" style="margin-bottom:2px;">
		</span>
		<?php echo $title?>
	</div>
	<div style="color:gray;">
		<?php echo $briefs[$a]?>
	</div>
	<?php foreach((array)$fields as $input){?>
	<div class="col-12" style="margin-top:12px;">
		<label><?php echo $labels[$n]; $n++;?></label>
		<div class="div_input">
			<input type="<?php echo $input['type']?>" name="<?php echo $input['name']?>" value="<?php echo $input['value']?>"  placeholder="<?php echo $input['placeholder']?>" class="sm_input">
			<!--<remark><?php echo $input['remark']?></remark>-->
		</div>
	</div>
	<?php }?>
</div>
<?php 
$a++;
}?>


								</div>
							</div>
							<div class="row">
								<div class="col-12" style="margin-top:12px; text-align: center;">
									<input type="submit" name="update2020" value="Update" class="btn" >
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>

</html>