<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Care</title>
    <link rel="stylesheet" href="css/admincss/doctordashstyle.css">
</head>
<body>
    <?php
    include_once("sidebar.php");
    ?>
    <div class="outertable">
        <div class="innertable">

 
    <table>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Contact no</th>
            <th>Photo</th>
            <th colspan="3">Alter</th>
        </tr>

        <?php
        require("database/conn.php"); // Include your database connection script

        // Execute SELECT query
        $result = mysqli_query($conn, "SELECT * FROM patient");

        // Check if query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["sn"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Address"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["DOB"]; ?></td>
                    <td><?php echo $row["Contactno"]; ?></td>
                    <td><a href="database/photo/<?php echo $row["photo"]; ?>"><img src="database/photo/<?php echo $row["photo"]; ?>" alt="Payment Screenshot" width="100" height="100"></a></td>
                    <!-- Assuming you store photo path in the database -->
                    <td><form action="database\updatepatients.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row["sn"];?>">
                        <input type="submit" value="update" class="buttom" name="submit"/>
            </form></td>
                    <td ><form action="database\deletepatient.php" method="get" onsubmit="return confirm('Are you sure to delete?')">
                        <input type="hidden" name="id" value="<?php echo $row["sn"];?>">
                        <input type="submit" value="Delete" class="buttom" name="submit"/>
            </form></td> <!-- Assuming you'll add functionality here -->
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='10'>No records found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
       
    </table>
    </div>
    </div>
</body>
</html>
