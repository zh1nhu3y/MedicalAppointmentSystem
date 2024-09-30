<?php
include 'dbConn.php' ;
session_start();
$query = "SELECT tblappointment.apptID, tblpatients.firstname, tblpatients.lastname, tbldoctors.docFirstname, tbldoctors.docLastname, tblservice.serviceName, tblappointment.apptDate, tblappointment.apptTime, tblappointment.status FROM tblappointment INNER JOIN tblpatients ON tblappointment.id=tblpatients.id INNER JOIN tbldoctors ON tblappointment.docID=tbldoctors.docID INNER JOIN tblservice ON tblappointment.serviceID=tblservice.serviceID ORDER BY tblappointment.apptID ASC";
$results = mysqli_query($connection, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Elderly Home's Club Admin Appoiment Page</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/tables.css">
</head>

<body>
    <header>
        <div id="line"></div>
        <div id="logo">
            <img src="images/logo.png" alt="The Elderly Home's Club Logo">
        </div>
        <div class="clear"></div>
    </header>
    <aside>
        <div class="adminMenu">
            <h3><?php echo $_SESSION['adminFname'] . ' ' . $_SESSION['adminLname']; ?></h3>
            <ul>
                <li><a href="adminList.php">Admin List</a></li>
                <li><a href="patientList.php">Patient List</a></li>
                <li><a href="appointmentList.php">Appointment List</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </aside>
    <section>
        <div class="infoAdmin">
            <h1>Appointment  List</h1>
            <div align=left>
                <form action="#" method="get">
                Enter Appointment ID: <input type="text" placeholder="Search Appointment ID..." name="txtApptID" id="">
                <input type="submit" value="Search" name='Search'>
            </form>
            <button class="all-btn" onclick="window.location.href='appointmentList.php';">Display All</button>
            <div class="clear"></div>
            </div>

            <hr>

            <?php
                if (isset ($_GET['Search'])) {
                    $id = $_GET['txtApptID'];
                    $query = "SELECT tblappointment.apptID, tblpatients.firstname, tblpatients.lastname, tbldoctors.docFirstname, tbldoctors.docLastname, tblservice.serviceName, tblappointment.apptDate, tblappointment.apptTime, tblappointment.status FROM tblappointment INNER JOIN tblpatients ON tblappointment.id=tblpatients.id INNER JOIN tbldoctors ON tblappointment.docID=tbldoctors.docID INNER JOIN tblservice ON tblappointment.serviceID=tblservice.serviceID WHERE apptID = '$id'";
                    $results = mysqli_query($connection, $query); 
                    $count = mysqli_num_rows($results); 
                
                    if ($count != 0) {
            ?>
            <table class="container1">
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Service Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            
            <?php
            while ($row = mysqli_fetch_assoc($results)) {
                $time = strtotime($row['apptTime']);
                $apptTime = date('h:i a', $time); 
            ?>
                <tr>
                    <td><?php echo $row['apptID']; ?></td>
                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                    <td><?php echo $row['docFirstname'] . ' ' . $row['docLastname']; ?></td>
                    <td><?php echo $row['serviceName']; ?></td>
                    <td><?php echo $row['apptDate']; ?></td>
                    <td><?php echo $apptTime ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a href="appointmentedit.php?myID=<?php echo $row['apptID']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                </tr>
            <?php
            }
            mysqli_close($connection);
            ?>
            </table>
            <?php
                } else {
                    echo 'Search not Found';
                }
            } else {
                $query = "SELECT tblappointment.apptID, tblpatients.firstname, tblpatients.lastname, tbldoctors.docFirstname, tbldoctors.docLastname, tblservice.serviceName, tblappointment.apptDate, tblappointment.apptTime, tblappointment.status FROM tblappointment INNER JOIN tblpatients ON tblappointment.id=tblpatients.id INNER JOIN tbldoctors ON tblappointment.docID=tbldoctors.docID INNER JOIN tblservice ON tblappointment.serviceID=tblservice.serviceID ORDER BY tblappointment.apptID ASC";
                $results = mysqli_query($connection, $query);
                ?>
                
                <table class="container1">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Service Name</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                        $time = strtotime($row['apptTime']);
                        $apptTime = date('h:i a', $time); 
                    ?>
                        <tr>
                        <td><?php echo $row['apptID']; ?></td>
                        <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                        <td><?php echo $row['docFirstname'] . ' ' . $row['docLastname']; ?></td>
                        <td><?php echo $row['serviceName']; ?></td>
                        <td><?php echo $row['apptDate']; ?></td>
                        <td><?php echo $apptTime ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><a href="appointmentedit.php?myID=<?php echo $row['apptID']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                    </tr>

                    <?php
                    }
                }
                    // mysqli_close($connection);
                    ?>
                </table>
                
        </div>
    </section>
</body>
</html>