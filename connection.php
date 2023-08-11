<?php
    $host = ('localhost');
    $user = ('root');
    $pass = ('');
    $dbName = ('websy');
    $conn = new mysqli($host, $user, $pass, $dbName);

    ini_set("SMTP", "smtp.example.com");
    ini_set("smtp_port", "587");
    ini_set("sendmail_from", "your_email@example.com");
?>  