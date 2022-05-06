<?php
    session_start(); 
    include "connect.php";

    $add = filter_input(INPUT_POST, 'addfund');

    $sql = "UPDATE investments SET totalamount = totalamount + $add
    WHERE userEmail = '".$_SESSION['userEmail']."'";

    mysqli_query($conn,$sql);
    header("Location: investments.php");
    exit();