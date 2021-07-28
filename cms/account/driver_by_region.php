<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
require_once '../../api/send_notification.php';


//include '../layout/savelog.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}



?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<div class="row">
	<div class="col-12">
		<div class="row no-print">
			<div class="col">
				<button class="btn btn-sm float-right" onclick="window.print()" style=" float: right; border:1px solid gray;">
					<img src="<?php echo ROOT?>cms/images/print_64.png" alt="" style="width:20px;">PRINT
				</button>
			</div>
		</div>
		<h3>Driver by Region</h3>
		<?php 
		$regions = sql_read('select * from region order by region asc');
		//debug($regions);

		foreach($regions as $region){?>
			<div class="col pt-4 pb-4">
				<h5>
					<img src="<?php echo ROOT?>images/678111-map-marker-512.webp" width="20px" alt="">
					<?php echo $region['region']?>
				</h5>
				<?php 
				$drivers = sql_read('select id, name, merit from driver where region=?', 'i', $region['id']);
				$n = 1;
				?>
				<table class="table">
					<tr>
						<th class="myth" width="30">No.</th>
						<th class="myth">Driver</th>
						<th class="myth">Merit</th>
						<th class="myth">Withdraw Commission</th>
						<th class="myth">Withdraw Bonus</th>
						<th class="myth">Active Time</th>
						<th class="myth">Withdraw</th>
					</tr>
					
					<?php foreach($drivers as $driver){
						
						$total = sql_read("select SUM(commission) as total_commission, SUM(bonus) as total_bonus from commission where driver=? limit 1", 'i', $driver['id']);
						$duration = sql_read("select SUM(duration) as total_duration from driver_on_off where driver=? limit 1", 'i', $driver['id']);

						if($driver['merit'] < 85){
							$color = 'red';
						}elseif($driver['merit'] < 99){
							$color = 'orange';
						}elseif($driver['merit'] < 120){							
							$color = '#00d447';
						}elseif($driver['merit'] < 140){							
							$color = '#008cff';
						}else{
							$color = '#9a47ff';
						}
						?>
						<tr>
							<td><?php echo $n++.'.';?></td>
							<td>
								<a href="../account/driver.php?id=<?php echo base64_encode($driver['id'])?>&no_list=true" target="_blank" style="color:black;">
								<?php echo $driver['name']?></a>
							</td>
							<td>
								<div style="display:inline-block; border:1px solid <?php echo $color?>; background:<?php echo $color?>; padding:1px 3px; border-radius:10px; font-weight:bold;">
									<?php echo $driver['merit'];?>
								</div>
							</td>
							<td>
								<?php echo 'RM'.number_format($total['total_commission'], 2, '.', ',');?>
							</td>
							<td>
								<?php echo 'RM'.number_format($total['total_bonus'], 2, '.', ',');?>
							</td>
							<td>
								<?php echo round($duration['total_duration']/60/60).'hrs';?>
							</td>
							<td>
								<a href="../account/commission.php?id=<?php echo base64_encode($driver['id'])?>" target="_blank">
									<div class="commerit">
										Withdraw Now
									</div>
								</a>
							</td>
						</tr>
					<?php }?>
					

				</table>
			</div>
			
		<?php 
		}
		?>
	</div>
</div>

<style>
.commerit {
	text-align: center;
	border:2px solid lightblue; padding:2px 10px; border-radius:6px; display:inline-block; background:black;
}
.myth {
	border-bottom:3px solid gray;
	padding-bottom:4px !important;

}

</style>

</html>
