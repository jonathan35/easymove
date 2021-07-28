<?

$to = $_POST['to'];
$subject = $_POST['subject'];
$content = $_POST['content'];
if(!empty($_POST['header'])){
	$header = $_POST['header'];
}else{
	$header = "MIME-Version: 1.0" . "\r\n";
	$header.= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$header.= 'From: master@easymovenpick.com'. "\r\n";
	
}
$content = $_POST['content'];


if(mail($to, $subject, $content, $header)){
	echo 'sent';
}else{
	echo 'not sent';		
}
?>
