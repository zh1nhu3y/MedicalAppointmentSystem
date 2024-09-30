<?php
session_start();
include 'dbConn.php';

if (isset($_POST['saveDetails'])) {
    $id = $_SESSION['id'];
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $phnum = $_POST['numPhone'];
    $icnum = $_POST['numIc'];
    $address = $_POST['txtAddress'];

    $query = "UPDATE tblpatients SET firstname='$fname',lastname='$lname',phonenumber='$phnum',IC='$icnum',address='$address' WHERE id = '$id' ";
    if (mysqli_query ($connection, $query)) {
        $sql = "SELECT * FROM tblpatients WHERE id='$id'";
        $results = mysqli_query ($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['lname'] = $row['lastname'];
        $_SESSION['phnumber'] = $row['phonenumber'];
        $_SESSION['ic'] = $row['IC'];
        $_SESSION['address'] = $row['address'];

        echo '<script>alert("Details updated succesfully!")</script>';
    } else {
        echo '<script>alert("Opps something went wrong! Please Try Again.")</script>';
    }
}
if (isset($_POST['changePswrd'])) {
    $id = $_SESSION['id'];
    $password = $_POST['txtPassword'];
    $update = "UPDATE `tblpatients` SET password='$password' WHERE id='$id'";
    $sql2 = mysqli_query ($connection, $update);
    if ($sql2) { 
        echo '<script>alert("Password Updated Successfully!")</script>';
    } else {
        echo '<script>alert("Something went wrong! Please Try Again.")</script>';
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
    <title>My Profile</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/user.css">
    <script src="javaScript/nav.js"></script> 
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
            <?php
            if (!empty($_SESSION['id'])) {
            ?>
                <div class="btn1 btn2" onclick="toggleMenu()"><i class="fa fa-user"></i></div>
                
                <div class="profile-wrap" id="profileMenu">
                    <div class="profile">
                        <div class="info">
                            <h3><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></h3>
                        </div>
                        <hr>
                        <a href="myProfile.php" class="profile-link">
                            <i class="fa fa-user"></i>
                            <p>My Profile</p>
                            <span>></span>
                        </a>
                        <a href="myAppointment.php" class="profile-link">
                            <i class="fa fa-calendar-alt"></i>
                            <p>My Appointment</p>
                            <span>></span>
                        </a>
                        <a href="logout.php" class="profile-link">
                            <i class="fa fa-power-off"></i>
                            <p>Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div> 
            <?php } else { ?>
                <button class="btn btn1" onclick="window.location.href='login.php';">Login</button>
            <?php
            }
            ?>
        </div>
    </header>
    <script>
        let profileMenu = document.getElementById("profileMenu");

        function toggleMenu() {
            profileMenu.classList.toggle("open-menu");
        }
    </script>
    <div class="clear"></div>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="ourDoctors.php">Our Doctors</a></li>
            <li><a href="makeAppointment.php">Make Appointment</a></li>
            <li><a href="ourServices.php">Our Services</a>
                <ul>
                    <li><a href="descFBCheckUp.php">Full Body Check-up</a></li>
                    <li><a href="descBloodTest.php">Blood Test</a></li>
                    <li><a href="descHealthScreening.php">Health Screening</a></li>
                    <li><a href="descVaccination.php">Vaccination</a></li>
                    <li><a href="descGeneralT.php">General Treatment</a></li>
                </ul>
            </li>
            <li><a href="patientCare.php">Patient Care</a>
                <ul>
                    <li><a href="apptChckList.php">Appointment Checklist</a></li>
                    <li><a href="medicRprtRequest.php">Medical Report Request</a></li>
                </ul>
            </li>
            <li><a href="aboutUs.php">About Us</a></li>
        </ul>
    </nav>
    <div class="prof-cont">
        <div class="prof-box">
            <form action="#" method="post" onsubmit="return confirmChange()">
                <div class="user-details">
                    <h3>My Details</h3>
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="txtFname" placeholder="Enter First Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['fname']; ?>">
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" placeholder="Enter Last Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['lname']; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <label>Phone Number (without "-")</label>
                        <input type="tel" name="numPhone" placeholder="0123456789" pattern="[0-9]{10,11}" required value="<?php echo $_SESSION['phnumber']; ?>">
                    </div>
                    <div class="input-box">
                        <label>IC Number (without "-")</label>
                        <input type="tel" name="numIc" placeholder="000000000000" pattern="[0-9]{12}" required value="<?php echo $_SESSION['ic']; ?>">
                    </div>                
                    <div class="address">
                        <label>Address</label>
                        <input type="text" name="txtAddress" placeholder="Enter Address" required value="<?php echo $_SESSION['address']; ?>">
                    </div>
                    <input type="submit" value="Save My Details" name="saveDetails" class="submit">
                    <input type="reset" value="Reset" class="submit">
                    
                </div>
            </form>
        </div>
        <div class="prof-box">  
            <form action="#" method="post" onsubmit="return validatePassword() && confirmChange()">
                <div class="user-details-1" >
                    <h3>Email & Password</h3>
                    <div class="input-box box1">
                        <label>Email Address</label>
                        <input type="email" name="txtEmail" placeholder="Enter Email" value="<?php echo $_SESSION['email']; ?>" readonly>
                    </div>
                    
                    <div class="input-box box1">
                        <label>New Password</label>
                        <input type="password" name="txtPassword" id="password" placeholder="Enter New Password" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onfocus="pass()" required >
                        <span id="message2"></span>
                    </div>
                    
                    <div class="input-box box1">
                        <label>Confirm Password</label>
                        <input type="password" name="txtConfPassword" id="confPass" placeholder="Re-enter Password" required onkeyup="validatePassword()">
                        <span id="message1"> </span>
                    </div>
                    <br><br>
                    <input type="submit" value="Change Password" name="changePswrd" class="submit" onclick="wrongPassAlert()">
                    <br>
                </div>
            </form>
        </div>
    </div>
     
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Our Clinic</h4>
                        <ul>
                            <li><a href="homepage.php">Home</a></li>
                            <li><a href="ourDoctors.php">Our Doctors</a></li>
                            <li><a href="aboutUs.php">About Us</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Make Appointment</h4>
                        <ul>
                            <li><a href="makeAppointment.php">Make Appointment</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Our Services</h4>
                        <ul>
                            <li><a href="descFBCheckUp.php">Full Body Check-up</a></li>
                            <li><a href="descBloodTest.php">Blood Test</a></li>
                            <li><a href="descHealthScreening.php">Health Screening</a></li>
                            <li><a href="descVaccination.php">Vaccination</a></li>
                            <li><a href="descGeneralT.php">General Treatment</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Patient Care</h4>
                        <ul>
                            <li><a href="apptChckList.php">Appointment Checklist</a></li>
                            <li><a href="medicalRprtRequest.php">Medical Report Request</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Operating Hours</h4>
                        <ul>
                            <i class="fa-solid fa-clock"></i>
                            <p>9am - 8pm daily</p>
                        </ul>
                    <h4>Contact Us</h4>
                    <ul>
                        <i class="fa-solid fa-phone"></i>
                        <p>+603-8923 1924</p> 
                        <i class="fa fa-envelope"></i>
                        <p>elderlyhome.medical@gmail.com</p>
                    </ul>
                </div>
                <div class="footer-col"></li>
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

