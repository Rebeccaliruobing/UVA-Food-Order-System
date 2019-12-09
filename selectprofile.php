<?php
        require "dbconnection.php";

        $useridval = $_POST['userid'];
        $response = array();
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $sql = "SELECT address, phone, cardnumber, wallet FROM user_info WHERE userid = '{$useridval}';";
        $result = $conn->query($sql);
        $response["content"] =  mysqli_fetch_all($result);
        $conn->close();
        echo json_encode($response);
?>
