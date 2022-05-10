<?php
    session_start(); 
    include "connect.php";

    //Check how form was submitted
    //==================== ADD NEW PRODUCT ====================//
    //insert command 

    $email = filter_input(INPUT_POST, 'userEmail');
    $stmt = $db->prepare("SELECT * FROM logininfo WHERE userEmail=?");
    //execute the statement
    $stmt->execute([$email]); 
    //fetch result
    $user = $stmt->fetch();
    if ($user) {
        header("Location: register.php?error=username is in use");
    } else {
        $pass = filter_input(INPUT_POST, 'userPassword');
        $fname = filter_input(INPUT_POST, 'fname');
        $lname = filter_input(INPUT_POST, 'lname');
        $totalAmount = 0;
        $investmentType = "None";
        $balance = 0;
        $earnings = 0;
        $sql="INSERT INTO logininfo (fname, lname, userPassword, userEmail)
            VALUES ($fname, $lname, $pass, $email)";
        $sql2="INSERT INTO investments (userEmail, totalAmount, investmentType, balance, earnings)
            VALUES ($email, $totalAmount, $investmentType, $balance, $earnings)";
        if ($email == null || $pass == null || $fname == null || $lname == null) {
            header("Location: register.php?error=Invalid product data. Check all fields and try 
        again. Make sure that NO fields are NULL and that the product code is UNIQUE.");
        } else {
            require_once('connect.php');
    
            //Add Login Info
            $query = 'INSERT INTO `logininfo` (`fname`, `lname`, `userPassword`, `userEmail`)
            VALUES
            (:fname, :lname, :userPassword, :userEmail)';
            $query2="INSERT INTO investments (userEmail, totalAmount, investmentType, balance, earnings)
                VALUES (:userEmail, :totalAmount, :investmentType, :balance, :earnings)";
            $statement = $db->prepare($query);
            $statement->bindValue(':fname', $fname);
            $statement->bindValue(':lname', $lname);
            $statement->bindValue(':userPassword', $pass);
            $statement->bindValue(':userEmail', $email);
            $statement->execute();
            $statement->closeCursor();
    
            $statement2 = $db->prepare($query2);
            $statement2->bindValue(':userEmail', $email);
            $statement2->bindValue(':totalAmount', $totalAmount);
            $statement2->bindValue(':investmentType', $investmentType);
            $statement2->bindValue(':balance', $balance);
            $statement2->bindValue(':earnings', $earnings);
            $statement2->execute();
            $statement2->closeCursor();
    
            header("Location: login.php");
            exit();
        }
    

    }


   