<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $name = $request->username;
        $email = $request->email;

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

        $sql = "INSERT INTO login (username, email)
        VALUES ('".$name."', '".$email."')";

        if ($conn->query($sql) === TRUE) {
        var_dump("เพิ่มข้อมูลสำเร็จ");
        } else {
        var_dump("Error: " . $sql . "<br>" . $conn->error);
        }

        if ($result = $mysqli -> query("SELECT * FROM login")) {
            echo "Returned rows are: " . $result -> num_rows;
            // Free result set
            $result -> free_result();
          }
        
        $conn->close();
    }
    
?>