<?php
include 'dbConn.php';
session_start();

if (!empty($_SESSION['id'])) {
    $serviceID = $_GET['serviceID'];
    $query = "SELECT serviceName, tblservice.docID, docFirstname, docLastname FROM tblservice INNER JOIN tbldoctors ON tblservice.docID = tbldoctors.docID WHERE serviceID='$serviceID';";
    $results = mysqli_query ($connection, $query);
    $row = mysqli_fetch_assoc($results); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
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
    <div class="title">
        <img src="images/makeAppointment.jpg" alt="Make Appointment Title Background">
        <div class="word">
            <h1>Appointment Form</h1>
        </div>
    </div>
    <br><br>
    <div class="form-cont">
        <div class="form-box">
            <h1><?php echo $row['serviceName']; ?></h1>
            <h3>Doctor In-Charge: Dr. <?php echo $row['docFirstname'] .' ' .  $row['docLastname']; ?></h3>
            <hr><br>
            <form method="post" class="form">
                <div class="form-details">
                    <div class="select-input">
                        <label>Select Date</label>
                        <select name="date" class="select" required>
                            <option value="">--SELECT--</option>
                        <?php
                            $docID = $row['docID'];
                            $query1 = "SELECT * FROM `tbldocshedule` WHERE docID = '$docID' AND id IS NULL ORDER BY `tbldocshedule`.`date` ASC;";
                            $result1 = mysqli_query($connection, $query1);
                            $options = "";
                            while ($row1 = mysqli_fetch_array($result1)) {
                                if ($options != $row1[1]) {
                                    $options = $row1[1];
                                    if(isset($_POST['date']) && $_POST['date'] == $options){
                                        echo "<option selected value=". $_POST['date'].">". $_POST['date'] ."</option>";
                                    } else{       
                        ?>
                                    <option value="<?php echo $options; ?>"><?php echo $options;?></option>
                        <?php   
                                    }
                                    }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="select-input-1">
                        <input type="submit" value=">" name="next" class="next">
                    </div>
                    <?php
                    if (isset($_POST['next'])) {
                        $date = $_POST['date'];
                    ?>
                    
                        <div class="select-input">
                            <label>Select Time</label>
                            <select name="time" class="select">
                                <option value="">--SELECT--</option>
                            <?php
                                $query2 = "SELECT * FROM `tbldocshedule` WHERE docID='$docID' AND id IS NULL AND date='$date' ORDER BY `tbldocshedule`.`time` ASC;";
                                $result2 = mysqli_query($connection, $query2);
                                $options2 = "";
                                
                                while ($row2 = mysqli_fetch_array($result2)) {
                                        $options2 = $row2[2];  
                                        $date = strtotime($options2);
                            ?>
                                        <option value="<?php echo date('h:i a', $date) ; ?>"><?php echo date('h:i a', $date) ;?></option>
                            <?php   }
                            ?>
                            </select>
                        </div>
                
                <?php
                    }else {
                ?>
                    <div class="select-input">
                        <label>Select Time</label>
                        <select name="time" class="select">
                            <option value="">--SELECT--</option>
                        </select>
                    </div>
                    <?php        }
                    ?>
                </div>
                <br><hr><br>
                <div class="form-details">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="txtFname" value="<?php echo $_SESSION['fname']; ?>" readonly>
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" value="<?php echo $_SESSION['lname']; ?>" readonly>
                    </div>
                    
                    <div class="input-box">
                        <label>Phone Number</label>
                        <input type="tel" name="numPhone" value="<?php echo $_SESSION['phnumber']; ?>" readonly>
                    </div>
                    <div class="input-box">
                        <label>IC Number</label>
                        <input type="tel" name="numIc" value="<?php echo $_SESSION['ic']; ?>" readonly>
                    </div>
                    <span><i>**Information Can Be Changed in "My Profile" Before Submitting</i></span>
                    <input type="submit" value="Confirm Booking" name="confBooking" class="submit" onclick="return bookingConfirm()">
                </div>
            </form>
        </div>
    </div>
    <br><br>
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
<?php
    if (isset($_POST['confBooking'])) {
        $date = $_POST['date'];
        $time = strtotime($_POST['time']);
        $time1 = date ('H:i:s', $time);
        $id = $_SESSION['id'];

        $sql = "INSERT INTO `tblappointment`(`id`, `docID`, `serviceID`, `apptDate`, `apptTime`, `status`) VALUES ('$id', '$docID', '$serviceID', '$date', '$time1', 'Booked'); UPDATE tbldocshedule SET id= '$id' WHERE docID = '$docID' AND date = '$date' AND time = '$time1';";
        $results3 = $connection->multi_query($sql);
        while(mysqli_next_result($connection)){;}
        if ($results3) {
            $query4 = "SELECT * FROM tblappointment WHERE id = '$id' AND docID = '$docID' AND serviceID = '$serviceID' AND apptDate = '$date' AND apptTime = '$time1'; ";
            $results4 = mysqli_query($connection, $query4);
            while(mysqli_next_result($connection)){;}
            $row3 = mysqli_fetch_assoc($results4); 
            $_SESSION['apptID'] = $row3['apptID'];
            echo "<script> window.location.href='bookingConfirmation.php'; </script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again!")</script>';
        }
    }
} else {
    echo '<script>alert("Please Login to Continue!")</script>';
    echo "<script> window.location.href='makeAppointment.php'; </script>";
}
mysqli_close($connection);
?>

