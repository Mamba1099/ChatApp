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
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chatapp";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    echo "Database connection error".mysqli_connect_error(); 
}
