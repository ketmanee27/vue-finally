<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $firstname = $request->user_firstname;
        $lastname = $request->user_lastname;
        $email = $request->user_email;
        $userpassword = $request->user_password;
        $type = $request->user_type;
        $birthday = $request->user_birthday;
        $district = $request->user_district;
        $province = $request->user_province;
        $timezone = date_default_timezone_set('Asia/Bangkok');
        $timestamp = date("Y-m-d H:i:s");
        $diff = abs(strtotime($timestamp) - strtotime($birthday));
        $age = floor($diff / (365*60*60*24));
        // $create_at = $request->create_at;

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


        // if ($type = "แอดมิน") {
        //     $a = 1;
        // } elseif ($type = "เกษตรกร") {
        //     $b = 2;
        // } else{
        //     $c = 3;
        // }



        $sql = "INSERT INTO user (user_firstname, user_lastname, user_email, user_password, user_type, user_birthday, user_age, user_district, user_province, create_at)
        VALUES ('".$firstname."', '".$lastname."', '".$email."', '".md5($userpassword)."', '".$type."', '".$birthday."', '".$age."',  '".$district."',  '".$province."',  '".$timestamp."')";

$sql2 = "INSERT INTO `users` (`name`, `user_type`, `username`, `password`, `status`, `date_updated`)
VALUES ('".$firstname."', '3', '".$email."', '".md5($userpassword)."','1','".$timestamp."')";


        if ($conn->query($sql) === TRUE) {
            $conn->query($sql2);

        var_dump("ลงทะเบียนสำเร็จ");
        } else {
        var_dump("Error: " . $sql . "<br>" . $conn->error);
        }

        // if ($result = $mysqli -> query("SELECT * FROM user")) {
        //     echo "Returned rows are: " . $result -> num_rows;
        //     // Free result set
        //     $result -> free_result();
        //   }
        
        $conn->close();
    }
    
?>