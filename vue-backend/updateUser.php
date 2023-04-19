<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $request = json_decode(file_get_contents("php://input"));


    if ($request != null) {
        $user_id = $request->user_id;
        $user_firstname = $request->user_firstname;
        $user_lastname = $request->user_lastname;
        $user_email = $request->user_email;
        $user_password = $request->user_password;
        $user_type = $request->user_type;
        $user_birthday = $request->user_birthday;
        $user_age = $request->user_age;
        $user_district = $request->user_district;
        $user_province = $request->user_province;
        $create_at = $request->create_at;
        $timezone = date_default_timezone_set('Asia/Bangkok');
        $timestamp = date("Y-m-d H:i:s");
        $diff = abs(strtotime($timestamp) - strtotime($user_birthday));
        $age = floor($diff / (365*60*60*24));



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

        $sql = "UPDATE user SET user_firstname='$user_firstname',user_lastname='$user_lastname',user_email='$user_email',user_type='$user_type',user_birthday='$user_birthday',user_age='$age',user_district='$user_district',user_province='$user_province',create_at='$create_at',update_at='$timestamp' WHERE user_id=$user_id ";

        $sql2 = "UPDATE users SET `name`='$user_firstname',`user_type`='3',`username`='$user_email',`status`='1', `date_updated`='$timestamp' WHERE `id`=$user_id ";

        if ($mysqli->query($sql) === true) {
            $mysqli->query($sql2);
        echo ("success");
        } else {
        echo ("Error: " . $sql . "<br>" . $mysqli->error);
        }

        
        $mysqli->close();
    }
    
?>