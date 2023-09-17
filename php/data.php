<?php
    while($row = mysqli_fetch_assoc($query)){ // Fetching all users data from database one by one
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} -- Checking for sender/receiver
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}  -- Checking for sender/receiver
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1"; // Getting last message from each user (user id)
        $query2 = mysqli_query($conn, $sql2); // Executing query
        $row2 = mysqli_fetch_assoc($query2); // Fetching last message
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available"; // If message available then add to variable $result
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result; // If message length is more than 28 word then add ... after 28 words
        if(isset($row2['outgoing_msg_id'])){ // Checking for sender/receiver    
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = ""; 
        }else{
            $you = ""; 
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = ""; // If user is offline then add offline tag
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = ""; // Hiding logged in user from user list
        // Creating chat list

        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'"> 
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
