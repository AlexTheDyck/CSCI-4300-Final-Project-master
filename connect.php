<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "finalproject";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if(!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $dsn = 'mysql:host=localhost;dbname=finalproject';
    $username = 'root';
    $password = '';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>