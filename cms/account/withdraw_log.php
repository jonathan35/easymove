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
?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<div class="row">
	<div class="col-12 p-5">

		<?php 	
        
        $driver = sql_read("select id, name, mobile_number, plate_number, merit from driver where id=? limit 1", 'i', $id);
        $ads = sql_read("select id, name from login order by name asc");
        foreach($ads as $ad){
            $admins[$ad['id']] = $ad['name'];
        }
        $drs = sql_read("select id, name from driver order by name asc");
        foreach($drs as $dr){
            $drivers[$dr['id']] = $dr['name'];
        }

		$conditions = "";

		if(!empty($_POST['year'])){
			$conditions .= " and created like '".$_POST['year']."-__-__%' ";
		}
		if(!empty($_POST['month'])){
			$conditions .= " and created like '____-".$_POST['month']."-__%' ";
		}
        
        
       

		$withdraws = sql_read("select * from withdraw where driver=? $conditions order by id desc", 'i', $id);

        
		foreach($withdraws as $k => $v){
			$withdraws[$k]['date'] = date_format(date_create($v['created']), 'd-m-y g:ia');
		}
		?>
        <div class="row pb-4">
            <div class="col-12">
                <h3>Driver</h3>
                <div>Name: <?php echo $driver['name']?></div>
                <div>Contact: <?php echo $driver['mobile_number']?></div>
                <div>Plate: <?php echo $driver['plate_number']?></div>
            </div>
        </div>

		<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
		<div class="row">
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
			<div class="col-12 pt-2">
				<h3>Withdraw History</h3>
				<table class="table">
				<tr>
					<th colspan="3" style="border: none; border-bottom:1px solid #CCC; "></th>
				</tr>
				<tr>
				    <th>Admin</th>
					<th>Driver</th>
					<th>Basic Commission</th>
					<th>Merit Bonus</th>
                    <th>Date</th>
				</tr>
				<?php foreach($withdraws as $c){?>
					<tr>
						<td><?php echo $admins[$c['admin']];?></td>
						<td><?php echo $drivers[$c['driver']];?></td>
						<td>RM<?php echo $c['basic'];?></td>
						<td>RM<?php echo $c['bonus']?></td>
                        <td>RM<?php echo $c['date']?></td>
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