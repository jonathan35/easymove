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

$table = 'region';
$module_name = 'Regions';
$php = 'region';
$folder = 'geographical';
$add = true;
$edit = true;
$list = true;
$list_method = 'list';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');

$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

$unique_validation=array();


$fields = array('id', 'region', 'latitude', 'longitude', 'position', 'status');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('6'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}
///--- Tag module uses session--
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}

$attributes['region'] = array('required' => 'required');
$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';


$label['latitude'] = 'Google Map Latitude';
$label['longitude'] = 'Google Map Longitude';


$type['id'] = 'hidden';
$type['password'] = 'password';
$type['position'] = 'number';
//$type['publish_date'] = 'date';
$type['google_map_link'] = 'textarea'; $tinymce['google_map_link']=false;  $labelFullRow['google_map_link']=false; $height['google_map_link'] = '80px;'; $width['google_map_link'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';

$required['title'] = 'required';



$cols = $items =array();
$cols = array('Region' => '2', 'Latitude' => '3', 'Longitude' => '3', 'Position' => '4');//Column title and width
$items['Region'] = array('region');
$items['Latitude'] = array('latitude');
$items['Longitude'] = array('longitude');
$items['Position'] = array('position');
//$items['Programme'] = array('programme','experience','experience_detail');
//$items['Condition'] = array('illnesses','bankrupt','court');

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
    $( ".datepicker" ).datepicker({  maxDate: "+10Y +6M +1D", dateFormat: 'dd/mm/yy' });
} );//minDate: +7,
</script>
<!--For date picker use - end -->
<style>
label {width:35%;}
.div_input {width:64%;}
</style>


<div class="row">
	<?php if($add==true || $_GET['id']){?>
	<div class="col-5">
		<?php include '../layout/add.php';?>
	</div>
	
	
	<div class="col-7">
		<div class="tips_box mb-5">
		<h4>Tips<img src="<?php echo ROOT?>cms/images/idea-32.png" style="display:inline-block; width:30px;"></h4>
			
			<div class="p-1">How to get Google map latitude & longitude coordinate?</div>
			<div class="p-1">Step 1:</div>
			<div class="p-1">
			Go <a href="https://www.google.com/maps" target="_blank">google map</a>. Lets say you want to create "Miri" as region, than search "Miri" in google map like below: 
				<img src="<?php echo ROOT?>cms/images/get_map_coordinate.png" width="100%">
			</div>
			<div class="p-1 pt-3">Step 2:</div>
			<div class="p-1">
				Green line part is latitude & Orange line part is longitude, copy paste accordingly.
				<img src="<?php echo ROOT?>cms/images/get_map_coordinate2.png" width="100%">
			</div>
		</div>
	</div>

	<?php }?>
</div>
<div class="row">
	<div class="col-12">
		<?php if(!$_GET['no_list']) include '../layout/list.php';?>
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
</script>


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>
</html>
<?php }?>