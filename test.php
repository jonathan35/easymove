<?php 
$headers[] = 'From: Tester';
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

$this_mail = mail('jonathan.wphp@gmail.com', 'Test', 'mssage', implode("\r\n", $headers));

print_r($this_mail);

if($this_mail) echo 'sent!';
else echo error_message();
?>