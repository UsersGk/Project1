<?php

require_once("database/conn.php");
 include_once("nav.php"); 
// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit(); // Terminate script after redirection
}

// Fetch doctor names from the database
$result = mysqli_query($conn, "SELECT Name FROM doctor");

$doctorNames = [];

// Check if query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $doctorNames[] = $row["Name"]; // Store doctor names in an array
    }
}

// Fetch existing appointments from the database
$result = mysqli_query($conn, "SELECT * FROM appointment");
$bookedDoctors = [];
$bookedTimes = [];
$bookedDates = [];

// Check if query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $bookedDoctors[] = $row["Dname"]; // Store booked doctor names in an array
        $bookedTimes[] = $row["Appointmenttime"]; // Store booked appointment times in an array
        $bookedDates[] = $row["AppointmentDate"]; // Store booked appointment dates in an array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="css/bookingstyles.css"> <!-- Adjust path as necessary -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
   body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
       
                
        }
.contain{
    display:flex;
    justify-content:center;
    margin:20px;
}
        .contain1 {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);         
            
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select, input[type="date"], input[type="file"], input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        input[type="date"] {
            height: 38px; /* Match the height of other inputs */
        }
        /* //session */
        .alert {
    display: flex; /* Use flexbox */
    justify-content: space-between; /* Space between items */
    background-color: #C5E898;
    color: white; /* White text color */
    padding: 15px; /* Padding */
    margin-bottom: 15px; /* Margin bottom */
    border: 1px solid transparent; /* Border */
    border-radius: 4px; /* Border radius */
    width:100%;
}

.alert button {
    background-color: blue; /* Transparent background for the button */
    border: none; /* No border */
    cursor: pointer; /* Cursor style */
}

.alert button i {
    color: white; /* White color for the icon */
}

.alert button:disabled i {
    color: gray; /* Gray color for the icon when disabled */
    cursor: not-allowed; /* Cursor style when disabled */
}



        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            width: 100%;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

 
    </style>
</head>
<body>



<div class="contain">
    <div class="contain1">
        <form action="database/bookinginsert.php" method="post" enctype="multipart/form-data">
            <h1>Booking Now!!!</h1>
            <div class="form-group">
                <label for="Dcname">Doctor Name</label>
                <select name="Dcname" id="Dcname" onchange="disableOptions()">
                    <option value='none' selected>None</option>
                    <?php foreach ($doctorNames as $doctorName): ?>
                        <option value="<?php echo $doctorName; ?>"><?php echo $doctorName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="apdate">Appointment Date</label>
                <input type="date" name="apdate" id="apdate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" onchange="disableOptions()" required>
            </div>
            <div class="form-group">
                <label for="time">Appointment Time</label>
                <select name="time" id="time">
                    <option value="None">None</option>
                    <option value="10:00-11:00">10:00-11:00</option>
                    <option value="11:00-12:00">11:00-12:00</option>
                    <option value="12:00-1:00">12:00-1:00</option>
                    <option value="2:00-3:00">2:00-3:00</option>
                    <option value="3:00-4:00">3:00-4:00</option>
                    <option value="4:00-5:00">4:00-5:00</option>
                    <option value="5:00-6:00">5:00-6:00</option>
                    <option value="6:00-7:00">6:00-7:00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="QR">QR code</label><br>
                <img src="photo/qr.jpg" alt="QR Code" width="200" height="200">
            </div>
            <div class="form-group">
                <label for="image">QR payment Photo (JPG only)</label>
                <input type="file" name="image" id="image" accept="image/jpeg" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<?php include_once("footer.php"); ?>

<script>
       var bookedDoctors = <?php echo json_encode($bookedDoctors); ?>;
    var bookedTimes = <?php echo json_encode($bookedTimes); ?>;
    var bookedDates = <?php echo json_encode($bookedDates); ?>;
    // Function to disable options based on database values
//     function disableOptions() {
//     var selectElement = document.getElementById("time"); // Get the <select> element
//     var options = selectElement.options; // Get the options of the <select> element
//     var dd = document.getElementById("Dcname").value; // Get the selected doctor name
//     var ff = document.getElementById("apdate").value; // Get the selected appointment date

//     for (var i = 0; i < options.length; i++) {
     
//         if (bookedDoctors.includes(document.getElementById("Dcname").value) &&
//             bookedTimes.includes(options[i].value) &&
//             bookedDates.includes(document.getElementById("apdate").value)) {
//             options[i].disabled = true;
//             console.log(dd,options[i].value,bookedDoctors,bookedTimes);
//         } else {
//             options[i].disabled = false;
//         }
//     }
// }
function disableOptions() {
    var selectedDoctor = document.getElementById("Dcname").value; // Get the selected doctor name
    var selectedDate = document.getElementById("apdate").value; // Get the selected appointment date

    var selectElement = document.getElementById("time"); // Get the <select> element
    var options = selectElement.options; // Get the options of the <select> element

    for (var i = 0; i < options.length; i++) {
        var appointmentTime = options[i].value; // Get the value (time) of the current option

        // Check if the current doctor, appointment time, and date combination is booked
        var isBooked = false;
        for (var j = 0; j < bookedDoctors.length; j++) {
            if (
                bookedDoctors[j] === selectedDoctor &&
                bookedTimes[j] === appointmentTime &&
                bookedDates[j] === selectedDate
            ) {
                isBooked = true;
               // break; // No need to continue checking if already booked
            }
        }

        // Disable the option if it's booked, otherwise enable it
        options[i].disabled = isBooked;
    }
}


    // Call the function when the page loads
    window.onload = disableOptions;
</script>

</body>
</html>
`