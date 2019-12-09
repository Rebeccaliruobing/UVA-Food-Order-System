<?php
        require "dbconnection.php";

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if ($conn->connect_error){
            die("connection failed: ". $conn->conect_error);
        }
        $useridval = $_POST['userid'];
        $addressval = $_POST['addressval'];
        $phoneval = $_POST['phoneval'];
        $cardval = $_POST['cardnumberval'];
        $walletval = $_POST['walletval'];
        $sql = "UPDATE user_info Set address = '{$addressval}', phone = {$phoneval}, cardnumber = {$cardval}, 
        wallet = {$walletval} WHERE userid = '{$useridval}';";
        $response = array();
        if ($conn->query($sql) === TRUE) {
            $response["text"] = "Successfully update your profile!";
            echo json_encode($response);
        } else {
            $response["text"] = "Error: " . $sql . "<br>" . $conn->error;
            echo json_encode($response);
        }
        $conn->close();
?>
