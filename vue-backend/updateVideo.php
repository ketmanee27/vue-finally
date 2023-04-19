<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $lesson_id = $request->lesson_id;
        $video_subunit = $request->video_subunit;
        $video_name = $request->video_name;
        // $create_at = $request->create_at;
        $timezone = date_default_timezone_set('Asia/Bangkok');
        $timestamp = date("Y-m-d H:i:s");


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";

        // Create connection
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($mysqli == false) {
        die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "UPDATE video SET video_subunit='$video_subunit',video_name='$video_name',update_at='$timestamp' WHERE video_subunit=$video_subunit ";
        if ($mysqli->query($sql) === true) {
        echo ("success");
        } else {
        echo ("Error: " . $sql . "<br>" . $mysqli->error);
        }

        
        $mysqli->close();
    }
    
?>