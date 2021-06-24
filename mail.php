<?
$header = "MIME-Version: 1.0" . "\r\n";
$header.= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$header.= 'From: webmaster@easydelivery.com'. "\r\n";
//easydelivery.com.my not working
//fyhonlinestore.com.my not working

if(mail('jonathan.wphp@gmail.com', 'Subject', 'Content here', $header)){
	echo '111';	
}else{
	echo '222';		
}

/*

if(mail('vivian2001_ice@yahoo.com', 'Subject', 'Content here', $header)){
	echo 'aaaaaa';	
}else{
	echo 'bbbbbb';		
}

*/


?>
