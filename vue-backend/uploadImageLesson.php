<?php

//upload.php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");


$image = '';

if(isset($_FILES['file']['name']))
{
 $imageName = $_FILES['file']['name'];
 $valid_extensions = array("jpg","jpeg","png");
 $extension = pathinfo($imageName, PATHINFO_EXTENSION);
 if(in_array($extension, $valid_extensions))
 {
  $upload_path = 'Screenshots/' . time() . '.' . $extension;
  if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path))
  {
   $message = 'Image Uploaded';
   $image = $upload_path;
  }
  else
  {
   $message = 'There is an error while uploading image';
  }
 }
 else
 {
  $message = 'Only .jpg, .jpeg and .png Image allowed to upload';
 }
}
else
{
 $message = 'Select Image';
}

$output = array(
 'message'  => $message,
 'image'   => $image
);

echo json_encode($output);


?>