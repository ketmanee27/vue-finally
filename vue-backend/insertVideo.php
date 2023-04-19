<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');

    $video_subunit = $_POST['video_subunit']; 
    $video_name = $_POST['video_name']; 
    $lesson_id = $_POST['lesson_id']; 
    $FileName = $_FILES['video_file']['name']; 
    $target_file = "video/" . basename($_FILES["video_file"]["name"]);
    $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("mp4","mov","avi");
    $video_base64 = base64_encode(file_get_contents('video/'.$FileName) );
    $video = 'data:video/'.$videoFileType.';base64,'.$video_base64;
    if( in_array($videoFileType,$extensions_arr) ){
        // Upload file
        if (move_uploaded_file($_FILES["video_file"]["tmp_name"], "upload/".$_FILES['video_file']['name'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";


    // Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// $Connect = mssql_connect("localhost","root","") or die("Error Connect to DB");
// $DB = mssql_select_db("project");
$sql = "INSERT INTO video (video_subunit,video_name,video_file,lesson_id) VALUES ('$video_subunit','$video_name','$video','$lesson_id')";
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

<?php
   // header('Access-Control-Allow-Origin: *');
  //  header('Access-Control-Allow-Methods: GET, POST, PUT ');
   // header("Access-Control-Allow-Headers: Content-Type");

    //$request = json_decode(file_get_contents("php://input"));

   //  if ($request != null) {
    //     $video_subunit = $request->video_subunit;
       //  $video_name = $request->video_name;
     //    $file = $request->file;
       //  $video_file = $request->video_file;
      //   $lesson_unit = $request->lesson_unit;
        
        
   //     $FileName = $_FILES['file']['name']; 
     //   $target_file = "video/" . basename($_FILES["file"]["name"]);
       // $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     //   $extensions_arr = array("mp4","mov","avi");
      //  $video_base64 = base64_encode(file_get_contents('video/'.$FileName) );
      //  $video = 'data:video/'.$videoFileType.';base64,'.$video_base64;
    

      //  if( in_array($videoFileType,$extensions_arr) ){
      //      if (move_uploaded_file($_FILES["file"]["tmp_name"], "video/".$_FILES['file']['name'])) {


      //  $servername = "localhost";
     //   $username = "root";
      //  $password = "";
      //  $dbname = "project";

        // Create connection
    //    $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
      //  if ($conn->connect_error) {
      //  die("Connection failed: " . $conn->connect_error);
     //   }

      //  $sql = "INSERT INTO video (video_subunit,video_name,video_file,lesson_unit)
      //  VALUES ('".$video_subunit."','".$video_name."','".$video."','".$lesson_unit."')";

     //   if ($conn->query($sql) === TRUE) {
     //       echo ("success");
     //   } else {
      //  var_dump("Error: " . $sql . "<br>" . $conn->error);
      //  }

      //  if ($result = $mysqli -> query("SELECT * FROM video")) {
       //     echo "Returned rows are: " . $result -> num_rows;
            // Free result set
       //     $result -> free_result();
       // 
       // $conn->close();
  //  }
// }
 //    }
    
?>