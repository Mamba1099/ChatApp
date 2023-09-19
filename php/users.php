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
     * @link     No link
     */
session_start();
require_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users 
            WHERE NOT unique_id = {$outgoing_id} 
            ORDER BY user_id DESC"; // Getting all users except logged in user
    $query = mysqli_query($conn, $sql); // Executing query
    $output = "";
if (mysqli_num_rows($query) == 0) {
        $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
        include_once "data.php";
}
    echo $output;
