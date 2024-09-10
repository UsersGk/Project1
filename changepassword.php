<?php
session_start();
require_once("database/conn.php");


        
if (isset($_POST['update'])) {
  
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    if(isset($_SESSION['email'])){
        $euser = $_SESSION['email'];
    } else if(isset($_SESSION['admin'])){
        $euser = $_SESSION['admin'];
    } else if(isset($_SESSION['username'])){
        echo "Please";
        $euser = $_SESSION['username'];
    } else if(isset($_SESSION['doctor'])){
        $euser = $_SESSION['doctor'];
    }else{
        $euser=" ";
    }
 

    // Verify the old password
    $sql = "SELECT * FROM `userdata` WHERE email='$euser'";
    $query = mysqli_query($conn, $sql);

    if ($query) { 
        if ($new == $confirm) { 
            $_SESSION['error_msg']="hello";
            $p=md5($new);
            $update = "UPDATE `userdata` SET `password`='$p' WHERE email='$euser'";
            $updatequery = mysqli_query($conn, $update);

            if (!$updatequery) {
                $_SESSION['error_msg'] = "Failed to update password";
            } else {
                // Password updated successfully, destroy session and redirect to login page
                session_destroy();
                header('Location: login.php');
                exit(); // Always exit after redirection
            }
        } else {
            $_SESSION['error_msg'] = "New password and confirm password do not match";
        }
    } else {

    }

    // Redirect back to the password change page with an error message
    header('Location: changepassword.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>

<div class="container">  
    <h1>Password Change</h1>
    <?php
    // Check if the session message is set and display it
    if(isset($_SESSION) && !empty($_SESSION['error_msg'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['error_msg']; ?>
    </div>
    <?php
    }
    unset($_SESSION['error_msg']); // Unset the session message after displaying it
    ?>
    <form action="" method="post">
       
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn" name="update">Change Password</button>
        </div> 
    </form>
</div>

</body>
</html>
