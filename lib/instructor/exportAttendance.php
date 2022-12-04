<?php
// Load the database configuration file 
include_once '../connection.php';

// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download 
$fileName = "Teacher-Attendance-" . date('m-d-y') . ".xls";

// Column names 
$fields = array('Fullname', 'Date', 'Login', 'Logout');

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$select = $pdo->prepare("SELECT * FROM `attendance_instructor` ORDER BY id  ASC");
$select->execute();

if ($select->rowCount() > 0) {

    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['fullname'], $row['date_in'], $row['time_in'], $row['time_out']);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else {
    $excelData .= 'No records found...' . "\n";
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
echo $excelData;

exit;
