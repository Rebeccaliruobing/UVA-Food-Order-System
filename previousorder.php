<?php
        require "dbconnection.php";

        $orderidval = $_POST['orderid'];
        $data = array();
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $sql = "SELECT foodname, quantity FROM order_content WHERE orderid = {$orderidval}";
        $result = $conn->query($sql);
        $data["content"] = mysqli_fetch_all($result);
        $conn->close();
        echo json_encode($data);
?>
