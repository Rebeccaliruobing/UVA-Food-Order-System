<?php
        require "dbconnection.php";

        $userid = $_POST['userid'];
        $response = array();

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $sql_previousorder = "SELECT orderid, order_date FROM order_relation WHERE userid = '{$userid}'";
        $preorder = $conn->query($sql_previousorder);
        if($preorder === FALSE){
            $response["preorder"] = "Error: " . $sql . "<br>" . $conn->error;
        }
        else{
            $preorder_val = mysqli_fetch_all($preorder);
            $response["preorder"]=json_encode($preorder_val);
        }
        $conn->close();
        echo json_encode($response);
?>
