<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
 body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
   <script>
        function myfun() {
            var name = document.getElementById("name").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;
            var pass = document.getElementById("password").value;
            var cpss = document.getElementById("confirm_password").value;
            var passwordMessage = document.getElementById("message");
            var confirmPasswordMessage = document.getElementById("mess");
            var nameMessage = document.getElementById("hello");
            var contactMessage = document.getElementById("cont");
            var dob = document.getElementById("dob");
            var address = document.getElementById("address");

            let today=new Date();
            let now = new Date(
                today.getFullYear()-18,
                today.getMonth(),
                today.getDate(),
                today.getHours(),
                today.getMinutes(),
                today.getSeconds()
            );
            
        

            // Reset previous error messages
            passwordMessage.innerHTML = "";
            confirmPasswordMessage.innerHTML = "";
            nameMessage.innerHTML = "";
            contactMessage.innerHTML = "";

            // Name validation
            if (!name.match(/^[A-Za-z\s]+$/)) {
                nameMessage.innerHTML = "Please enter a valid name containing only letters and spaces.";
                return false;
            }
            if ((address==='')){
              document.getElementById("addr").innerHTML = "Please enter a valid address.";
                return false;
            }
            // Email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailPattern)) {
                email_message.innerHTML = "Please enter a valid email address.";
                return false;
            }

            if (dob>=now) {
                document.getElementById("Dateob").innerHTML="Invalid date.";
                return false; // Prevent form submission
            }

            // Contact number validation
            if (!contact.match(/^9[0-9]{9}$/)) {
                contactMessage.innerHTML = "Please enter a valid contact number that starts with the digit '9' and is 10 digits long.";
                return false;
            }
             // Password validation
             if (pass === '') {
                passwordMessage.innerHTML = "Please enter a password.";
                return false; // Prevent form submission
            }

            if (cpss === '') {
                confirmPasswordMessage.innerHTML = "Please enter a password.";
                return false; // Prevent form submission
            }

            if (pass !== cpss) {
                confirmPasswordMessage.innerHTML = "Passwords do not match.";
                return false;
            }


            if (pass.length < 8) {
                passwordMessage.innerHTML = "Please enter a password that is at least 8 characters long.";
                return false;
            }

            if (!pass.match(/[@!#$%]/)) {
                passwordMessage.innerHTML = "Please enter a password that contains at least one special character (@!#$%).";
                return false;
            }

            if (!pass.match(/[0-9]/)) {
                passwordMessage.innerHTML = "Please enter a password that contains at least one digit.";
                return false;
            }


            return true; // Submit the form if all validations pass
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="data.php" method="post" onsubmit="return myfun();">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <span id="hello" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
                <span id="addr" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <span id="email_message" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" max="<?php echo date('Y-m-d'); ?>">
                <span id="dateob" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="tel" id="contact" name="contact" pattern="[0-9]{10}">
                <span id="cont" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span id="message" style="color:red;"></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <span id="mess" style="color:red;"></span>
            </div>
            <button type="submit" name="submit" onclick="myfun();"> Submit</button>
        </form>
    </div>
</body>
</html>