<?php
    $name = $_POST['name'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    $details = $_POST['details'];

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $from = "koolung22@gmail.com";
        $message = "The booking for ".$name." has been successfully made for ".$time." on ".$date." for ".$service." with the following details: ".$details."";

        $to = $email;
        $subject = "Beaute Lia Hair Booking Information";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$from.'<'.$from.'>' . "\r\n".'Reply-To: '.$from."\r\n" . 'X-Mailer: PHP/' . phpversion();
        $message = '<!doctype html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Document</title>
                </head>
                <body>
                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                    <div class="container">
                     '.$message.'<br/>
                    </div>
                </body>
                </html>';
        $result = @mail($to, $subject, $message, $headers);
        $result = @mail($from, $subject, $message, $headers);

        echo '<script>alert("Booking information sent to your email")</script>';
    }

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
        echo '<script>alert("Booking was successful! If you can not find the email, please check the spam folder in your inbox")</script>';
        echo '<script>window.location.href="index.html";</script>';
    }
    ?>