<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/contactstyle.css">
    <style>
        
        .notice {
            background-image: url(photo/bgdoctor.jpg) !important;
        }
        .alert {
    background-color: #C5E898;
    color: white; /* White text color */
    padding: 15px; /* Padding */
    margin-bottom: 15px; /* Margin bottom */
    border: 1px solid transparent; /* Border */
    border-radius: 4px; /* Border radius */
    width:100%;
    text-align:center;
    font-size:1.2rem;
}


    </style>
</head>

<body>
    <?php
    include_once("nav.php");
    ?>
    <div class="notice">
        <div class="photo">
            <h1>Contact For Any Query</h1>
        </div>
    </div>
    <?php 
  if(isset($_SESSION['smtp'])){
    echo "<br>";
    echo "<div class='alert alert-danger'>";
    echo $_SESSION['smtp'];
    echo "</div>";
  }
  unset($_SESSION['smtp']);
  ?>

    <div class="check">

    <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.925073094114!2d85.28720587474658!3d27.68871057619331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198d9284b605%3A0xdeff9faa80d88afb!2sAdvanced%20College%20of%20Engg.%20Management!5e0!3m2!1sen!2snp!4v1709640320128!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
        <div class="background">
            <form action="sending.php" method="POST">
                <table>
                    <tr>
                    <?php        
                    if(isset($_SESSION['username'])){
                  $pu = $_SESSION['username'];
    }
    else{
        $pu=" ";
    }
                        $sl = "SELECT Name FROM patient WHERE Email='$pu'";
                            $result = mysqli_query($conn, $sl);
                            while ($row = mysqli_fetch_assoc($result)) {
                               $name=$row['Name'];
                            }
                            ?>
                        <td><label for="Name">Name: </label></td>
                        <td><input type="text" name="name" id="Name"  value="<?php 
                         if(isset($_SESSION['username'])){
                            echo $name;
                        }
                            else{
                                echo " ";
                            } ?>"required></td>
                    </tr>
                    <tr>
                        <td><label for="email">E-mail: </label></td>
                        <td><input type="text" name="email" id="email" value="<?php if(isset($_SESSION['username'])){
                             echo $_SESSION['username'];
                            }
                             else{
                                echo " ";
                             }?>" required ></td>
                    </tr>
                    <tr>
                        <td><label for="Sub">Subject: </label></td>
                        <td><input type="text" name="subject" id="sub" placeholder="Subject" required></td>
                    </tr>
                    <tr>
                        <td><label for="textbox">Message: </label></td>
                        <td><textarea name="message" id="" cols="30" rows="10" placeholder="Message"
                                required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
    <?php
    include_once("footer.php");
    ?>
</body>

</html>