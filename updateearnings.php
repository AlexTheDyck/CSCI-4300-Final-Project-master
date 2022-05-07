<?php
    session_start(); 
    include "connect.php";

    $add = filter_input(INPUT_POST, 'updateEarnings');

    $sql = "UPDATE investments SET earnings = $add
    WHERE userEmail = '".$_SESSION['userEmail']."'";

    mysqli_query($conn,$sql);
    header("Location: index.php");
    exit();