<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');

    $unit = $_POST['unit']; 
    $name = $_POST['name']; 
    $FileName = $_FILES['file']['name']; 
    $target_file = "upload/" . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");
    $image_base64 = base64_encode(file_get_contents('upload/'.$FileName) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    if( in_array($imageFileType,$extensions_arr) ){
        // Upload file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";


    // Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

 $Connect = mssql_connect("localhost","root","") or die("Error Connect to DB");
 $DB = mssql_select_db("project");
$sql = "INSERT INTO lesson (lesson_id,lesson_name,lesson_unitimg) VALUES ('$unit','$name','$image')";
if ($mysqli->query($sql) === true) {
    echo ("success");
    } else {
    echo ("Error: " . $sql . "<br>" . $mysqli->error);
    }
    exit;
}
}
echo "failed";


?>