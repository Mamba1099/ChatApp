<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php"; // Including database connection file
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']); // Getting logout_id
        if(isset($logout_id)){ // If logout_id is there
            $status = "Offline now"; // Once user logout then this status will be offline now
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}"); // Updating status in database
            if($sql){
                session_unset(); // Removing all session variables
                session_destroy(); // Destroying session
                header("location: ../login.php"); // Redirecting to login page
            }
        }else{
            header("location: ../users.php"); 
        }
    }else{  
        header("location: ../login.php");
    }
