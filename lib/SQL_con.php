<?php   
$host = "localhost";
$db_uname = "root";
$db_pass = "";
$db_name = "rfid_attendance";

//connection
$pdo = mysqli_connect($host,$db_uname,$db_pass,$db_name);

//check connection
if (!$pdo) {
die ("Connection Failed" . mysqli_connect_errno());
}
?>