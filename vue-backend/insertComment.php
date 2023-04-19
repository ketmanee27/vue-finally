<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $comment_detail = $request->comment_detail;
        $post_id = $request->post_id;
        $user_id = $request->user_id;
        $timezone = date_default_timezone_set('Asia/Bangkok');
        $timestamp = date("Y-m-d H:i:s");


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO comment (comment_detail,create_at,post_id,user_id)
        VALUES ('".$comment_detail."','".$timestamp."','".$post_id."','".$user_id."')";

        if ($conn->query($sql) === TRUE) {
        var_dump("success");
        } else {
        var_dump("Error: " . $sql . "<br>" . $conn->error);
        }

        if ($result = $mysqli -> query("SELECT * FROM comment")) {
            echo "Returned rows are: " . $result -> num_rows;
            // Free result set
            $result -> free_result();
          }
        
        $conn->close();
    }
    
?>