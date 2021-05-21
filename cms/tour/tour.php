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

$table = 'tour';
$module_name = 'Tour Package';
$php = 'tour';
$folder = 'tour';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = " order by position ASC, created DESC limit 500";
$more_photos = false;


$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name');
$filter = true;
$filFields = array('location', 'category');


$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

$unique_validation=array('tier');

$fields = array('id', 'location', 'category', 'photo',  'name', 'price', 'duration', 'departure', 'physical_level', 'min_travellers', 'stock', 'validity_from', 'validity_to', 'sunday_sales', 'monday_sales', 'tuesday_sales', 'wednesday_sales', 'thursday_sales', 'friday_sales', 'saturday_sales', 'position', 'status', 'description');//brief_description



$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('9', '13'), 1 => array(1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$child['location'] = true;
$type['location'] = 'select'; $option['location'] = array();
$results = sql_read('select * from location where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['location'][$a['id']] = ucwords($a['location']);
}


$parent['category'] = 'location'; $parent_val['category'] = array();
$type['category'] = 'select'; $option['category'] = array();
$results = sql_read('select * from category where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['category'][$a['id']] = ucwords($a['category']);
	if(!empty($parent['category'])){
		$parent_val['category'][$a['id']] = $a[$parent['category'] ];
	}
}


$type['id'] = 'hidden';
$type['photo'] = 'image';
$type['password'] = 'password';
$type['min_travellers'] = 'number';
$label['min_travellers'] = 'Min. Travellers';
$type['stock'] = 'number';
$label['stock'] = 'Max. Travellers';
$type['position'] = 'number';


$type['validity_from'] = 'date';
$type['validity_to'] = 'date';
$type['brief_description'] = 'textarea'; $tinymce['brief_description']=false;  $labelFullRow['brief_description']=false; $height['brief_description'] = '180px;'; $width['brief_description'] = '100%;'; $tinymce_photo['description'] = false;
$type['description'] = 'textarea'; $tinymce['description']=true;  $labelFullRow['description']=true; $height['description'] = '300px;'; $width['description'] = '100%;'; $tinymce_photo['description'] = true;
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
$type['popular'] = 'select'; $option['popular'] = array('No'=>'No', 'Yes'=>'Yes'); $default_value['popular'] = 'No';
$type['physical_level'] = 'select'; $option['physical_level'] = array(''=>'Select one','Soft'=>'Soft','Medium'=>'Medium','Hard'=>'Hard'); $default_value['physical_level'] = '';
$type['sunday_sales'] = 'radio'; $option['sunday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['sunday_sales'] = 'Yes';
$type['monday_sales'] = 'radio'; $option['monday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['monday_sales'] = 'Yes';
$type['tuesday_sales'] = 'radio'; $option['tuesday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['tuesday_sales'] = 'Yes';
$type['wednesday_sales'] = 'radio'; $option['wednesday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['wednesday_sales'] = 'Yes';
$type['thursday_sales'] = 'radio'; $option['thursday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['thursday_sales'] = 'Yes';
$type['friday_sales'] = 'radio'; $option['friday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['friday_sales'] = 'Yes';
$type['saturday_sales'] = 'radio'; $option['saturday_sales'] = array('Yes'=>'Yes', 'No'=>'No'); $default_value['saturday_sales'] = 'Yes';


$attributes['stock'] = array('placeholder' => 'Max. travellers per day');
$attributes['min_travellers'] = array('placeholder' => 'Min. travellers per booking');
$attributes['category'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['bedrooms'] = array('placeholder' => 'Bedrooms Count', 'max' => '99');
$attributes['bathrooms'] = array('placeholder' => 'Bathrooms Count', 'max' => '99');
$attributes['size'] = array('placeholder' => 'Size in square feet');
$attributes['name'] = array('placeholder' => 'Tour Name');
$attributes['location'] = array('placeholder' => 'tour Location');
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

echo '</div>';
*/
$cols = $items =array();

$cols = array('Location & Category' => '3', 'Tour' => '2', 'Name' => '6', 'Position' => '1');//Column title and width
$items['Location & Category'] = array('location', 'category', 'tour_type');
$items['Tour'] = array('photo');
$items['Name'] = array('name', 'price', 'duration', 'departure');
$items['Popular'] = array('popular');
$items['Position'] = array('position');


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
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+3Y +6M +1D", dateFormat: 'yy-mm-dd' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>


<div class="row">
	<?php if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_tour').fadeToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }?>
	
	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_tour<?php }?>">
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


<?php if(empty($_GET['id'])){?>


	<script>

	$(document).ready(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=location]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=category]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=area]").change(function(){
		auto_fill_min();
	})


	function auto_fill_min(){

		$("input[name=min_checkout_price]").attr('readonly', 'readonly');
		
		var location = $(".div_input > select[name=location]").val();
		var category = $(".div_input > select[name=category]").val();		
		var area = $(".div_input > select[name=area]").val();

		$.post('get_min.php', {location:location, category:category, area:area}, function(return_fee){
			$("input[name=min_checkout_price]").val(return_fee);
		})

	}
	</script>

<?php }?>


</html>
<?php }?>