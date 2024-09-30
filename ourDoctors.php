<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/mainPage.css">
    <script src="javaScript/nav.js"></script>
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
    <div class="title">
        <img src="images/ourdoctors.jpg" alt="">
        <div class="word">
            <h1>Our Doctors</h1>
        </div>
    </div>
    <section>
        <div class="doctor" id="doc-container-1">
            <img src="images/ourdoctor05.jpg" alt="Doctor 1" class="doctorsImg">
            <h3>Dr. Amreeta Priya</h3>
            <p>
                <b>Qualification:</b> Neurology</i><br>
                <b>Specialist:</b> MBBS (UM), MRCOG (UK)</i><br>
                <b>Email Address:</b> amreeta@gmail.com</i>
            </p>
            <button class="btnDoctor" onclick="viewSchedule()">View Schedule</button>
            <div class="table" id="schedule-1">
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <td>Monday - Friday</td>
                        <td>9:00am - 4.00pm</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>9:00am - 1.00pm</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="doctor" id="doc-container-2">
            <img src="images/ourdoctor02.jpg" alt="Doctor 2" class="doctorsImg">
            <h3>Dr. Shahirah Binti Mohammad Zamrul</h3>
            <p>
                <b>Qualification:</b> Cardiology<br>
                <b>Specialist:</b> MBBS (UM), MRCOG (UK)<br>
                <b>Email Address:</b> shahirah@gmail.com
            </p>
            <button class="btnDoctor" onclick="viewSchedule2()">View Schedule</button>
            <div class="table" id="schedule-2">
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <td>Monday - Friday</td>
                        <td>9:00am - 4.00pm</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>9:00am - 1.00pm</td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
        <div class="doctor" id="doc-container-3">
            <img src="images/ourdoctor03.png" alt="Doctor 3" class="doctorsImg">
            <h3>Dr. Xiao Zhan</h3>
            <p>
                <b>Qualification:</b> Ear, Nose & Throat<br>
                <b>Specialist:</b> MD (UKM), MMed O&G (UM)</i><br>
                <b>Email Address:</b> xiaozhan@gmail.com</i>
            </p>
            <button class="btnDoctor" onclick="viewSchedule3()">View Schedule</button>
            <div class="table" id="schedule-3">
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <td>Monday - Friday</td>
                        <td>9:00am - 4.00pm</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>9:00am - 1.00pm</td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
    </section>
    <script>
        let schedule = document.getElementById("schedule-1");
        let doctor = document.getElementById("doc-container-1");
        function viewSchedule() {
            schedule.classList.toggle("open-table");
            doctor.classList.toggle("open-table");
        }

        let schedule2 = document.getElementById("schedule-2");
        let doctor2 = document.getElementById("doc-container-2");
        function viewSchedule2() {
            schedule2.classList.toggle("open-table");
            doctor2.classList.toggle("open-table");
        }

        let schedule3 = document.getElementById("schedule-3");
        let doctor3 = document.getElementById("doc-container-3");
        function viewSchedule3() {
            schedule3.classList.toggle("open-table");
            doctor3.classList.toggle("open-table");
        }
    </script>

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