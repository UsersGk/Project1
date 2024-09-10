<?php
include_once("nav.php");

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit(); // Terminate script after redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
    <link rel="stylesheet" href="css/admincss/indexstyle.css">
    <style>
   *{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
        .outertable {
            margin: 0 auto;
            margin: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
        }

        .innertable {
            overflow: auto;
            width: 100%;
        }

        /* Table header cells */
        th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            /* text-align: left; */
        }

        /* Table data cells */
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* Alternating row colors */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect on rows */
        tr:hover {
            /* cursor: pointer; */
            background-color: #ddd;

        }
    </style>
</head>

<body>

    <div class="outertable">
        <div class="innertable">


            <table>
                <tr>
                    <th>SN</th>
                    <th> Paitent Name</th>
                    <th>Doctor Name</th>
                    <th>P_Address</th>
                    <th>P_email</th>
                    <th>DOB</th>
                    <th>Contact no</th>
                    <th>Appointment Time</th>
                    <th>Appointment Date</th>
                    <th>Payment screeshot</th>
                    <th>Request</th>
                </tr>
                <tr>
                    <?php

                  

                    $result = mysqli_query($conn, "SELECT * FROM appointment where email='$user';");

               
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sn=$row['sn'];
                            ?>
                        <tr>
                            <td>
                                <?php echo $sn; ?>
                            </td>
                            <td>
                                <?php echo $row['Name']; ?>
                            </td>
                            <td>
                                <?php echo $row['Dname']; ?>
                            </td>
                            <td>
                                <?php echo $row['address']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['DOB']; ?>
                            </td>
                            <td>
                                <?php echo $row['Pcontactno']; ?>
                            </td>
                            <td>
                                <?php echo $row['Appointmenttime']; ?>
                            </td>
                            <td>
                                <?php echo $row['AppointmentDate']; ?>
                            </td>
                            <td><a href="database/payment/<?php echo $row['photo']; ?>"><img
                                        src="database/payment/<?php echo $row['photo']; ?>" alt="Payment Screenshot" width="100"
                                        height="100"></a></td>
                            <td>
                                <?php echo $row['request']; ?>
                            </td>
                            <!-- Assuming you store photo path in the database -->
                        </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='11'>No records found</td></tr>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tr>
            </table>
        </div>
    </div>
    </body>
    <br> <br> <br> <br> <br><br><br><br><br><br><br><br><br><br><br>
    <?php include_once("footer.php"); ?>
</html>