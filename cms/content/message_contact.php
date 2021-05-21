<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Area:../authentication/login.php");
}

$table = 'message_contact';
$module_name = 'Merchant Application';
$php = 'message_contact';
$folder = 'content';//auto refresh row once edit modal closed
$add = false;
$edit = false;
$read = true;
$list = true;
$list_method = 'list';
$sort = " order by id DESC limit 500";
$more_photos = false;


$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'email');
$filter = false;
$filFields = array('region');


$actions=array('Delete', 'New', 'Read', 'Replied');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['New']='Set as "New"';	$db['New']=array('status', 'New');
$msg['Read']='Set as "Read"';			$db['Read']=array('status', 'Read');
$msg['Replied']='Set as "Repied"';	$db['Repied']=array('status', 'Repied');


$unique_validation=array('tier');

$fields = array('id', 'region', 'zone', 'company_name', 'business_field', 'mobile_number', 'address', 'status', 'date');

$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('5', '6'), 1 => array(1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}
/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$label['size'] = 'Size (sq.ft.)';

$child['region'] = true;
$type['region'] = 'select'; $option['region'] = array();
$results = sql_read('select * from region where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['region'][$a['id']] = ucwords($a['region']);
}


$parent['zone'] = 'region'; $parent_val['zone'] = array();
$type['zone'] = 'select'; $option['zone'] = array();
$results = sql_read('select * from zone where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['zone'][$a['id']] = ucwords($a['zone']);
	if(!empty($parent['zone'])){
		$parent_val['zone'][$a['id']] = $a[$parent['zone'] ];
	}
}


$type['id'] = 'hidden';
$type['photo'] = 'image';
$type['password'] = 'password';
$type['bedrooms'] = 'number';
$type['bathrooms'] = 'number';
$type['position'] = 'number';
$type['date'] = 'date';
$type['description'] = 'textarea'; $tinymce['description']=true;  $labelFullRow['description']=false; $height['description'] = '200px;'; $width['description'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('New'=>'New','Read'=>'Read','Replied'=>'Replied'); $default_value['status'] = 'New';
$type['new'] = 'select'; $option['new'] = array('Yes'=>'Yes','No'=>'No'); $default_value['new'] = 'Yes';


$attributes['region'] = array('required' => 'required');
$attributes['zone'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['bedrooms'] = array('placeholder' => 'Bedrooms Count', 'max' => '99');
$attributes['bathrooms'] = array('placeholder' => 'Bathrooms Count', 'max' => '99');
$attributes['size'] = array('placeholder' => 'Size in square feet');
$attributes['name'] = array('placeholder' => 'Message Name');
$attributes['location'] = array('placeholder' => 'Message Location');
$attributes['position'] = array('placeholder' => 'A number for sorting');

$remark['photo'] = 'Recommanded size: 1200 x 1000 pixel';


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


$cols = array('Company' => '2', 'Geograpical' => '2', 'Contact/Address' => '4', 'Date' => '2', 'Status' => '2');//Column title and width

$items['Company'] = array('company_name', 'business_field');
$items['Geograpical'] = array('region', 'zone');
$items['Contact/Address'] = array('mobile_number', 'address');
$items['Date'] = array('date');
$items['Status'] = array('status');


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
	<?php if($read==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_tour<?php }?>">
		<?php include '../layout/read.php';?>
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