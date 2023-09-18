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
    $outgoing_id = $_SESSION['unique_id']; // Getting logged in user id
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
    // Getting search term

    $sql = "SELECT * FROM users 
            WHERE NOT unique_id = {$outgoing_id},
            (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
             // Getting all users except logged in user
    $output = "";
    $query = mysqli_query($conn, $sql); // Executing query
if (mysqli_num_rows($query) > 0) { 
        include_once "data.php"; 
} else {
    $output .= 'No user found related to your search term';
}
    echo $output;
