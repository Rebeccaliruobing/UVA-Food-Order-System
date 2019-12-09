<?php
        require "dbconnection.php";
        $response = array();
        $userid = $_POST['userid'];
        $total_price = $_POST['total_price'];
        $ordercontent = json_decode($_POST['ordercontent']);
        $foodname = array(0=>'Pineapple Juice',1=>'Green Juice',2=>'Soft Drinks',3=>'Carlo Rosee Drinks',4=>'Beef Steak',
            5=>'Tomato with Chicken',6=>'Sausages from Italy',7=>'Beef Grilled');

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }

        for ($i=0; $i<8; $i++){
            $conn = mysqli_connect($host, $username, $password, $dbname);
            $sql_quantity = "SELECT quantity FROM food_storage WHERE foodname = '{$foodname[$i]}';";
            $quantity = $conn->query($sql_quantity);
            $quantity_num = mysqli_fetch_array($quantity);
            $conn->close();
            if ($quantity_num[0] < $ordercontent[$i]) {
                $response["text"] = "Cannot submit order since we only have"." $quantity_num[0] "."$foodname[$i] "."left!";
                echo json_encode($response);
                exit();
            } 
        }
        for ($i=0; $i<8; $i++){
            if ($ordercontent[$i] > 0) {
            
                $conn = mysqli_connect($host, $username, $password, $dbname);
                $sql_minus = "UPDATE food_storage SET quantity = quantity - {$ordercontent[$i]} WHERE foodname = '{$foodname[$i]}';";
                if ($conn->query($sql_minus) != TRUE) {
                    $response["text"] = "Error: " . $sql_minus . "<br>" . $conn->error;
                    echo json_encode($response);
                    exit();
                }
                $conn->close();
            }
        }
        $conn = mysqli_connect($host, $username, $password, $dbname);
        $sql_wallet = "SELECT wallet FROM user_info WHERE userid = '{$userid}';";
        $wallet = $conn->query($sql_wallet);
        $wallet_num = mysqli_fetch_array($wallet);
        if ($wallet_num[0] < $total_price){
            $response["text"] = "Cannot submit order since you don't have enough money in your wallet!";
            echo json_encode($response);
            exit();
        }
        $conn->close();

        $conn = mysqli_connect($host, $username, $password, $dbname);
        $sql_order_info = "INSERT INTO order_info (total_price) VALUES ({$total_price});";
        $conn->query($sql_order_info);
        $conn->close();

        $conn = mysqli_connect($host, $username, $password, $dbname);
        $sql_get_orderid = "SELECT MAX(orderid) FROM order_info;";
        $orderid = $conn->query($sql_get_orderid);
        $orderid_val = mysqli_fetch_array($orderid);
        $conn->close();

        $conn = mysqli_connect($host, $username, $password, $dbname);
        $sql_order_relation = "INSERT INTO order_relation (userid, orderid, order_date) VALUES ('{$userid}',{$orderid_val[0]},CURDATE());";
        if ($conn->query($sql_order_relation) != TRUE){
           $response["text"] = "Error: " . $sql_order_relation . "<br>" . $conn->error;
            echo json_encode($response);
            $conn->close();
            exit(); 
        };
        $conn->close();

        for ($i=0; $i<8; $i++){
            if ($ordercontent[$i] > 0) {
                $conn = mysqli_connect($host, $username, $password, $dbname);
                $sql_order_content = "INSERT INTO order_content (orderid, foodname, quantity) VALUES ('{$orderid_val[0]}','{$foodname[$i]}', {$ordercontent[$i]})";
                if ($conn->query($sql_order_content) != TRUE){
                    $response["text"] = "Error: " . $sql_order_relation . "<br>" . $conn->error;
                    echo json_encode($response);
                    $conn->close();
                    exit(); 
                };
                $conn->close();
            }
        }
        $response["text"] = "Successfully Ordered!";
        echo json_encode($response);
?>
