<?php
        require "dbconnection.php";

        $useridval = $_POST['userid'];
        $passcodeval = $_POST['passcode'];
        $response = array();
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $sql = " SELECT * FROM user_info WHERE userid = '{$useridval}' AND passcode = '{$passcodeval}';";
        $result = $conn->query($sql);
        $rows = mysqli_num_rows($result);
        if ($rows === 1) {
           $response["text"]="Successfully Logged in!";
        } else {
        $response["text"]="Error: No such id or password!";}
        $conn->close();
        echo json_encode($response);
?>
