<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

/*
1. session_start() function should be place at highest on a page, or else can cause it not working
2. session_regenerate_id() will use old session_id and generate new one for next loading but not current loading page.
3. call session_id() before session_regenerate_id() will result session_regenerate_id() fail to regenerate id for next loading.
*/


session_start();

if(!empty($_GET['session'])){
	if($_GET['session'] == 'reset'){
		$relogin_user = '';
		if($_SESSION['logged_in'] == 'YES' && !empty($_SESSION['user_id'])){
			$relogin_user = $_SESSION['user_id'];
		}
		session_regenerate_id();
		session_destroy();
		unset($_SESSION);
		session_start();

		if (isset($_SERVER['HTTP_COOKIE'])) {//to remove all cookie for all input value in cart form
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
				
			}
		}
		
	}
}

$session_id = session_id();
date_default_timezone_set('ASIA/KUALA_LUMPUR');

Class DBConnection{
	var $hostname_pamconnection = "localhost";
	var $database_pamconnection = "ocs";
	var $username_pamconnection = "ocsuser";
	var $password_pamconnection = "hoasd182oasdDs1";//611d9abb4de159a7dca62208eef35b1ba2fd33f93e3cc705
}

$DB = New DBConnection;

$pamconnection = mysqli_connect($DB->hostname_pamconnection, $DB->username_pamconnection, $DB->password_pamconnection) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_select_db($pamconnection, $DB->database_pamconnection);	


//$request_url_array = explode('/', $_SERVER['REQUEST_URI']);echo '<br>';
/*
if (!defined('APP_DIR')) {
	define('APP_DIR', basename(dirname(dirname(__FILE__))));
}
$root_dir = '/'.APP_DIR.'/';
$full_dir = 'http://'.$_SERVER['HTTP_HOST'].'/'.APP_DIR.'/';
*/



$REQUEST_URI = explode('/',$_SERVER['REQUEST_URI']);
if($_SERVER['SERVER_NAME'] == 'fyhonlinestore.com.my' || $_SERVER['SERVER_NAME'] == 'www.fyhonlinestore.com.my'){
	$root_dir = '/';
}else{
	$root_dir = '/'.$REQUEST_URI[1].'/';
}
if(isset($_SERVER["HTTPS"])) $http_type = 'https://'; else $http_type = 'http://';
$full_dir = $http_type.$_SERVER['SERVER_NAME'].'/';//.$REQUEST_URI[1].'/';
$REQUEST_URI = explode('/',$_SERVER['REQUEST_URI']);
$urlpieces = explode("/", $_SERVER['REQUEST_URI']);
$urlpiecescount = count($urlpieces) - 2;
$relative_root = str_repeat('../',$urlpiecescount);
$version = '?v='.date("ymdhis");


if (!defined('ROOT_F')) {
	define('ROOT_F', $full_dir);//This is full url root like http://domain.com/projectroot/, usefull for href link
}
if (!defined('ROOT_R')) {
	//define('ROOT_R', $relative_root);//This is relative url root like ../../projectroot/, usefull for include()
	define('ROOT_R', $root_dir);
}
if (!defined('ROOT_A')) {
	define('ROOT_A', $root_dir);//This is absolute url root like /projectroot/, usefull for src for image,js,css, etc
}
if (!defined('ENCRYPTION_KEY')) {
	define('ENCRYPTION_KEY', '5415426461280412780323a78478124387234892747370');
}


//To convert between human eye, url & query for database. - start
$filter_ori = array( '&', ' ');
$filter_url = array('and', '-', '&');
$filter_query = array( '%', '_', '%');
//To convert between human eye, url & query for database. - end


//USE FOR STR_REPLACE OF URL LINK - START
	$real_text = array("@","&","/","-","+"," ");
	$url_text = array("_ALIAS_","_AND_","_OR_","_DASH_","_PLUS_","_");
//USE FOR STR_REPLACE OF URL LINK - END

if(!get_magic_quotes_gpc()){

	// if(!empty($_POST)){
	
		// foreach($_POST as $key => $input){
			
			// if($key != 'txtname' && $key != 'txtpassword'){
				// if(!empty($input) && !is_array($input)){
					// if(preg_match('/[^A-Za-z0-9]/', $input)){
						// //echo $input.'<br/>';
						// //$value = addslashes($input);
						// //$value = mysql_real_escape_string($input);
						// //echo $value.'<br/>';				
						// //$_POST[$key] = $value;
					// }
				// }
			// }
		// }
	// }
}else{
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}




//Record salesman & customer last active time
if($_SESSION['auth_user']['id']){
	if($_SESSION['auth_user']['user_group'] == 'salesman' || $_SESSION['auth_user']['user_group'] == 'customer'){

		$exist_last_active = readFirst($pamconnection, 'last_active_log', "user_group = '".$_SESSION['auth_user']['user_group']."' and user_id='".$_SESSION['auth_user']['id']."'");
		if(!empty($exist_last_active['id'])){
			$last_active_log['id'] = $exist_last_active['id'];
		}
		$last_active_log['user_id'] = $_SESSION['auth_user']['id'];
		$last_active_log['user_group'] = $_SESSION['auth_user']['user_group'];
		$last_active_log['last_active'] = date('Y-m-d H:i:s');
		saveData($pamconnection, 'last_active_log', $last_active_log);
	}

}




function readData($pamconnection = null, $table_name = null, $condition = null, $order = null, $field = '*'){		
	$sql_query = '';
	$sql_order = '';
	
	if(isset($condition) && !empty($condition)){
		$sql_query = ' WHERE '.$condition;
	}
	
	if(isset($order) && !empty($order)){
		$sql_order = ' ORDER BY '.$order;
	}
	
	if($query = mysqli_query($pamconnection, "SELECT ".$field." FROM ".$table_name.$sql_query.$sql_order)){
		$num_rows = mysqli_num_rows($query);
	}
	if($num_rows > 0){
		$results = array();			
		$count = 0;
		while($result = mysqli_fetch_assoc($query)){
			$results[$count] = $result;
			$count++;
		}
		
		return $results;
	}else{
		return array();
	}
}

function countData($pamconnection = null, $table_name = null, $condition = null){		//, $order = null
	$sql_query = '';
	
	if(isset($condition) && !empty($condition)){
		$sql_query = ' WHERE '.$condition;
	}
	
	$num_rows = 0;
	
	$query = mysqli_query($pamconnection, "SELECT * FROM ".$table_name.$sql_query);
	if($query){
		if(mysqli_num_rows($query) > 0){
			$num_rows = mysqli_num_rows($query);
		}
	}
	return $num_rows;
}

function readFirst($pamconnection = null, $table_name = null, $condition = null, $order = null){		
	$sql_query = '';
	$sql_order = '';
	
	if(isset($condition) && !empty($condition)){
		$sql_query = ' WHERE '.$condition;
	}
	
	if(isset($order) && !empty($order)){
		$sql_order = ' ORDER BY '.$order;
	}

	$query = mysqli_query($pamconnection, "SELECT * FROM ".$table_name.$sql_query.$sql_order." LIMIT 1");
	$num_rows = mysqli_num_rows($query);
	
	if($num_rows > 0){
		$result = mysqli_fetch_assoc($query);
		
		return $result;
	}else{
		return array();
	}
}

function saveData($pamconnection = null, $table_name = null, $data = array()){
	
	$DB = New DBConnection;
	
	if(!isset($data['id']) && empty($data['created'])){
		$data['created'] = date('Y-m-d H:i:s');
	}
	if(empty($data['modified'])){
		$data['modified'] = date('Y-m-d H:i:s');
	}
	
	$results = mysqli_query($pamconnection,"SHOW COLUMNS FROM ".$table_name);//." FROM ".$DB->database_pamconnection
	
	$n = 0;		
	
	$filtered_col = array();
	$filtered_val = array();
	$filtered_col_val = array();
	
	while($result = mysqli_fetch_assoc($results)){
		
		if(isset($data[$result['Field']])){						
			$filtered_col[$n] = $result['Field'];			
			if($result['Type'] == 'text'){
				// $filtered_val[$n] = "'".$data[$result['Field']]."'";
				// $filtered_col_val[$n] = $result['Field']." = '".$data[$result['Field']]."'";
				$filtered_val[$n] = "'".mysqli_real_escape_string($pamconnection, $data[$result['Field']])."'";
				$filtered_col_val[$n] = $result['Field']." = '".mysqli_real_escape_string($pamconnection, $data[$result['Field']])."'";
			}else{				
				$filtered_val[$n] = "'".mysqli_real_escape_string($pamconnection, $data[$result['Field']])."'";
				$filtered_col_val[$n] = $result['Field']." = '".mysqli_real_escape_string($pamconnection, $data[$result['Field']])."'";
			}
			$n++;
		}
	}
		
	$str_cols = implode(', ',$filtered_col);
	$str_filtered_val = implode(', ',$filtered_val);
	$str_filtered_col_val = implode(', ',$filtered_col_val);
	
	if(!isset($data['id'])){
		$sql = mysqli_query($pamconnection,'INSERT INTO '.$table_name.'('.$str_cols.')VALUES('.$str_filtered_val.')');
	}else{
		
		if(is_numeric($data['id'])){
			$sql = mysqli_query($pamconnection,'UPDATE '.$table_name.' SET '.$str_filtered_col_val.' WHERE id='.$data['id']);
		}else{
			if(isset($data[$data['id']])){
				$sql = mysqli_query($pamconnection,'UPDATE '.$table_name.' SET '.$str_filtered_col_val.' WHERE '.$data['id'].'='.$data[$data['id']]);
			}
		}
		
	}
	
	if($sql){
		return true;
	}else{
		return false;
	}	
}

function deleteData($pamconnection = null, $table_name = null, $condition = null){		
	$sql_query = '';
	
	if(isset($condition) && !empty($condition)){
		$sql_query = ' WHERE '.$condition;
	}
	
	$query = mysqli_query($pamconnection, "DELETE FROM ".$table_name.$sql_query);
	if($query){
		return true;
	}else{
		return false;
	}
}


function selectInput($name = null, $options = array()){
	
	$input_id = str_replace(array(" "),array(""),ucwords(str_replace(array("_"),array(" "),$name)));
	$input_label = ucwords(str_replace(array("_id","_"),array(""," "),$name));
	$input_name = $name;
	$option_list = array();
	$selected_option = "";
	$empty_option = "";
	$div_tag = true;
	
	if(isset($options['id'])){$input_id = $options['id'];}
	if(isset($options['label'])){$input_label = $options['label'];}
	if(isset($options['name'])){$input_name = $options['name'];}
	if(isset($options['options'])){$option_list = $options['options'];}
	if(isset($options['value'])){$selected_option = $options['value'];}
	if(isset($options['empty'])){$empty_option = $options['empty'];}
	if(isset($options['div'])){$div_tag = $options['div'];}
	
	$input_attr = '';
	
	foreach($options As $input_attr_name=>$input_attr_val){
		if(in_array($input_attr_name,array('id','label','name','options','value','empty','div')) == false ){
			$input_attr .= $input_attr_name.'="'.$input_attr_val.'"'; 
		}
	}
	
	$select = '';
	
	if($div_tag){ $select .= '<div style="display:inline-block;">';}
	
	if($input_label){ $select .= '<label for="'.$input_id.'">'.$input_label.'</label>&nbsp;&nbsp;';}
	
	$select .= '<select id="'.$input_id.'" name="'.$input_name.'" '.$input_attr.'>';
	
	if(!empty($empty_option)){
		$select .= '<option value="">'.$empty_option.'</option>';
	}
	
	foreach($option_list As $value=>$option_name){		
		$select .= '<option value="'.$value.'" '.(($selected_option == $value) && !empty($selected_option) ? 'selected' : '').'>'.$option_name.'</option>';
	}
	
	$select .= '</select>';
	
	
	if($div_tag){ $select .= '</div>';}
	
	return $select;
}


function debug($debugData = array()){
	echo '<pre>';
	print_r($debugData);
	echo '</pre>';
}

function hex2rgb( $colour ) {
	if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
			return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

function removeSpace($ele){
	
	$ele = str_replace(" ","",$ele);
	
	return $ele;
}

?>
