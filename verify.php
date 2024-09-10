<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Login Demo</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .alert {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-primary {
            color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;
        }

        .form-label {
            margin-bottom: .5rem;
            font-size: 1rem;
            font-weight: 400;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            cursor: pointer;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="container">  
        <h1> OTP Login</h1>
        <div class="alert alert-primary" role="alert">
            <?php
            session_start();
            // echo $_SESSION['email'];

            if(isset($_REQUEST['msg']))
                echo $_REQUEST['msg'];
            ?>

<?php
include_once('database/conn.php'); // Make sure the database connection is established

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];
    $sql = "SELECT * FROM userdata WHERE email='$email' AND otp='$otp'";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
    if(mysqli_num_rows($rs) > 0) {
        $sql = "UPDATE userdata SET otp='' WHERE email='$email'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($con));
        if($rs) {
            header('location: changepassword.php');
            exit;
        }
    } 
}
?>

        </div>
        <div class="mb-3">
            <form action="" method="post">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="number" class="form-control" name="otp" id="otp" placeholder="5 Digits OTP">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Verify OTP</button>
        </div> 
        </form>
    </div>
</body>
</html>
