<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | By Code Info</title>
    <link rel="stylesheet" href="Css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 350px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #49c1a2;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #37a185;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #49c1a2;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="post" onsubmit="return myfunc();">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <span id="passwordmss" style="color: red;"></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
       <center> <a href="password.php"> forget password?</a></center>
        <div class="signup-link">
            <p>Not have an account? <a href="patientsignup.php">Sign Up Here</a></p>
        </div>
    </div>
    <script>
        function myfunc() {
            var pass = document.getElementById("password").value.innerHTML;

            if (pass === '') {
            document.getElementById("passwordmss").value.innerHTML = "Please enter a password";
                return false; // Prevent form submission
            }
            return true; // Submit the form if all validations pass
        }
    </script>
</body>
</html>
<?php
session_start();
require_once("database/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['password']);
    $password = md5($pass); // Insecure, consider using bcrypt

    $sql = "SELECT * FROM `userdata` WHERE email = '$user' AND password ='$password'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    
    if ($count == 1) {

        $role = $data['role'];
        
        if ($role == "patient") {
            $_SESSION['username'] = $user;
            header('location: index.php');
        } elseif ($role == "doctor") {
            $_SESSION['doctor'] = $user;
            header('location: doctorschedule.php');
        } elseif ($role == "admin") {
            $_SESSION['admin'] = $user;
            header('location: dashboard.php');
        }
    } else {
        $_SESSION['error_msg'] = "Invalid login"; 
               header('location: login.php');
    }
}
?>