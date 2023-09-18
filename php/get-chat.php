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
if (isset($_SESSION['unique_id'])) { // Checking if the user is logged in or not
    include_once "config.php"; // Including the database connection file
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); 
    // Getting incoming_id from Ajax POST
    $output = "";
    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id},
            incoming_msg_id = {$incoming_id}) 
            OR (outgoing_msg_id = {$incoming_id},
            incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id"; // Ordering all messages by msg_id
    $query = mysqli_query($conn, $sql); // Executing query
    if (mysqli_num_rows($query) > 0) {
        // If there are more than zero rows
        while ($row = mysqli_fetch_assoc($query)) {
            // Fetching all messages one by one
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                // If the message is sent by the logged-in user
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    } else {
        header("location: ../login.php");
    }
}
