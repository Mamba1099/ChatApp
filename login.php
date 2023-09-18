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
 * @link     https://@localhost:8080/login.php
 */
session_start(); 
if (isset($_SESSION['unique_id'])) { 
    header("location: users.php");
}
?>

<?php require_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
      <form action="#" 
            method="POST" 
            enctype="multipart/form-data" 
            autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" 
                 name="password"
                 placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>

  <script src="javascript/scripts/pass-show-hide.js"></script>
  <script src="javascript/scripts/login.js"></script>

</body>

</html>