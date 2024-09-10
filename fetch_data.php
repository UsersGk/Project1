<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "doctoras",3307);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieving doctor name from GET parameter
$doctorName = $_GET['doctorName'];

// Fetching appointment times for the selected doctor
$sql = "SELECT Appointmenttime FROM appointment WHERE Dname = '$doctorName'";
$result = mysqli_query($conn, $sql);

$response = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row['Appointmenttime'];
    }
}

echo json_encode($response);

mysqli_close($conn);
?>
