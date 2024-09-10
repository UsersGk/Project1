<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <form action="signupdata.php" method="post" enctype="multipart/form-data">
                <h2>Sign Up</h2>
                <p>Create your new account.</p>
                <div>
                    <div class="row">
                        <div class="column">
                            <label for="fristName">Frist Name</label>
                            <input type="text" id="fristName" placeholder="Frist Name" /><br>
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" placeholder="MM/DD/YYY" /><br>
                        </div>
                        <div class="column">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" placeholder="Middle Name" /><br>
                            <label for="address">Address</label>
                            <input type="text" id="address" placeholder="Address" /><br>
                        </div>
                        <div class="column">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" placeholder="Last Name" /><br>
                            <label for="contact">Contact</label>
                            <input type="text" id="contact" placeholder="Contact" /><br>
                        </div>
                    </div>
                    <div class="otherDetails">
                        <div class="genderbox">
                            <label for="gender">Gender:</label>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="check-male" name="gender">
                                    <label for="check-male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="check-female" name="gender">
                                    <label for="check-female">Female</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="check-others" name="gender">
                                    <label for="check-others">Others</label>
                                </div>
                            </div>
                        </div>
                        <div class="details">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"><br>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"required /><br>
                        <label for="password">Password (8 characters minimum)</label>
                        <input type="password" name="password" id="password" minlength="8" required /><br>
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password"  name="confirm_password" id="confirm_password" required data-parsley-equalto="#password" /><br>
                        </div>
                        <button class="button" type="submit" onclick="addUser()">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>