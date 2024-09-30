<?php
session_start();
include 'dbConn.php';

if (isset($_POST['login'])) {
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $query = "SELECT * FROM tblpatients WHERE email='$email' AND password='$password'";
    $results = mysqli_query ($connection, $query);
    $row = mysqli_fetch_assoc($results); 
    $count = mysqli_num_rows($results); 

    $query2 = "SELECT * FROM tbladmin WHERE adminEmail = '$email' AND adminPassword = '$password'";
    $results2 = mysqli_query ($connection, $query2);
    $row2 = mysqli_fetch_assoc($results2); 
    $count2 = mysqli_num_rows($results2);
    
    if ($count == 1) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['lname'] = $row['lastname'];
        $_SESSION['phnumber'] = $row['phonenumber'];
        $_SESSION['ic'] = $row['IC'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['email'] = $row['email'];

        header ("Location: homepage.php");
    } elseif ($count2 == 1) {
        $_SESSION['adminID'] = $row2['adminID'];
        $_SESSION['adminFname'] = $row2['adminFirstname'];
        $_SESSION['adminLname'] = $row2['adminLastname'];

        header ("Location: appointmentList.php");
    } else {
        echo '<script>alert("Invalid Email or Password!")</script>';
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
    <title>Login</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/form.css">
    
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
    <div class="login-cont">
        <div class="login-box">
            <h1>Login</h1>
            <form action="" method="post">
                <label>Email Address</label>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="email" name="txtEmail" placeholder="Enter Email" required>
                </div>
                <label>Password</label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="txtPassword" placeholder="Enter Password" required>
                </div>
                <input type="submit" value="Login" name="login">
            </form>
            <a href="signup.php" class="signup">Sign Up</a>
        </div>
    </div>

</body>
</html>