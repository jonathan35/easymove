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

if($_POST['reset']){
	unset($_POST);
}

$id = base64_decode($_GET['id']);

$driver = sql_read("select id, name, mobile_number, plate_number, merit from driver where id=? limit 1", 'i', $id);

if($_POST['Withdraw'] == 'Withdraw Now'){


	//$exist = sql_read("select id from withdraw where driver=? and created like '".date('Y-m-d H-__-__')."' limit 1", 'i', $id);

	//if(empty($exist['id'])){
		$withdraw['driver'] = $id;
		$withdraw['basic'] = $_POST['basic'];
		$withdraw['bonus'] = $_POST['bonus'];
		$withdraw['admin'] = $_SESSION['user_id'];
		sql_save('withdraw', $withdraw);
		
		$last_withdraw = sql_read('select id from withdraw order by id desc limit 1');

		if(!empty($last_withdraw['id'])){
			sql_exec('UPDATE commission SET withdraw=? WHERE driver=? and withdraw is null ', 'si', array($last_withdraw['id'], $id));
		}
	//}


}



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
	<div class="col-12 p-5">

		<?php 
		
		$conditions = "";

		if(!empty($_POST['year'])){
			$conditions .= " and created like '".$_POST['year']."-__-__%' ";
		}
		if(!empty($_POST['month'])){
			$conditions .= " and created like '____-".$_POST['month']."-__%' ";
		}

		//--Commission-----
		$commissions = sql_read("select * from commission where driver=? and commission !='' $conditions order by id desc", 'i', $id);

		foreach($commissions as $k => $v){
			$commissions[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
			$commissions[$k]['sid'] = sprintf("%08d", $v['order_id']);
		}


		//--Merit-----
		

		$merits = sql_read("select * from merit where driver=? and points !='' $conditions order by id desc", 'i', $id);

		foreach($merits as $k => $v){
			$merits[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
			$merits[$k]['sid'] = sprintf("%08d", $v['order_id']);
		}



		?>

		<div class="row p-2 mb-4">
			<div class="col-4">
				<h3>Driver</h3>
				<div>Name: <?php echo $driver['name']?></div>
				<div>Contact: <?php echo $driver['mobile_number']?></div>
				<div>Plate: <?php echo $driver['plate_number']?></div>
				
			</div>
			<div class="col-4">
				<h3>Performance</h3>
				<div>Merit: <b><?php echo $driver['merit']?>p</b></div>
				<?php 
				//--Total-----
				echo $conditions;
				
				$online = sql_read("select SUM(duration) as total from driver_on_off where driver=? $conditions limit 1", 'i', array($id));
				?>
				<div>Online: about <b><?php echo round($online['total']/60/60)?>hrs</b></div>
			</div>
			<div class="col-4">
				<h3>Withdraw</h3>
				<?php 
				//--Total-----
				$withdrawable = sql_read("select SUM(commission) as commission, SUM(bonus) as bonus  from commission where driver=? and withdraw is null $conditions limit 1", 'i', array($id));
				?>
				<div>
					Commission: <b>RM<?php echo number_format($withdrawable['commission'],2)?></b>
				</div>
				<div>
					Merit Bonus: <b>RM<?php echo number_format($withdrawable['bonus'],2)?></b>
				</div>

				<?php if($withdrawable['commission']>0){?>
				<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
					<input type="hidden" name="basic" value="<?php echo $withdrawable['commission']?>">
					<input type="hidden" name="bonus" value="<?php echo $withdrawable['bonus']?>">
					<input type="submit" name="Withdraw" value="Withdraw Now" class="btn btn-xs" style="width:140px; padding:10px; ">
				</form>
				<?php }?>

			</div>
		</div>

		<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
		<div class="row pt-5"  style="border-top:2px solid #999; ">
			<div class="col-2">
				<select name="year" id="">
					<option value="">All years</option>
					<?php 
					$max_year = date('Y');
					for($y=2021; $y<=$max_year; $y++){?>
					<option value="<?php echo $y?>" <?php if($y==$_POST['year']){?>selected<?php }?>><?php echo $y?></option>
					<?php }?>
				</select>
			</div>
			<div class="col-2">
				<select name="month" type="text">
					<option value="">All months</option>
					<option value="01" <?php if($_POST['month']=='01'){?>selected<?php }?>>Jan</option>
					<option value="02" <?php if($_POST['month']=='02'){?>selected<?php }?>>Feb</option>
					<option value="03" <?php if($_POST['month']=='03'){?>selected<?php }?>>Mar</option>
					<option value="04" <?php if($_POST['month']=='04'){?>selected<?php }?>>Apr</option>
					<option value="05" <?php if($_POST['month']=='05'){?>selected<?php }?>>May</option>
					<option value="06" <?php if($_POST['month']=='06'){?>selected<?php }?>>Jun</option>
					<option value="07" <?php if($_POST['month']=='07'){?>selected<?php }?>>Jul</option>
					<option value="08" <?php if($_POST['month']=='08'){?>selected<?php }?>>Aug</option>
					<option value="09" <?php if($_POST['month']=='09'){?>selected<?php }?>>Sep</option>
					<option value="10" <?php if($_POST['month']=='10'){?>selected<?php }?>>Oct</option>
					<option value="11" <?php if($_POST['month']=='11'){?>selected<?php }?>>Nov</option>
					<option value="12" <?php if($_POST['month']=='12'){?>selected<?php }?>>Dec</option>
				</select>
			</div>
			<div class="col-4">
				<input type="submit" name="submit" value="Search">
				<input type="submit" name="reset" value="Reset">
			</div>
		</div>
		</form>
		<div class="row">
			<div class="col-6 pt-2">
				<h3>Commission</h3>
				<table class="table">
				<tr>
					<th colspan="3" style="border: none; border-bottom:1px solid #CCC; "></th>
				</tr>
				<tr>
					<th>Commission</th>
					<th>Order</th>
					<th>Date</th>
				</tr>
				<?php foreach($commissions as $c){?>
					<tr>
						<td>RM<?php echo $c['commission'];?></td>
						<td><?php echo $c['sid'];?></td>
						<td><?php echo $c['date']?></td>
					</tr>
				<?php }?>
				</table>
					
			</div>
			<div class="col-6 pt-2">
				<h3>Merit</h3>
				<table class="table">
				<tr>
					<th colspan="3" style="border: none; border-bottom:1px solid #CCC; "></th>
				</tr>
				<tr>
				<th>Points</th>
					<th>Note</th>
					<th>Order</th>
					<th>Date</th>
				</tr>
				<?php foreach($merits as $c){?>
					<tr>
						<td><?php echo $c['points'];?></td>
						<td><?php echo $c['note'];?></td>
						<td><?php echo $c['sid'];?></td>
						<td><?php echo $c['date']?></td>
					</tr>
				<?php }?>
				</table>
					
			</div>
		</div>

		
	</div>
</div>
<?php include '../layout/mymodal.php';?>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>

</html>
<script>
if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}
</script>