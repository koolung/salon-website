<?php
    $name = $_POST['name'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    $details = $_POST['details'];


    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'booking');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die('Connection Failed  :  '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into bookings(name, time, date, service, details)
        values(?, ?, ?, ?, ?)");
        $stmt->bind_param('siiss', $name, $time, $date, $service, $details);  
        $stmt->execute();
        echo "booking successful...";
        $stmt->close();
        $conn->close();
    }
    ?>