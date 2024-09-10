<?php
session_start();
require("database/conn.php");
// echo $user;
// Initialize variables
// $id = $_POST["id"] ?? null;
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql = "SELECT * FROM patient WHERE Email='$user';";
    $result = mysqli_query($conn, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $name = $row['Name'];
        $address = $row['Address'];
        $email = $row['Email'];
        $dob = $row['DOB'];
        $contno = $row['Contactno'];
        $photo = $row['photo'];
        // echo "<pre>";
        // print_r($row);
        // echo "<pre>";
    }
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $address = mysqli_real_escape_string($conn, $_POST['Address']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $contno = mysqli_real_escape_string($conn, $_POST['Contno']);
    $updateSql = "UPDATE patient SET 
        Name='$name', 
        Address='$address', 
        Email='$email', 
        DOB='$dob', 
        Contactno='$contno'
        WHERE Email='$user';";

    if (mysqli_query($conn, $updateSql)) {
        //        echo "Record updated successfully.";
    }
    // else {
    //     echo "Error updating record: " . mysqli_error($conn);
//     // }
// echo $photo;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // echo "Image deleted successfully.";
        // Delete old photo
        if (!empty($photo) && file_exists("photo/" . $photo)) {
            unlink("database/photo/" . $photo);
        }
        // Upload new photo
        $file_name = $_FILES['image']['name'];
        $file_temp = $_FILES['image']['tmp_name'];

        // Specify the target directory for the uploaded file
        $target_dir = "database/photo/";
        $target_file = $target_dir . basename($file_name);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_temp, $target_file)) {
            // Update the database with the new photo filename
            $updatePhotoSql = "UPDATE patient SET photo='$file_name' WHERE Email='$user';";
            if (mysqli_query($conn, $updatePhotoSql)) {
                // echo "Photo updated successfully.";
            }
            // else {
            //     echo "Error updating photo: " . mysqli_error($conn);
            // }
        }
        // else {
        //     echo "Sorry, there was an error uploading your file.";
        // }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment System</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <style>
        /* Style the dropdown button */
./* Style the dropdown button */
.dropbtn {
        width: 40px; /* Adjust width as needed */
        height: 40px; /* Adjust height as needed */
        background-color: #f1f1f1; /* Background color */
        border: none; /* Remove border */
        border-radius: 50%; /* Make it round */
        
        display: flex; /* Make the container a flexbox */
        justify-content: center; /* Center content horizontally */
        align-items: center; /* Center content vertically */
    }

 

    /* Assuming you're using Font Awesome for the icon */
    .dropbtn i {
        font-size: 4vh; /* Adjust icon size as needed */
        color: white; /* Icon color */
        cursor: pointer; /* Show pointer cursor on hover */
    }

/* Dropdown container */
.dropdown {
  position: relative;
  display: inline-block;

}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 150px;
  box-shadow: 1px 10px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  top:100%;
left:-80px;

}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Style the dropdown menu items */
.dropdown-content p {
  margin: 0;
}

/* Style the logout icon */
.fa-sign-out {
  font-size: 10px;
}
.dropdown .dropdown-content a p{
    font-size: 15px;
}
/* remove the background */
.logo img{
mix-blend-mode: multiply; 
}     </style>
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="logo"> <img src="photo/photo11.jpg" alt="" height="50"></div>
        <div class="navbar">
            <ul>
                <li><a href="index.php" id="homeLink">Home</a></li>
                <li><a href="About.php" id="aboutLink">About</a></li>
                <li><a href="booking.php" id="bookingLink">Booking</a></li>
                <li><a href="check.php" id="checkLink">Check</a></li>
                <li><a href="contact.php" id="contactLink">Contact</a></li>
                <li><a href="doctor.php" id="doctorLink">Doctor</a></li>
                <li onclick="textClicked()"><img src="database/photo/<?php echo $photo; ?>" alt="Profile" width="40"
                        height="40"></li>
                <!-- <div class="logout"><a href="logout.php"><Button><i class="fa fa-sign-out fa-xl"
                                aria-hidden="true"></i></Button></a></li> -->
                            <li>    <div class="logout">
                                <?php
                                if (isset($_SESSION['username'])) {
                                    $log="logout.php";
                                }else{
                                    $log="login.php";
                                }
                                 ?>
    <div class="dropdown">
        <div class="dropbtn"><i class="fa-solid fa-user"></i></div>
        <div class="dropdown-content">
        <a href="patientsignup.php"><p>Register</p></a></i>
        <a href="changepassword.php"> <p> <i class="fa-solid fa-unlock"></i> Password Change</p></a>
        <a href="<?php echo $log?>"> <p> <i class="fa-solid fa-right-to-bracket"></i> login/out</p></a>
            <!-- Add other dropdown options if needed -->
        </div>
    </div>
</div>
</li>
            </ul>
        </div>

    </header>
    <dialog id="patient" class="patient">
        <div class="check">

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <caption>
                        <h1>Patient Information</h1>
                    </caption>
                    <tr>
                        <td colspan="2"><a href="database/photo/<?php echo $photo; ?>"><img
                                    src="database/photo/<?php echo $photo; ?>" alt="Profile" width="100"
                                    height="100"></a></td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="2"><input type="file" name="image" id="image" accept="image/jpeg"></td>
                    </tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <tr>
                        <td><label for="Name">Name</label></td>
                        <td><input type="text" name="Name" id="Name" value="<?php echo $name,''; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="Address">Address</label></td>
                        <td><input type="text" name="Address" id="Address" value="<?php echo $address; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="Email">Email</label></td>
                        <td><input type="email" name="Email" id="Email" value="<?php echo $email; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="Dob">Date of Birth</label></td>
                        <td><input type="date" name="dob" id="dob" value="<?php echo $dob; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="Contno">Contact Number</label></td>
                        <td><input type="text" name="Contno" id="Contno" value="<?php echo $contno; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" name="update" value="Save"></td>
                        <td align="center"><button onclick="closedialog()"> Close</button></td>
                    </tr>
                </table>
            </form>

        </div>
    </dialog>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentPage = window.location.href;
            var navLinks = document.querySelectorAll('header ul li a');

            navLinks.forEach(function (link) {
                if (link.href === currentPage) {
                    link.parentElement.classList.add('active');
                }
            });
        });
        const dialog = document.getElementById('patient');
        function textClicked() {
            dialog.showModal()
        }
        function closedialog() {
            dialog.close()
        }
    </script>
</body>

</html>