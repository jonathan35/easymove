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

$table = 'basic_commission';
$module_name = 'Basic Commission';
$php = 'basic_commission';
$folder = 'order';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by id DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array();
$filter = false;
$filFields = array('branch');


$actions=array('Delete');//, 'Activate', 'Suspend'//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');


$fields = array('id', 'max_distance', 'commission');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();



#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('3'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['max_distance'] = 'number';
$type['commission'] = 'number';

$label['max_distance'] = 'Max. Distance (KM)';
$label['commission'] = 'Commission (RM)';
$attributes['commission'] = array('step' => '.01');

/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$type['branch'] = 'select'; $option['branch'] = array();
$results = sql_read('select * from branch order by branch_name ASC');
foreach((array)$results as $a){
	$option['branch'][$a['id']] = ucwords($a['branch_name']);
}

$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';


$type['id'] = 'hidden';
$type['password'] = 'password';
$type['address'] = 'textarea';
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
$cols = array('Max. Distance (KM)' => '3', 'Commission (RM)' => '9');//Column title and width
$items['Max. Distance (KM)'] = array('max_distance');
$items['Commission (RM)'] = array('commission');



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
	<div class="col-5">
		<?php include '../layout/add.php';?>
	</div>
	<div class="offset-1 col-6">
		<div class="tips_box" style="">
			<h4>Tips<img src="<?php echo ROOT?>cms/images/idea-32.png" style="display:inline-block; width:30px;"></h4>
			<div class="p-1">
				Basic commission given to driver when complete delivered an order. Commission given base on the trip distance. <br>
				Example configuration:
			</div>
			<div class="p-1">
				<table class="table table-dark">
					<tr>
						<th>Trip Distance (kilometer)</th>
						<th>Commission (RM)</th>
					</tr>
					<tr>
						<td>Max. 5km</td>
						<td>RM10</td>
					</tr>
					<tr>
						<td>Max. 10km</td>
						<td>RM20</td>
					</tr>
				</table>
			</div>
			<div class="p-1">Completed an order trip distance 8KM gain RM10 commission.</div>
			<div class="p-1">Completed an order trip distance 10KM gain RM10 commission.</div>
			<div class="p-1">Completed an order trip distance 11KM gain RM15 commission.</div>
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