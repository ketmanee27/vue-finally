<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        // $postDetail = $request->post_detail;
        // $post_id = $request->post_id;
        // $question_detail = $request->question_detail;
        $answer_detail1 = $request->answer_detail1;

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


        $sql = "INSERT INTO answer (answer_detail) VALUES ('".$answer_detail1."')";

        if ($conn->query($sql) === TRUE) {
        var_dump("success");
        } else {
        var_dump("Error: " . $sql. "<br>" . $conn->error);
        }

        // if ($result = $mysqli -> query("SELECT * FROM question")) {
        //     echo "Returned rows are: " . $result -> num_rows;
        //     // Free result set
        //     $result -> free_result();
        //   }
        
        $conn->close();
    }
    
?>