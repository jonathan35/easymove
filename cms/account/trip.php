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

$table = 'trip';
$module_name = 'Trip';
$php = 'trip';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';

if($_POST['sort'] == 'distance_asc'){
	$sort = 'order by trip_distance ASC';
}elseif($_POST['sort'] == 'distance_desc'){
	$sort = 'order by trip_distance DESC';
}elseif($_POST['sort'] == 'date_asc'){
	$sort = 'order by id ASC';
}else{
	$sort = 'order by id DESC';
}

unset($_POST['sort']);


$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array();
$filter = true;
$filFields = array('branch');



$actions=array('Delete');//, 'Activate', 'Suspend'//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');


if($_POST['add2020'] == 'Add'){
	$_POST['trip_balance'] = $_POST['topup_trip'];
}


$fields = array('id', 'branch', 'trip_distance', 'topup_trip', 'trip_price');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('3', '2'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['branch'] = 'number';
$type['trip_distance'] = 'number';
$label['trip_distance'] = 'trip distance (KM)';
$type['topup_trip'] = 'number';
$type['trip_balance'] = 'number';


/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$branch_ext = '';
if($_SESSION['group_id'] == 2){
	$branch_ext = " where region_id = '".$_SESSION['region']."'";
}


$type['branch'] = 'select'; $option['branch'] = array();
$results = sql_read("select * from branch $branch_ext order by branch_name ASC");
foreach((array)$results as $a){
	$option['branch'][$a['id']] = ucwords($a['branch_name']);
}

$placeholder['title'] = 'Title for profile page';
$attributes['trip_distance'] = array('required' => 'required');
$attributes['topup_trip'] = array('required' => 'required');
$attributes['trip_price'] = array('required' => 'required', 'placeholder' => 'Price pay by merchant (for reporting purpose)');

$type['id'] = 'hidden';
$type['trip_price'] = 'decimal';

//$type['password'] = 'password';
//$type['address'] = 'textarea';
//$type['position'] = 'number';
$type['created'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin');//,'2'=>'Admin'
//$type['status'] = 'select'; $option['status'] = array('1'=>'Activated','0'=>'Suspended');$default_option['status'] = '1';
$type['type'] = 'select'; $option['type'] = array('Headquarter'=>'Headquarter','Branch'=>'Branch');$default_option['type'] = 'Branch';


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
$cols = array('Merchant Branch' => '4', 'Trip Distance (KM)' => '2', 'Topup Trip' => '2', 'Topup Date' => '2', 'Trip Balance' => '2');//Column title and width
$items['Merchant Branch'] = array('branch');
$items['Trip Distance (KM)'] = array('trip_distance');
$items['Topup Trip'] = array('topup_trip');
$items['Topup Date'] = array('created');
$items['Trip Balance'] = array('trip_balance');


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


<div class="row">

	<?php if($add==true || $_GET['id']){?>
	<div class="col-12">
		<?php include '../layout/add.php';?>
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