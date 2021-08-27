<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
include '../../api/send_notification.php';


//include '../layout/savelog.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$table = 'driver';
$module_name = 'Driver Account';
$php = 'driver';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by id DESC';


if($_POST['add2020']){
	$_POST['merit'] = 100;
	$_POST['status'] = 1;
}
if($_POST['update2020']){
	unset($_POST['merit']);
}

if($_POST['action']){

	foreach($_POST['productIdList'] as $item){
		$d_driver['id'] = $item;
		$d_driver['admin'] = $_SESSION['user_id'];
		sql_save('driver', $d_driver);
	}
}


if($_POST['action'] == 'Approve' || $_POST['action'] == 'Reject'){

	if($_POST['productIdList']){
		
		foreach($_POST['productIdList'] as $driver_id){

			$driver['id'] = $driver_id;
			$driver['admin'] = $_SESSION['user_id'];
			sql_save('driver', $driver);

			if($_POST['action'] == 'Approve'){
				$title = 'Account Approved';
				$body = 'Your driver account has been approved.';
			}elseif($_POST['action'] == 'Reject'){
				$title = 'Account Rejected';
				$body = 'Your driver account has been rejected.';
			}
			
			//include '../../api/remote_push.php';

			sendNotification($driver_id, $title, $body);
			
			//need add ip/domain to google console https://console.cloud.google.com/apis/credentials/oauthclient/88228738966-365pv180pv12akkhmhqvfejv2p09k9v2.apps.googleusercontent.com?authuser=5&project=lateral-pathway-313313
			
			//to do above, need both domain & https

		}
	}
}



$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'plate_number', 'vehicle_belonging');
$filter = true;
$filFields = array('vehicle_type');

$actions=array('Delete', 'Approve', 'Reject');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Set as "Display"?';	$db['Display']=array('status', '1');
$msg['Hide']='Set as "Hide"?';			$db['Hide']=array('status', '2');
$msg['Approve']='Set as "Approve"?';	$db['Approve']=array('status', '1');
$msg['Reject']='Set as "Reject"?';		$db['Reject']=array('status', '0');
$msg['Pending']='Set as "Pending"?';	$db['Pending']=array('status', '2');


$fields = array('id', 'name', 'working_time', 'mobile_number', 'emergency_contact_number', 'vehicle_type', 'region', 'plate_number', 'vehicle_belonging', 'photo_of_ic', 'photo_of_driving_license', 'vehicle_front_view', 'vehicle_back_view', 'merit');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('9', '4'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['branch_location'] = 'map';
$type['branch_location_coordinate'] = 'coordinate';
$type['merit'] = 'hidden';


$labelFullRow['branch_location'] = true;

/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$type['vehicle_type'] = 'select'; $option['vehicle_type'] = array();
$results = sql_read('select * from vehicle_type where status=1 order by position ASC, vehicle_type ASC');
foreach((array)$results as $a){
	$option['vehicle_type'][$a['id']] = ucwords($a['vehicle_type']);
}

$type['region'] = 'select'; $option['region'] = array();
$results = sql_read('select * from region where status=1 order by position ASC, region ASC');
foreach((array)$results as $a){
	$option['region'][$a['id']] = ucwords($a['region']);
}

$type['admin'] = 'select'; $option['admin'] = array();
$results = sql_read("select * from login where status =1 order by name ASC");
foreach((array)$results as $a){
	$option['admin'][$a['id']] = ucwords($a['name']);
}

$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';


$type['id'] = 'hidden';
$type['password'] = 'password';
$type['photo_of_ic'] = 'image';
$type['photo_of_driving_license'] = 'image';
$type['vehicle_front_view'] = 'image';
$type['vehicle_back_view'] = 'image';
$type['modified'] = 'date';


//$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin');//,'2'=>'Admin'
$type['status'] = 'select'; $option['status'] = array('2'=>'Applying','1'=>'Approved','0'=>'Rejected');$default_option['status'] = '2';
$type['working_time'] = 'select'; $option['working_time'] = array('full'=>'Full Time','part'=>'Part Time');$default_option['type'] = 'Full Time';


//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';

$required['title'] = 'required';


/*if(empty($id)){
	$required['photo01'] = 'required';
}*/
/*
echo '<div style="margin-left:20%;">';
foreach((array)$fields as $field){
	echo $field;
	echo $width[$field];
	echo '<br>';
	print_r($fic_1);
}
echo '</div>';
*/

$cols = $items =array();
$cols = array('Driver' => 2, 'Admin' => 2, 'Region' => 2, 'Contact' => 2, 'Emergency Contact' => 1, 'Vehicle' => 1, 'Merit' => 1, 'Plate No.' => 1);//Column title and width
$items['Admin'] = array('admin', 'modified');
$items['Region'] = array('region');
$items['Driver'] = array('name', 'working_time');
$items['Contact'] = array('mobile_number');
$items['Emergency Contact'] = array('emergency_contact_number');
$items['Vehicle'] = array('vehicle_type', 'vehicle_belonging');
$items['Plate No.'] = array('plate_number');
$items['Merit'] = array('merit');

if(empty($_POST['get_config_only'])){
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
<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'dd/mm/yy' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>
<div class="row no-print">
	<div class="col-12 p-2 pr-4">
		<button class="btn btn-sm float-right" onclick="window.print()" style=" float: right; border:1px solid gray;">
			<img src="<?php echo ROOT?>cms/images/print_64.png" alt="" style="width:20px;">PRINT
		</button>
	</div>
</div>

<div class="row">

	<?php /*if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_page').slideToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }*/?>


	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 add_panel <?php if($_GET['no_list'] != 'true'){?>collapse add_page<?php }?>">
		<?php include '../layout/add.php';?>
	</div>
	<?php }?>
</div>
<div class="row">
	<div class="col-12">
		<?php 
	
		$fields = array('id', 'name', 'working_time', 'mobile_number', 'emergency_contact_number', 'vehicle_type', 'region', 'plate_number', 'vehicle_belonging', 'photo_of_ic', 'photo_of_driving_license', 'vehicle_front_view', 'vehicle_back_view', 'merit', 'modified', 'status');


		$type['merit'] = 'text';

		if(!$_GET['no_list']) include '../layout/list.php';?>
	</div>
</div>



<script>
function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++){
   try{
     if(frm.elements[i].name == arr){
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}


$(".commission_merit").each(function( index ) {
	var i = $(this).attr('link');
	$(this).after('<a href="commission.php?id='+i+'" target="_blank" ><div class="commerit">Withdraw</div></a><a href="withdraw_log.php?id='+i+'" target="_blank" ><div class="commerit">History</div></a>');
	//<a href="merit_statement.php?id='+i+'" target="_blank" class="btn btn-xs btn-default list-edit ref-btn" style="margin-left:5px;">Merit</a>
});


</script>


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>

<style>
.commerit {
	text-align: center;
	border:2px solid lightblue; padding:2px 10px; border-radius:6px; display:inline-block; background:black;
}

</style>

</html>
<?php }?>