<?php
include 'dbConn.php';

if (isset($_POST['signup'])) {
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $hpnumber = $_POST ['numPhone'];
    $ic = $_POST ['numIc'];
    $gender = $_POST ['gender'];
    $address = $_POST ['txtAddress'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    $query = "INSERT INTO `tblpatients`(`firstname`, `lastname`, `phonenumber`, `IC`, `gender`, `address`, `email`, `password`) VALUES ('$fname','$lname','$hpnumber','$ic','$gender','$address','$email','$password')";

    if (mysqli_query($connection, $query)) {
        header("Location: login.php");
    } else {
        echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
    }
} 

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/form.css">
    <script src="javaScript/validation.js"></script>
    
</head>
<body>
    <header>
        <div id="line"></div>
        <div id="logo">
            <a href="homepage.php">
                <img src="images/logo.png" alt="The Elderly Home's Club Logo">
            </a>
        </div>
        <div id="search">
            <div id="searchWrap">
                <div id="searchBox">
                    <input type="text" name="txtSearch" id="input" placeholder="Search">
                    <div id= "btn">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="position">
            <button class="btn btn1" onclick="window.location.href='login.php';">Login</button>
        </div>
    </header>
    <div class="clear"></div>
    <div class="signup-cont">
        <div class="signup-box">
            <h1>Sign Up</h1>
            <form action="#" method="post" onsubmit="return validatePassword()">
                <div class="user-details">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="txtFname" placeholder="Enter First Name" pattern="[A-Za-z\s]+" required>
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" placeholder="Enter Last Name" pattern="[A-Za-z\s]+"  required>
                    </div>
                    
                    <div class="input-box">
                        <label>Phone Number (without "-")</label>
                        <input type="tel" name="numPhone" placeholder="0123456789" pattern="[0-9]{10,11}" required>
                    </div>
                    <div class="input-box">
                        <label>IC Number (without "-")</label>
                        <input type="tel" name="numIc" placeholder="000000000000" pattern="[0-9]{12}" required>
                    </div>
                    <div class="gender">
                        <label>Gender</label>
                        <div class="category">
                            <input type="radio" name="gender" value="Male">Male
                            <input type="radio" name="gender" value="Female">Female
                        </div>
                    </div>
                    
                    <div class="address">
                        <label>Address</label>
                        <input type="text" name="txtAddress" placeholder="Enter Address" required>
                    </div>
                    
                    <div class="input-box">
                        <label>Email Address</label>
                        <input type="email" name="txtEmail" placeholder="Enter Email" required>
                    </div>
                    <div class="input-box"></div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="txtPassword" id="password" placeholder="Enter Password" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  onfocus="pass()" required>
                        <span id="message2"></span>
                    </div>
                    <div class="input-box">
                        <label>Confirm Password</label>
                        <input type="password" name="txtConfPassword" id="confPass" placeholder="Re-enter Password" required onkeyup="validatePassword()">
                        <span id="message1"> </span>
                    </div>
                    <input type="submit" value="Sign Up" name="signup" onclick="wrongPassAlert()">
                </div>
            </form>
        </div>
    </div>
</body>
</html>