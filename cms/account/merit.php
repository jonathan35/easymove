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


if($_POST['driver']){
	$d_data['id'] = $_POST['driver'];
	$r_driver = sql_read('select id, merit from driver where id=? limit 1', 'i', $d_data['id']);
	
	if($r_driver['id']){
		$d_data['merit'] = $r_driver['merit'] + $_POST['points'];
		sql_save('driver', $d_data);
	}
}


$table = 'merit';
$module_name = 'Merit Ad-Hoc';
$php = 'merit';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by id DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array();
$filter = true;
$filFields = array('driver');


$actions=array('Delete', 'Activate', 'Suspend');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');



$fields = array('id', 'driver', 'points', 'note');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('4'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['points'] = 'number';
$type['topup_merit'] = 'number';

/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$type['driver'] = 'select'; $option['driver'] = array();
$results = sql_read('select * from driver where status =1 order by name ASC');
foreach((array)$results as $a){
	$option['driver'][$a['id']] = ucwords($a['name'] .' ('. $a['merit'].'p)');
}

$placeholder['title'] = 'Title for profile page';
$attributes['note'] = array('required' => 'required');

$type['id'] = 'hidden';
$type['password'] = 'password';
$type['note'] = 'textarea';
$type['created'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin');//,'2'=>'Admin'
//$type['status'] = 'select'; $option['status'] = array('1'=>'Activated','0'=>'Suspended');$default_option['status'] = '1';

$required['title'] = 'required';


$cols = $items =array();
$cols = array('Driver' => '5', 'Points' => '2', 'Reason' => '3', 'Date' => '2');//Column title and width
$items['Driver'] = array('driver');
$items['Points'] = array('points');
$items['Reason'] = array('note');
$items['Date'] = array('created');




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

	<?php /*if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_page').slideToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }*/?>


	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 "><?php /*if($_GET['no_list'] != 'true'){?>collapse add_page<?php }*/?><!--add_panel-->
		<div class="row">
			<div class="col-6">
				<?php include '../layout/add.php';?>
			</div>
			<div class="offset-1 col-5">
				<div class="tips_box">
				<h4>Tips<img src="<?php echo ROOT?>cms/images/idea-32.png" style="display:inline-block; width:30px;"></h4>
					<div class="p-1">Points number for merit.</div>
					<div class="p-1">Negative points number for demerit.</div>
					<div class="p-1">Can use for ad-hoc or withdraw purpose.</div>
				</div>
			</div>
			

		</div>
	</div>
	<?php }?>
	
	
</div>
<div class="row">
	<div class="col-12">
		<?php //if(!$_GET['no_list']) include '../layout/list.php';?>
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