<?php
session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Elderly Home's Club</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
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
    <slideshow>
        <img class="mySlides" src="images/slideshow1.jpg">
        <img class="mySlides" src="images/slideshow2.jpg">
        <img class="mySlides" src="images/slideshow3.jpg">
        <script>
            var slideIndex = 0;
            carousel();

            function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > x.length) {slideIndex = 1}
            x[slideIndex-1].style.display = "block";
            setTimeout(carousel, 2500); // Change image every 2 seconds
            }
        </script>
    </slideshow>
    <br>
    <section id="section1">
        <img src="images/section1.jpg" alt="Elderly with Doctor" class="imgSection1">
        <div id="content1">
            <h1 style="color: dimgrey">Welcome to Elderly Home's Club</h1>
            <h3 style="color:#7a512f">"Your Health, Our Concern"</h3>
            <p>
            The Elderly Home's Club is a social welfare organization that offers shelter, support and medical services to poor seniors. It is a non-profit organisation. By establishing homes for the elderly, the organisation hopes that the poor and the homeless can now have a place where they can call their homes, where they can also enjoy a better quality of life. These clinics are staffed by healthcare specialists that have experience treating seniors' unique health needs, such as managing chronic diseases, providing preventive care, and giving support for age-related health concerns. <br>
            </p>
            <div class="clear"></div>
        </div>
    </section>
    <section class="section2-bg">
        <h1  class="hidden" align="center">Why Choose Us?</h1>
        <div class="section2">
            <p class="content2 icn hidden" style="--order: 1">
                <img class="myIcon" src="images/medical-team.png" alt="Medical Team Icon"><br/>
                <br/>
                Professional Doctors
            </p>
            <p class="content2 icn hidden" style="--order: 2">
                <img class="myIcon" src="images/stethoscope.png" alt="Stethoscope Icon"><br/>
                <br/>
                Advance Technology
            </p>
            <p class="content2 icn hidden" style="--order: 3">
                <img class="myIcon" src="images/care.png" alt="Care Unit Icon"><br/>
                <br/>
                Friendly Care Unit
            </p>
        </div>
        <div class="myBtn">
            <button class=myButton onclick="window.location.href = 'aboutUs.php';">Learn More About Us</button>
            <button class=myButton onclick="window.location.href = 'makeAppointment.php';">Book Appointment Now</button>
        </div>
        <script>
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    console.log(entry)
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    } 
                })
            })
            const hiddenElements = document.querySelectorAll('.hidden');
            hiddenElements.forEach((el) => observer.observe(el));
        </script>
    </section>
    <section> 
        <img src="images/section3-1.jpg" alt="Elderly Exercising" class="sect3" style="--order: 1">
        <div id="sub3-1" class="sect3">
            <h2>General Care</h2>
            <p>General care for the elderly aims to address the health requirements and concerns of older persons. Services may include regular check-ups, chronic condition treatment, preventive care, and assistance with age-related health issues.</p>
            <br>
            <button class="cont3-btn" onclick="window.location.href = 'descGeneralT.php';">Learn More</button>
        </div>
        <img src="images/section3-3.jpg" alt="Doctor" class="sect3" style="--order: 2">
        <div id="sub3-2" class="sect3">
            <h2>Covid-19</h2>
            <p>The COVID-19 vaccine offers excellent defence against critical disease, hospitalisation, and death. The decision to obtain the vaccine also protects those around you reducing your risk of spreading the infection to others.</p>
            <br>
            <button class="cont3-btn" onclick="window.location.href = 'descVaccination.php';">Learn More</button>
        </div>
        <div class="clear"></div>
    </section>
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