<?php
   session_start();
   // Redirect to login if user is not logged in
   if (!isset($_SESSION['admin'])) {
       header('location: login.php');
       exit(); // Terminate script after redirection
   }
   
   require("database/conn.php");
   
   $user = $_SESSION['admin'];
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admincss/dashboardstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
    <style>
        ul li.active a {
            background-color: #ccc; /* Change to the desired background color */
            padding: 10px; /* Change to the desired padding */
        }
        
/* Dropdown container */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Styling for account icon */
.dropdown .fas.fa-user { 
  color: white; /* Icon color */
  font-size: 1.6rem; /* Icon size */
  cursor: pointer; /* Change cursor to pointer */
}

/* Dropdown content */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  z-index: 1;
  top: 100%; /* Position dropdown below the icon */
 left:-15vh; 
/* Align dropdown with the right edge of the icon */
  border: 1px solid #ddd;
  border-radius: 5px;
}

/* Links inside the dropdown */
.dropdown-content a {
  display: block;
  padding: 12px 16px;
  text-decoration: none;
  color: black;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown content when the account icon is hovered over */
.dropdown:hover .dropdown-content {
  display: block;
}
/* remove the background */
.logo img{
mix-blend-mode: multiply; 
}  
    </style>
</head>
<body>
<section class="contain">
    <h1><div class="logo"> <img src="photo/photo11.jpg" alt="" height="50"></div></h1>
    <ul>
        <li><a href="dashboard.php" id="dashlink">Dashboard</a></li>
        <li><a href="doctordashboard.php" id="doctorlink">Doctor</a></li>
        <li><a href="dashboardpatient.php" id="patientlink">Patient</a></li>
        <li><a href="dashboardappointment.php" id="appointmentlink">Appointment</a></li>
        <li><a href="dashboarduser.php" id="userlink">User</a></li>
        <li><a href="logout.php" id="logoutlink">logout</a></li>
    </ul>
</section>
<div class="last">
   <section class="sidebar">
    <header>
       <h1></h1>
        <ul>
            <li><?php echo $user; ?></li>
            <li>           <div class="dropdown">
  <span class="fas fa-user"></span> <!-- Account icon -->
  <div class="dropdown-content">
    <a href="changepassword.php"><i class="fas fa-key"></i> Password Change</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div></a></li>
        </ul>
    </header>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentPage = window.location.href;
    var navLinks = document.querySelectorAll('.contain ul li a');

    navLinks.forEach(function(link) {
        if (link.href === currentPage) {
            link.parentElement.classList.add('active');
            console.log("Current Page URL:", currentPage);
            console.log("Matched Link:", link.href);
        }
    });
});

</script>
</body>
</html>
