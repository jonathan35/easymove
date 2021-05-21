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
$module_name = 'Orders';
$php = 'orders';
$folder = 'order';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by created DESC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array();
$filter = true;
$filFields = array('company', 'branch', 'driver');


if($_POST['add2020'] == 'Add'){
	$_POST['orders_balance'] = $_POST['topup_orders'];
}


$fields = array('id', 'branch');
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array('3', '1'));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}

$type['branch'] = 'number';
$type['orders_distance'] = 'number';
$label['orders_distance'] = 'orders distance (KM)';
$type['topup_orders'] = 'number';
$type['orders_balance'] = 'number';


/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}


$type['region'] = 'select'; $option['region'] = array();
$results = sql_read('select id, region from region where status =1 order by region ASC');
foreach((array)$results as $a){
	$option['region'][$a['id']] = ucwords($a['region']);
}
$type['zone'] = 'select'; $option['zone'] = array();
$results = sql_read('select id, zone from zone where status =1 order by region ASC');
foreach((array)$results as $a){
	$option['zone'][$a['id']] = ucwords($a['zone']);
}
$type['company'] = 'select'; $option['company'] = array();
$results = sql_read('select id, company_name from company where status=1 order by company_name ASC');
foreach((array)$results as $a){
	$option['company'][$a['id']] = ucwords($a['company_name']);
}
$type['branch'] = 'select'; $option['branch'] = array();
$results = sql_read('select id, branch_name from branch order by branch_name ASC');
foreach((array)$results as $a){
	$option['branch'][$a['id']] = ucwords($a['branch_name']);
}
$type['driver'] = 'select'; $option['driver'] = array();
$results = sql_read('select id, name, mobile_number from driver where status =1 order by name ASC');
foreach((array)$results as $a){
	$option['driver'][$a['id']] = ucwords($a['name']).' ('.$a['mobile_number'].')';
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

$type['status'] = 'select'; $option['status'] = array('Ordered'=>'New','Accepted'=>'Accepted','Collected'=>'Collected','Delivered'=>'Delivered'); $default_option['status'] = 1;

$type['type'] = 'select'; $option['type'] = array('Headquarter'=>'Headquarter','Branch'=>'Branch');$default_option['type'] = 'Branch';

$required['title'] = 'required';

$cols = $items =array();
$cols = array('ORDER' => '2', 'TIME' => '2', 'REGION & ZONE' => '2', 'COMPANY BRANCH' => '3', 'DISTANCE (KM)' => 2, 'DRIVER' => 1);


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
	<div class="col-12">
		
<!----------LIST START--------------------------------------->

<?php if($list != false){?>
<style>
.list_search_output {display:none; background:#EFEFEF; box-shadow:2px 2px 2px rgba(0,0,0,.5); color:#333; max-height:80vh; overflow-y:scroll; cursor:default; position:absolute; z-index:10;}
</style>
<?php 
if($_POST['action']=="Delete"){
	$items_delete_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_delete_array as $items_delete){
			$target_query = mysqli_query($conn, "SELECT * FROM $table WHERE id='$items_delete'") or die(mysqli_error());
			$target = mysqli_fetch_assoc($target_query);
			
			if(!empty($target)){
				if(!empty($target)){
					@unlink('../../'.$target['image']);
				}
				mysqli_query($conn, "DELETE FROM $table WHERE id='$items_delete'") or die(mysqli_error());
			}
		}
	}
}elseif(!empty($_POST['action'])){	
	$items_id_array=$_POST['productIdList'];
	if(!empty($_POST['productIdList'])){
		foreach((array)$items_id_array as $items_id){
			$data['id']=$items_id;
			$data[$db[$_POST['action']][0]]=$db[$_POST['action']][1];
			if(sql_save($table, $data));
		}
	}
}



include '../layout/list_cond.php';


if($_GET['tab'] == 'New' || $_GET['tab'] ==''){
	$tab = " and status='Ordered' ";
}elseif($_GET['tab']){
	$tab = " and status='".$_GET['tab']."' ";
}

$rows = sql_read('select id, region, zone, company, branch, branch_name, driver, distance, time, status, created from '.$table.' '.$condition.' '.$tab.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);
$count = sql_count("select id from ".$table.' '.$condition.' '.$condition_ext.' '.$sort, str_repeat('s',count($params)), $params);

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
    <h3>Orders</h3>
	<?php if($keyword==true || $filter==true){?>
		<div class="row" style="margin:10px 0;">
			<form class="col-12 pb-4" action="" method="post" enctype="multipart/form-data" target="_self">
			<div class="row">
            <span class="glyphicon glyphicon-search" style="color:gray;"></span>
            
        	<?php 
			if($keyword==true){
				include '../layout/keyword_search.php';
            }?>
			 
			 <?php 
			 if($filter==true){
			 foreach((array)$filFields as $field){
				if($type[$field] == 'datalist'){?>
                <input type="text" list="listlist<?php echo $field?>" value="<?php echo $option[$field][$_SESSION[$module_name.'-filter-'.$field]]?>" id="filterautoselect<?php echo $field?>" style="width:70%;"/>
                <datalist id="listlist<?php echo $field?>">
                    <?php foreach((array)$option[$field] as $option_v => $option_name){?>
                        <option value="<?php echo $option_name?>" <?php if($checked == $option_v){?> selected <?php }?> 
                        data-value="<?php echo $option_v?>"><?php echo $option_name?></option>
                    <?php }?>
                </datalist>
                <input type="hidden" name="<?php echo $field?>" id="filterautoselect<?php echo $field?>-hidden" value="<?php echo $_SESSION[$module_name.'-filter-'.$field]?>" >
                
				<?php }elseif($type[$field] == 'autosuggest'){?>
                    <input type="text" value="" class="search_input" id="search-input-filter-<?php echo $field?>"
                     autocomplete="off" data-input="filter-<?php echo $field?>" data-table="<?php echo $foreign_table[$field]?>" 
                     data-field="<?php echo $foreign_field[$field]?>" 
                     style="min-width:400px; padding:4px;" <?php foreach((array)$attributes[$field] as $a => $b){ echo $a.'="'.$b.'"'; }?>/>
                    <div class="search_output outputfilter-<?php echo $field?>">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <input type="hidden" name="<?php echo $field?>" id="hidden-filter-<?php echo $field?>" value="" >
                
                <?php }else{ ?>
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
		}?>
                
                &nbsp;&nbsp;<input type="submit" name="submit" value="Search">
				&nbsp;&nbsp;<input type="submit" name="submit" value="Reset">
			</div>
			</form>
		</div>
	<?php }?>
    
	<form class="" action="" method="post" enctype="multipart/form-data" target="_self">
	
	<div class="col">
		<div id="tab" class="row">
			<ul class="nav nav-tabs" style="">
				<?php 
				$v = 1;
				foreach((array)$option['status'] as $v => $l){
					
					$params[0] = $v;
					
					$s_count = sql_count("select * from $table where status=? $condition_ext", str_repeat('s', count($params)), $params);
					?>
					<a href="?tab=<?php echo $l?>" class="content">
					<li <?php if((empty($_GET['tab']) && $v == 'Ordered') || $_GET['tab'] == $l){?>class="active"<?php }?>>
					<?php echo $l?> ( <?php echo $s_count;?> )
					</li></a>
				<?php }?>
			</ul>
		</div>
	</div>
    

	<table class="table table-striped" width="100%" id="item_list" style="position:relative; top: -4px; ">
	<thead>    
		<?php if($list_method=='list'){?>
		<tr>
			<th style="width:2% !important;"></th>
			<?php 
			if($edit==true){	$usable_width = 88/12;	}else{	$usable_width = 96/12;}
			$c=2;
			foreach((array)$cols as $colName => $colWidth){?>
				<th style="
					width:<?php echo $usable_width*$colWidth;?>%; 
					<?php if($list_sort){?>cursor:pointer;<?php }?>
				" 
				<?php if($list_sort){?> onClick="sortTable('#item_list', '<?php echo $c;?>')" <?php }?>
				>
					<?php echo $colName?>
					<?php if($list_sort){?>&#8597;<?php }?>
				</th>
			<?php }?>		
		</tr>
		<?php }?>
    

    </thead>
	<tbody>
    
	<?php 
	if($count>0){
		
	$itemCount=1;
	$maxPerPage=20;
		if($list_method=='list'){
        foreach((array)$rows as $val){

			if(!empty($val['date'])){
				$val['date'] = substr($val['date'],8,2).'/'.substr($val['date'],5,2).'/'.substr($val['date'],0,4);
			}

			$c=1;
			
			$refresher = 'refresher'.$defender->encrypt('encrypt', $val['id']);

			?>
            <tr class="page page<?php echo $itemCount?> <?php echo 'tr'.$refresher?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>" id="row<?php echo $val['id']?>">
			
                <td style="width:2% !important;">
					<?php if(!empty($actions)){?>
                    	<input type="checkbox" value="<?php echo $val['id']; ?>" name="productIdList[]">
					<?php }?>
                    <input type="hidden" name="id" value="<?php echo $val['id'];?>" />
                </td>
				<td>
					<div link="<?php echo ROOT?>admin_order/<?php echo $defender->encrypt('encrypt', $val['id'])?>" target="_blank" style="font-size:16px" class="mymodal-btn btn btn-xs btn-default list-edit ref-btn" ><?php echo sprintf("%06d", $val['id']);?></div>
                </td>
				<td>
					<?php echo date('d/m/y, g:i a', strtotime(substr($val['created'],0,10).' '.$val['time'].':00'));?>
                </td>
				<td>
					<?php echo $option['region'][$val['region']] ?: '-'; ?> > 
					<?php echo $option['zone'][$val['zone']] ?: '-'; ?>
                </td>
				<td>
					<?php echo $val['branch_name'] ?: '-'; ?>
                </td>
				<td>
					<?php echo $val['distance'].'KM' ?: '-';?>
                </td>
				<td>
					<?php echo $option['driver'][$val['driver']] ?: '-';?>
                </td>
				

            </tr>
        <?php 
		  $itemCount++;
		  }
		}?>
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



function removeThis(id){//alert(id);
	$.ajax({url: "layout/remove_item.php?table=<?php echo $table?>&id="+id, success: function(result){
		$("#row"+id).html(result).delay(2000).fadeOut();
	}});
}



function confirmAction(msg){
	var point = confirm(msg);
	if(point==true){
		var id= new Array('productIdList[]');
		if(id==''){
			alert("No Item Selected");
			return false;
		}
		return true;
	}else{
		return false;
	}
}

</script>
        

<style>
.modal {  z-index:5000;}
.modal-dialog {width:80% ; margin:50px auto;}

</style>
<?php }?>
<!----------LIST END--------------------------------------->

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