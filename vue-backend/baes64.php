<?php

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, PUT ');
header("Access-Control-Allow-Headers: Content-Type");

// (A) READ IMAGE INFO
$file = "cate.jpg";
$fileData = exif_read_data($file);
$fileEncode = base64_encode(file_get_contents($file));

// (B) BASE 64 ENCODED IMAGE
echo "<img src=\"data:${fileData["MimeType"]};base64,${fileEncode}\"/>";
?>