<?php
session_start(); // Starting Session
include_once "php/config.php"; // Using database connection file here
if (!isset($_SESSION['unique_id'])) { // Checking if session is already there or not then redirect to login page
  header("location: login.php"); // Redirecting to login page
}
?>
<?php include_once "header.php"; ?> <!-- Including header file -->

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          // Fetching logged in user data from database
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) { // Checking if user data is there or not
            $row = mysqli_fetch_assoc($sql); // Fetching user data from database
          }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt=""> <!-- Displaying logged in user profile image -->
          <div class="details">
            <span><?php echo $row['fname'] . " " . $row['lname'] ?></span> <!-- Displaying logged in user full name -->
            <p><?php echo $row['status']; ?></p> <!-- Displaying logged in user status -->
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a> <!-- Displaying logout button -->
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