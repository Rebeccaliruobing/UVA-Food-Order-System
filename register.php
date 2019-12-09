<?php
        require "dbconnection.php";

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $userid = $_POST['userid'];
        $passcode = $_POST['passcode'];
        $sql = "INSERT INTO user_info (userid, passcode) VALUES ('{$userid}', '{$passcode}');";
        $response = array();
        if ($conn->query($sql) === TRUE) {
            $response["text"] = "Successfully Registered!";
            echo json_encode($response);
        } else {
            $response["text"] = "Error: User name already exist. Pick another name.";
            echo json_encode($response);
        }
        $conn->close();
?>
