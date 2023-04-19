<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');

    $post_detail = $_POST['post_detail']; 
    $post_status = $_POST['post_status']; 
    $user_id = $_POST['user_id']; 
    $FileName = $_FILES['post_img']['name']; 
    $target_file = "upload/" . basename($_FILES["post_img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif","webp");
    $image_base64 = base64_encode(file_get_contents('upload/'.$FileName) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    if( in_array($imageFileType,$extensions_arr) ){
        // Upload file
        if (move_uploaded_file($_FILES["post_img"]["tmp_name"], "upload/".$_FILES['post_img']['name'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";


    // Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// $Connect = mssql_connect("localhost","root","") or die("Error Connect to DB");
// $DB = mssql_select_db("project");
$sql = "INSERT INTO postuser (post_detail,post_img,post_status,user_id) VALUES ('$post_detail','$image','$post_status','$user_id')";
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