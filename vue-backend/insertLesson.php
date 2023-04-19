<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");


    $lesson_id = $_POST['lesson_id']; 
    $lesson_name = $_POST['lesson_name'];
    $lesson_description = $_POST['lesson_description'];
    $timezone = date_default_timezone_set('Asia/Bangkok');
    $timestamp = date("Y-m-d H:i:s");
    $FileName = $_FILES['lesson_unitimg']['name']; 
    $target_file = "upload/" . basename($_FILES["lesson_unitimg"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif","webp");
    $image_base64 = base64_encode(file_get_contents('upload/'.$FileName) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    if( in_array($imageFileType,$extensions_arr) ){
        // Upload file
        if (move_uploaded_file($_FILES["lesson_unitimg"]["tmp_name"], "upload/".$_FILES['lesson_unitimg']['name'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);


$sql = "INSERT INTO lesson (lesson_id,lesson_name,lesson_unitimg,lesson_description,create_at) VALUES ('$lesson_id','$lesson_name','$image','$lesson_description','$timestamp')";
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
