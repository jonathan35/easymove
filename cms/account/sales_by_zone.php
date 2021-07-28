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

$table = 'orders';
$module_name = 'Sales by Zone/Merchant';
$php = 'orders';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by id DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('orders', 'contact_person');
$filter = true;
$filFields = array('zone', 'branch');

//$actions = array('Delete', 'Activate', 'Suspend');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');


$fields = array('id', 'zone', 'merchant');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('9', '2'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['orders_location'] = 'map';
$type['orders_location_coordinate'] = 'coordinate';

$label['region_id'] = 'Region';
$label['company_id'] = 'Company';

$label['no_internet'] = 'Collection area no internet';

$labelFullRow['orders_location'] = true;

/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}



$type['zone'] = 'select'; $option['zone'] = array();
$results = sql_read('select * from zone where status=1 order by zone ASC');
foreach((array)$results as $a){
	$option['zone'][$a['id']] = ucwords($a['zone']);
}

$type['branch'] = 'select'; $option['branch'] = array();
$results = sql_read('select * from branch order by branch_name ASC');
foreach((array)$results as $a){
	$option['branch'][$a['id']] = ucwords($a['branch_name']);
}

$type['trip'] = 'select'; $option['trip'] = array();
$results = sql_read('select * from trip');
foreach((array)$results as $a){
	$option['trip'][$a['id']] = ucwords($a['trip_price']);
}

$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';


$type['id'] = 'hidden';
$type['password'] = 'password';
$type['address'] = 'textarea';
//$type['position'] = 'number';
//$type['publish_date'] = 'date';
//$type['address'] = 'textarea'; $tinymce['address']=false;  $labelFullRow['address']=false; $height['address'] = '80px;'; $width['address'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin');//,'2'=>'Admin'
$type['status'] = 'select'; $option['status'] = array('1'=>'Activated','0'=>'Suspended');$default_option['status'] = '1';
$type['type'] = 'select'; $option['type'] = array('Headquarter'=>'Headquarter','Branch'=>'Branch');$default_option['type'] = 'Branch';
$type['no_internet'] = 'select'; $option['no_internet'] = array('with internet'=>'With Internet','no internet'=>'No Internet');$default_option['no_internet'] = 'Branch';


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
$cols = array('Branch' => '3', 'Sales' => '3', 'Date' => '3');//Column title and width
$items['Branch'] = array('branch');
$items['Sales'] = array('trip');
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


	<div class="col-12 add_panel <?php if($_GET['no_list'] != 'true'){?>collapse add_page<?php }?>">
TOTAL:
	</div>

</div>
<div class="row">
	<div class="col-12">
		
	

	<?php if($list != false){?>
<style>
.list_search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:10;}
</style>
<?php 
	
include '../layout/list_cond.php';



$condition_ext = preg_replace('/' . preg_quote("AND (year='") .'.*?' .preg_quote("' )") . '/', '', $condition_ext);
$condition_ext = preg_replace('/' . preg_quote("AND (month='") .'.*?' .preg_quote("' )") . '/', '', $condition_ext);

if(!empty($_SESSION['Sales by Zone/Merchant-filter-year'])){
	$y = $_SESSION['Sales by Zone/Merchant-filter-year'];
	$condition_ext .= " and created like '".$y."-__-__%' ";
}

if($_SESSION['Sales by Zone/Merchant-filter-month']){
	$m = $_SESSION['Sales by Zone/Merchant-filter-month'];
	$condition_ext .= " and created like '__-".$m."-__%' ";
}

/*
if($condition_ext){
	echo $condition_ext;
}
//echo 'select * from '.$table.' '.$condition.' '.$condition_ext.' '.$sort;
debug($params);

debug($rows);
*/

$rows = sql_read('select branch_name, id, created, trip from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count('select id from '.$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);

?>

<style>
.titleBlockInList {margin-top:4px; font-size:15px;}
.blockInList {margin-top:4px;;}
.thum {
	width:100%; height:100px; background-size:cover; background-position:center; background-repeat:no-repeat; border:1px solid #CCC;
}
.span_label { text-transform:capitalize; color:#999; display:none;}
.span_label::after { content:":"; }
<?php 
if($list_method == 'list'){
if($edit==true){?>
	.edit_column {width:82% !important;}
<?php }else{?>
	.edit_column {width:96% !important;}
<?php }
}?> 
</style>
<div class="row">
<div class="col-12">
    <h3>List <?php echo $module_name;?></h3>
	<?php 
        if($table == 'packages' || $table == 'project_details' || $table == 'project_photos' || $table == 'project_pdfs' || $table == 'causes_of_delay' || $table == 'contractual_issues'){ 
			if(!empty($_SESSION['proj_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:orange; line-height:1.5;">'.$_SESSION['proj_name'].'</div>';
			}
			if(!empty($_SESSION['pack_name'])){
				echo '<div style="padding-bottom:20px; font-size:16px; color:green; line-height:1.5;">'.$_SESSION['pack_name'].'</div>';
			}
		}
	?>
	
	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form class="col-12 pb-4" action="" method="post" enctype="multipart/form-data" target="_self">
			<div class="row">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
        
			 <?php 
			 if($filter==true){
			 foreach((array)$filFields as $field){?>
				<div class="col-2">
				<select name="<?php echo $field?>">
					<option value="">All <?php echo str_replace("_", " ", $field)?></option>
					<?php 
					foreach((array)$option[$field] as $option_v => $option_name){                        
						$countItem = sql_count('select * from '.$table.' where '.$field.'=?', 's', $option_v);
						if($countItem>0){
							$c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
						}else{
							$c = '';
						}
					?>
					<option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name;?></option>
					<?php }?>
				</select>
				</div>
			<?php 
			}
		}
		
		$max_year = date('Y');
		
		
		?>
				<div class="col-2">
					<select name="year" id="">
						<option value="">All years</option>
						<?php for($y=2021; $y<=$max_year; $y++){?>
						<option value="<?php echo $y?>" <?php if($y==$_SESSION['Sales by Zone/Merchant-filter-year']){?>selected<?php }?>><?php echo $y?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-2">
					<select name="month" type="text">
						<option value="">All months</option>
						<option value="01" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='01'){?>selected<?php }?>>Jan</option>
						<option value="02" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='02'){?>selected<?php }?>>Feb</option>
						<option value="03" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='03'){?>selected<?php }?>>Mar</option>
						<option value="04" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='04'){?>selected<?php }?>>Apr</option>
						<option value="05" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='05'){?>selected<?php }?>>May</option>
						<option value="06" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='06'){?>selected<?php }?>>Jun</option>
						<option value="07" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='07'){?>selected<?php }?>>Jul</option>
						<option value="08" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='08'){?>selected<?php }?>>Aug</option>
						<option value="09" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='09'){?>selected<?php }?>>Sep</option>
						<option value="10" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='10'){?>selected<?php }?>>Oct</option>
						<option value="11" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='11'){?>selected<?php }?>>Nov</option>
						<option value="12" <?php if($_SESSION['Sales by Zone/Merchant-filter-month']=='12'){?>selected<?php }?>>Dec</option>
					</select>
				</div>
                
                &nbsp;&nbsp;<input type="submit" name="submit" value="Search">
				&nbsp;&nbsp;<input type="submit" name="submit" value="Reset">
			</div>
			</form>
		</div>
	<?php }?>
    
	<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
	

	<table class="table table-striped" width="100%" id="item_list">
	<thead>    
		<tr>
			<th style="width:2% !important;"></th>
			<th>Branch</th>
			<th>Sales</th>
			<th>Date</th>
		</tr>
    </thead>
	<tbody>
    
	<?php 
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=50;

	$total = 0;
	
        foreach((array)$rows as $val){

			$total += $option['trip'][$val['trip']];
		
			?>
            <tr class="page page<?php echo $itemCount?> " style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">
			
                <td style="width:2% !important;">
					<?php echo $itemCount?>
                </td>
				<td>
					<?php echo $val['branch_name'];?>
                </td>
				
				<td>
					<?php echo date_format(date_create($val['created']), 'd/m/y, g:i a');
					?>
				</td>
				<td>
					<?php 
					
					echo 'RM'.$option['trip'][$val['trip']];?>
                </td>
            </tr>
        <?php 
		$itemCount++;
		}
		?>

			<tr>
				<td></td>
				<td></td>
				<td style="text-align:right; font-weight:bold;">Total</td>
				<td style="text-align:left; font-weight:bold;">RM<?php echo $total?></td>
			</tr>
        </tbody>
		</table>
        <?php include("../../paging.php");?>
        
	<?php }else{?>
		<table>
        	<tr><td>No record found</td></tr>
		</table>
    <?php }?>
</form>
</div>
</div>


<?php include '../layout/mymodal.php';?>

<script>

	
function sortTable(table, col) {
	
	thead =$(table).find('thead');
	tbody =$(table).find('tbody');
	
	var ss = thead.find('th:nth-child('+col+')').attr('sorting');
	if (ss=='desc') {
		thead.find('th:nth-child('+col+')').attr('sorting','asc');
		var asc = 'desc';
	} else {
		thead.find('th:nth-child('+col+')').attr('sorting','desc');
		var asc = 'asc';
	}
	
    tbody.find('tr').sort(function(a, b) {
        if (asc == 'asc') {
            return $('td:nth-child('+col+')', a).text().localeCompare($('td:nth-child('+col+')', b).text());
        } else {
            return $('td:nth-child('+col+')', b).text().localeCompare($('td:nth-child('+col+')', a).text());
        }
    }).appendTo(tbody);
    
}


(function(){ 
	var current_tab='<?php echo $_GET['tab'];?>';
	if(current_tab==''||current_tab=='display'){
		$("#display_tab").attr('class', 'current');$("#hide_tab").attr('class', '');
	}else{
		$("#hide_tab").attr('class', 'current');$("#display_tab").attr('class', '');
	}
})()


<?php }?>



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