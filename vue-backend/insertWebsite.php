<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $lesson_id = $request->lesson_id;
        $website_name = $request->website_name;
        $website_link = $request->website_link;
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

        $sql = "INSERT INTO website (lesson_id,website_name,website_link,create_at)
        VALUES ('".$lesson_id."','".$website_name."','".$website_link."','".$timestamp."')";

        if ($conn->query($sql) === true) {
            echo ("success");
        } else {
        var_dump("Error: " . $sql . "<br>" . $conn->error);
        }

        // if ($result = $mysqli -> query("SELECT * FROM website")) {
        //     echo "Returned rows are: " . $result -> num_rows;
        //     // Free result set
        //     $result -> free_result();
        //   }
        
        $conn->close();
    }
    
?>