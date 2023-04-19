<?php 
// Load the database configuration file 
include_once 'connectDB.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}
 
// Excel file name for download 
$fileName = "user-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'TEL', 'TYPE', 'AGE', 'DISTRICT' , 'PROVINCE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM user ORDER BY user_id ASC"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['user_id'], $row['user_firstname'], $row['user_lastname'], $row['user_email'], $row['user_tel'], $row['user_type'], $row['user_age'], $row['user_district'], $row['user_province']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
?>