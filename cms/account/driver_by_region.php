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
	<h3>Driver by Region</h3>
		<?php 
		$regions = sql_read('select * from region order by region asc');
		//debug($regions);

		foreach($regions as $region){?>
			<div class="col-4 pt-4">
				<h5>
					<img src="<?php echo ROOT?>images/678111-map-marker-512.webp" width="20px" alt="">
					<?php echo $region['region']?>
				</h5>
				<?php 
				$drivers = sql_read('select name, merit from driver where region=?', 'i', $region['id']);
				$n = 1;
				?>
				<?php foreach($drivers as $driver){
					echo '<div class="pl-4">'.$n++.'. '.$driver['name'].'</div>';
				}?>
			</div>
			
		<?php 
		}
		?>
	</div>
</div>


</html>
