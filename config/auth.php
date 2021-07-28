<?php 
include_once 'config/ini.php';
require_once 'config/security.php';


class auth{

	/*
	Function
	1. register - to register new account
	2. login - to login user	
	*/
	

	function register(){


		global $defender;

		$validate_username = sql_read('SELECT * FROM merchant WHERE username=? LIMIT 1', 's', $_POST['username']);
		
		if(!empty($validate_username)){
		
			$_SESSION['session_msg'] = '<div class="sm alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
			Email not available, please use other username.</div>';
			
		}elseif($_POST['password'] != $_POST['confirm_password']){
		
			$_SESSION['session_msg'] = '<div class="sm alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
					Password not match, please try again.</div>';


		}elseif(empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['region'])){
			
			$_SESSION['session_msg'] = '<div class="sm alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
			Name, Email, Password & Region must not be empty.</div>';

		}else{

			$data['name'] = $_POST['name'] ;
			$data['username'] = $_POST['username'];
			$data['mobile_number'] = $_POST['mobile'];
			$data['region'] = $defender->encrypt('decrypt', $_POST['region']);
			$data['area'] = $defender->encrypt('decrypt', $_POST['area']);
			$data['address'] = $_POST['address'];
			$data['password'] = hash('md5',$_POST['password']);
			$data['status'] = 'Activated';
			

			if(sql_save('merchant', $data)){
				$_SESSION['session_msg'] = '<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
					Signup successfully.</div>';

				$this->login($username, $data['password']);

			}else{

				$_SESSION['session_msg'] = '<div class="sm alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
					Failed to signup, please try agian.</div>';


			}
		}
	}



	function login($username = null, $password = null){
		
		/*-------------------------------------------------------
		Only Auto login trigger after register() provide $username & $password, otherwise $_POST['username'] &  $_POST['password'] must be provided
		-------------------------------------------------------------*/
		
		global $user, $logged_in;


		if(!empty($_POST['username'])) $username = $_POST['username'];
		if(!empty($_POST['password'])) $password = $_POST['password'];

		$password = hash('md5',$password);
		
		
		$_SESSION['auth_user'] = array();
		$_SESSION['session_msg'] = '<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
			style="position:relative; top:-2px;">×</a>
			Enter username and password to sign in.</div>';	

		$auth_user = sql_read("
		SELECT m.id, m.username, m.status,  
		b.region_id as region, r.region as region_name, m.company, c.company_name, m.branch, b.branch_name, 
		b.type, b.contact_person, b.mobile_number, 
		b.address, b.branch_location, b.branch_location_coordinate 
		from merchant as m 		
		inner JOIN company AS c ON c.id = m.company 
		inner JOIN branch AS b ON b.id = m.branch
		inner JOIN region AS r ON r.id = b.region_id		
		WHERE username=? AND (password=? OR temp_password=?) limit 1", 
		'sss', array($username, $password, $password));


		if(empty($auth_user)){
			$_SESSION['session_msg'] = '<div class="sm alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
			Username or password is wrong.</div>';
		}elseif($auth_user['status'] == '0'){//suspended
			$_SESSION['session_msg'] = '<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
					Account suspended, please contact administrator.</div>';
		}elseif($auth_user['status'] == '1'){//activated			
			
			
			//--------------login log----------------
			if(!empty($auth_user['id'])){
				$visitor = 'accounts:'.$auth_user['id'];
			}
			//$login_logout = 'signin';
			//include_once 'ip.php';

			//--------------last login date----------------
			$data = array();
			$data['id'] = $auth_user['id'];
			//$data['last_login'] = date('Y-m-d');
			$data['temp_password'] = '';
			
			sql_save('merchant', $data);

			//--------------Set session----------------			
				unset($_SESSION['auth_user']);
				unset($_SESSION['user_id']);
				//$_SESSION['logged_in'] = $logged_in = 'YES';				
				$_SESSION['auth_user'] = $auth_user;//$user = 

				$_SESSION['session_msg'] = '<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
				Sign in successfully.</div>';
		
		}
	}


	function forget_password(){

		global $conn;

		$_SESSION['session_msg'] = '<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Failed to send email, please try later.</div>';

		if(!empty($_POST['email'])){
		
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$account = sql_read('select * from merchant where username=? limit 1', 's', $email);
			
			if(!empty($account['id'])){
			
				$data = array();
				$data['id'] = $account['id'];
				$tmp_password = uniqid();
				$data['temp_password'] = hash('md5',$tmp_password);
				
				sql_save('merchant', $data);

				//$name = $account['email'];
				$to = $email;
				$subject = 'Forget Password';
				$header = "From: ".$_SERVER['SERVER_NAME']."\r\n";
				$header .= "MIME-Version: 1.0" . "\r\n";
				$header .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$content = '
					<!DOCTYPE html>
					<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Forget Password</title>
					</head>
					<body>
						Dear Valued Customer,<br><br>
						You have requested a new temporary password. You may use this temporary password for one time only. Please change your password after login.<br><br>
						Password : '.$tmp_password.'<br><br>
						Please ignore this message if you manage to login.<br><br>
						**This is automate email, do not reply to this email.
					</body>
					</html>';
	
				$post = ['to' => $to, 'subject' => $subject, 'content' => $content, 'header' => $header];

				$ch = curl_init('http://ihosting360.com/lps/mail.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				$response = curl_exec($ch);
				curl_close($ch);


				//if(mail($to, $subject, $content, $header)){
					$_SESSION['session_msg'] = '<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Temporary password sent to your mail box successfully, please check your inbox/spam box.</div>';
				//}
			}
		}
	}


}

$auth = new auth;

if($_POST['action'] == 'signup') $auth->register();

if($_POST['action'] == 'signin') $auth->login();

if($_POST['action'] == 'reset_password') $auth->forget_password();


?>