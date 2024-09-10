<?php
// Establishing a connection to the database. Replace these variables with your actual database credentials.
require("database/conn.php");

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    $role = "patient"; // Assuming a default role

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM `userdata` WHERE email = '$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    $count = mysqli_num_rows($result_check_email);

    if ($count == 0) { // If email doesn't exist
        if ($password == $confirm_password) {
            // Hashing the password using MD5 (Note: MD5 is not recommended for password hashing in production)
            $hashed_password = md5($password);

            // Inserting data into 'patient' table
            $sql_insert_patient = "INSERT INTO `patient`(`Name`, `Address`, `Email`, `DOB`, `Contactno`)
                                   VALUES ('$name', '$address', '$email', '$dob', '$contact')";

            // Inserting data into 'userdata' table
            $sql_insert_userdata = "INSERT INTO `userdata`(`username`, `email`, `password`, `role`)
                                    VALUES ('$name', '$email', '$hashed_password', '$role')";

            // Execute the queries
            if (mysqli_query($conn, $sql_insert_patient) && mysqli_query($conn, $sql_insert_userdata)) {
                // Redirect to login page after successful registration
                echo "<script>alert('Account created successfully!'); window.location.href = 'login.php';</script>";

                // header('location: login.php');
                
                // exit; // Stop further execution after redirection
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "Email already exists";
    }
}
// Close the database connection
$conn->close();
?>
