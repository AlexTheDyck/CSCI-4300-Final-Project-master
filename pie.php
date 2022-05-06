<?php
    session_start(); 
    include "connect.php";

    if(array_key_exists('agg', $_POST)) {
        button1();
    }
    else if(array_key_exists('mod', $_POST)) {
        button2();
    }
    else if(array_key_exists('con', $_POST)) {
        button3();
    }
    function button1() {
        include "connect.php";
        $sql = "UPDATE `investments` SET `investmentType` = 'Aggresive' WHERE `investments`.`userEmail` =  '".$_SESSION['userEmail']."'";
        mysqli_query($conn,$sql);
    }
    function button2() {
        include "connect.php";
        $sql = "UPDATE `investments` SET `investmentType` = 'Moderate' WHERE `investments`.`userEmail` =  '".$_SESSION['userEmail']."'";
        mysqli_query($conn,$sql);
    }
    function button3() {
        include "connect.php";
        $sql = "UPDATE `investments` SET `investmentType` = 'Conservative' WHERE `investments`.`userEmail` =  '".$_SESSION['userEmail']."'";
        mysqli_query($conn,$sql);
    }

    header("Location: investments.php");
    exit();