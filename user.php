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
session_start(); // Starting Session
require_once "php/config.php"; // Using database connection file here
if (!isset($_SESSION['unique_id'])) {
    // Checking if session is already there or not then redirect to login page
    header("location: login.php"); // Redirecting to login page
}

?>
<?php require_once "header.php"; ?> <!-- Including header file -->

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
            $sql = mysqli_query(  // Fetching logged in user data from database
                $conn,
                "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}"
            );
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
          <img src="php/images/<?php echo $row['img'];?>" 
            alt=""> <!-- Displaying logged in user profile image -->
          <div class="details">
            <!-- Displaying logged in user full name -->
            <span><?php echo $row['fname'] . " " . $row['lname'] ?>
            </span>
            <p>
              <?php echo $row['status']; ?>
          </p> 
          <!-- Displaying logged in user status -->
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row[
          'unique_id']; ?>" 
          class="logout">Logout</a> <!-- Displaying logout button -->
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>