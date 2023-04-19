<?php
  
    header('Access-Control-Allow-Origin: *');  
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

  
    // if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {

        
        $FileName = $_FILES['file']['name']; 
        $target_file = "upload/" . basename($_FILES["file"]["name"]);
 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // Valid file extensions
   $extensions_arr = array("jpg","jpeg","png","gif");
 // $Name=$_FILES["file"]["name"]; 
// $Size=$_FILES["file"]["size"]; 
// $Type=$_FILES["file"]["type"]; 
// $DataImage = file_get_contents($FileName ); 
// $ArrData = unpack("H*hex", $DataImage); 
// $HexData = "0x".$ArrData['hex']; 
$image_base64 = base64_encode(file_get_contents('upload/'.$FileName) );
$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;


  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
    // Upload file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// $Connect = mssql_connect("localhost","root","") or die("Error Connect to DB");
// $DB = mssql_select_db("project");
$sql = "INSERT INTO lesson (lesson_unitimg) VALUES ('$image')";
if ($mysqli->query($sql) === true) {
    echo ("success");
    } else {
    echo ("Error: " . $sql . "<br>" . $mysqli->error);
    }


// echo "Upload Complete<br>";
// echo "<a href='Img_show.php'>View_img </a> ";
        exit;
    }
}
    echo "failed";
  
?>
