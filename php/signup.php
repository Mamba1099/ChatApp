<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']); // Getting fname from post variable
    $lname = mysqli_real_escape_string($conn, $_POST['lname']); // Getting lname from post variable
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Getting email from post variable
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Getting password from post variable
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){ 
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // If email is valid
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); // Checking if email already exists
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){ // If image is uploaded
                    $img_name = $_FILES['image']['name']; // Getting image name
                    $img_type = $_FILES['image']['type']; // Getting image type
                    $tmp_name = $_FILES['image']['tmp_name']; // Getting image tmp_name
                    
                    $img_explode = explode('.',$img_name); // Exploding image
                    $img_ext = end($img_explode); // Getting image extension
    
                    $extensions = ["jpeg", "png", "jpg"]; // Valid image extensions
                    if(in_array($img_ext, $extensions) === true){ // If image extension is valid
                        $types = ["image/jpeg", "image/jpg", "image/png"]; // Valid image types
                        if(in_array($img_type, $types) === true){ // If image type is valid
                            $time = time();  // Getting current time
                            $new_img_name = $time.$img_name; // Renaming image
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){ // If image moved to our folder
                                $ran_id = rand(time(), 100000000); // Creating random id for user
                                $status = "Active now"; // Once user signed up then this status will be active now
                                $encrypt_pass = md5($password); // Password encryption
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) -- Inserting user data into database
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')"); // Inserting data into database
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); // Fetching user data from database
                                    if(mysqli_num_rows($select_sql2) > 0){ // If user data is there in database
                                        $result = mysqli_fetch_assoc($select_sql2); // Fetching user data
                                        $_SESSION['unique_id'] = $result['unique_id']; // Putting user id into session variable
                                        echo "success";
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
