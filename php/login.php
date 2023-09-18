<?php

/**
 * File: chat.php
 *
 * This file handles the ChatApp functionality.
 *
 * PHP version 7
 *
 * @category ChatApp
 * @package  ChatApp
 * @author   Sammy Karanja <mambakaranja240@gmail.com>
 * @license  MIT License
 * @link     https://@localhost:8080/user.php
 */
    session_start();
    require_once "config.php";
    $email = mysqli_real_escape_string(
        $conn, 
        $_POST['email']
    ); // Getting email from post variable
    $password = mysqli_real_escape_string(
        $conn, 
        $_POST['password']
    ); // Getting password from post variable
    if (!empty($email) && !empty($password)) { 
        // If email and password is not empty
        $sql = mysqli_query(
            $conn, 
            "SELECT * FROM users WHERE email = '{$email}'"
        ); // Checking if email exists in database
        if (mysqli_num_rows($sql) > 0) { // If email exists
            $row = mysqli_fetch_assoc($sql); // Fetching data from database
            $user_pass = md5($password); // Password encryption
            $enc_pass = $row['password']; // Encrypted password from database
            if ($user_pass === $enc_pass) {
                $status = "Active now"; 
                // Once user signed up then this status will be active now
                $sql2 = mysqli_query(
                    $conn, 
                    "UPDATE users SET status = '{$status}' 
                    WHERE unique_id = {$row['unique_id']}"
                ); // Updating status in database
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is Incorrect!";
            }
        } else {
            echo "$email - This email not Exist!";
        }
    } else {
        echo "All input fields are required!";
    }
