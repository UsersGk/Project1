<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Login Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
        .alert {
            padding: 15px;
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
            font-weight: 500;
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
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .btn {
            display: inline-block;
            font-weight: 500;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            cursor: pointer;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<div class="container">  
    <h1>OTP Login</h1>
    <div class="alert alert-primary" role="alert">
        <?php
        session_start();
        if(isset($_POST['submit'])){
            $_SESSION['email']=$_POST['user_email'];
        }
   
        if(isset($_REQUEST['msg']))
            echo $_REQUEST['msg'];
        ?>
    </div>
    <form action="send_otp.php" method="post">
        <div class="mb-3">
            <label for="user_email" class="form-label">Enter Email</label>
            <input type="email" class="form-control" name="user_email" id="user_email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success" name="submit">Send OTP</button>
        </div> 
    </form>
</div>
</body>
</html>
