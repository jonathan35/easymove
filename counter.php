<?php
require_once 'config/ini.php';

$fields = sql_read("SELECT * FROM counter where id=? limit 1", 'i', 1);
echo $fields['counter'].' visitors | ';


$timestamp = time();
$timeout = $timestamp - 300;
$ip = $_SERVER['REMOTE_ADDR'];


mysqli_query($conn, "INSERT INTO useronline VALUES ('$timestamp','$ip','$PHP_SELF')") or die(mysql_error());
mysqli_query($conn, "DELETE FROM useronline WHERE timestamp<$timeout") or die(mysql_error());
$result = mysqli_query($conn, "SELECT DISTINCT ip FROM useronline WHERE file='$PHP_SELF'") or die(mysql_error());
$user = mysqli_num_rows($result);
//mysql_close();

echo $user." Online";
?>

