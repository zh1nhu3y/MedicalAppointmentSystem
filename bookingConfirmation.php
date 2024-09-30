<?php 
session_start();
include 'dbConn.php';
$apptID = $_SESSION['apptID'];

$query = "SELECT apptID, firstname, lastname, apptDate, apptTime, docFirstname, docLastname, serviceName FROM `tblappointment` INNER JOIN tblpatients ON tblappointment.id = tblpatients.id INNER JOIN tbldoctors ON tblappointment.docID = tbldoctors.docID INNER JOIN tblservice ON tblappointment.serviceID = tblservice.serviceID WHERE apptID='$apptID';";
$results = mysqli_query ($connection, $query);
$row = mysqli_fetch_assoc($results);
$time = strtotime($row['apptTime']);
$apptTime = date ('h:i a', $time); 
if (strlen($apptID) == 1) {
    $apptID = "BR000".$apptID;
} elseif(strlen($apptID) == 2) {
    $apptID = "BR00".$apptID;
} elseif (strlen($apptID) == 3) {
    $apptID = "BR0".$apptID; 
} else {
    $apptID = "BR".$apptID; 
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <script src="javaScript/nav.js"></script>
    <style>
        .conf-cont {
            margin: auto;
            background: rgb(68,188,216);
            background: linear-gradient(349deg, rgba(68,188,216,0.7) 0%, rgba(148,172,194,0.8) 50%, rgba(216,205,232,0.7) 100%); 
            border-radius: 10px;
            box-sizing: border-box;
            padding: 25px;
            width: 55%;
            box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.1);
        }
        .conf-cont h1, .conf-cont h3 {
            margin-left: 20px;
        }
        .conf-cont h1{
            position: relative;
        }
        .conf-1, .conf-2 {
            width: 50%;
            box-sizing: border-box;
            padding: 0 20px 20px 20px;
        }
        .conf-1 {
            float: left;
        }
        .conf-2 {
            float: right;
        }
        .conf-box {
            background: whitesmoke;
            width: 100%;
            box-sizing: border-box;
            padding: 10px 40px;
            border-radius: 10px;
        }
        .conf-box h1::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            height: 3px;
            width: 100px;
            background: rgb(68,163,216);
            background: linear-gradient(135deg, rgba(68,163,216,1) 0%, rgba(148,172,194,1) 50%, rgba(200,188,224,1) 100%);
        }
    </style>
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
    <br><br><br>
    <div class="conf-cont">
        <div class="conf-box">
            <h1>Booking Successful!</h1>
            <h3>Appointment ID: <?php echo $apptID; ?></h3>
            <div class="conf-1">
                <p><b>Patient Name:</b> <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
                <p><b>Service Booked:</b>  <?php echo $row['serviceName']; ?></p>
                <p><b>Doctor In-Charge:</b> Dr. <?php echo $row['docFirstname'] . ' ' . $row['docLastname']; ?></p>
            </div>
            <div class="conf-2">
                <p><b>Appointment Date:</b>  <?php echo $row['apptDate']; ?></p>
                <p><b>Appointment Time:</b> <?php echo $apptTime; ?></p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <br><br><br>
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