
<?php
  
    header('Access-Control-Allow-Origin: *');  
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');

  
    // if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {

        
        $FileName = $_FILES['file']['name']; 
        $target_file = "video/" . basename($_FILES["file"]["name"]);
 // Select file type
 $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // Valid file extensions
   $extensions_arr = array("mp4","mov","avi");
 // $Name=$_FILES["file"]["name"]; 
// $Size=$_FILES["file"]["size"]; 
// $Type=$_FILES["file"]["type"]; 
// $DataImage = file_get_contents($FileName ); 
// $ArrData = unpack("H*hex", $DataImage); 
// $HexData = "0x".$ArrData['hex']; 
$video_base64 = base64_encode(file_get_contents('video/'.$FileName) );
$video = 'data:video/'.$videoFileType.';base64,'.$video_base64;


  // Check extension
  if( in_array($videoFileType,$extensions_arr) ){
    // Upload file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "video/".$_FILES['file']['name'])) {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

$Connect = mssql_connect("localhost","root","") or die("Error Connect to DB");
 $DB = mssql_select_db("project");

$sql = "INSERT INTO video (video_file) VALUES ('$video')";
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
<?php
include("config.php");
 
if(isset($_POST['but_upload'])){
   $maxsize = 5242880; // 5MB
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 5MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               // Insert record
               $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

               mysqli_query($con,$query);
               $_SESSION['message'] = "Upload successfully.";
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
   header('location: index.php');
   exit;
} 
?>
<!doctype html> 
<html> 
  <head>
     <title>Upload and Store video to MySQL Database with PHP</title>
  </head>
  <body>

    <!-- Upload response -->
    <?php 
    if(isset($_SESSION['message'])){
       echo $_SESSION['message'];
       unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='but_upload'>
    </form>

  </body>
</html>
