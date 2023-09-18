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
 * @link     https://@localhost:8080/chat.php
 */

session_start();
require_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");

}
?>

<?php require_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string(
            $conn,
            $_GET['user_id']
        ); // Getting user id from url
        $sql = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE unique_id = {$user_id}"
        );
        if (mysqli_num_rows($sql) > 0) { // Checking if user data is there or not
            $row = mysqli_fetch_assoc($sql); // Fetching user data
        } else {
            header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row[
            'fname'] . " " . $row['lname'] ?>
            </span> <!-- Displaying user full name -->
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text"
               class="incoming_id" 
               name="incoming_id" 
               value="<?php echo $user_id; ?>" hidden> 
               <!-- Passing receiver user id -->
        <input type="text"
               name="message" 
               class="input-field" 
               placeholder="Type a message here..." 
               autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>