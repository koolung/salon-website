<?php
    $name = $_POST['name'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    $details = $_POST['details'];


    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if($conn->connect_error){
        die('Connection Failed  :  '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(name, time, date, service, details)
        values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiii', $name, $time, $date, $service, $details);  
        $stmt->execute();
        echo "booking successful...";
        $stmt->close();
        $conn->close();
    }
    ?>