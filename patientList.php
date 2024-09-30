<?php
include 'dbConn.php' ;
session_start();

$query = "SELECT * FROM tblpatients";
$results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Elderly Home's Club Patient Page</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/tables.css">
    <script src="javaScript/validation.js"></script>
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
            <h1>Patient List</h1>
            <div align='left'>
                <form action="#" method="get">
                Enter Patient ID: <input type="text" placeholder="Search Patient ID..." name="txtPatID" id="">
                <input type="submit" value="Search" name='Search'>
            </form>
            </div>
            <button class="all-btn" onclick="window.location.href='patientList.php';">Display All</button>
            <div class="clear"></div>
            <hr>
            <?php
                if (isset ($_GET['Search'])) {
                    $id = $_GET['txtPatID'];
                    $query = "SELECT * FROM tblpatients WHERE id = '$id'";
                    $results = mysqli_query($connection, $query); 
                    $count = mysqli_num_rows($results); 
                
                    if ($count != 0) {
            ?>
            <table class="container1">
            <tr>
                <th>Patient ID</th>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Patient Phone Number</th>
                <th>Patient IC</th>
                <th>Patient Gender</th>
                <th>Patient Address</th>
                <th>Patient Email</th>
                <th colspan=2>Actions</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['phonenumber']; ?></td>
                    <td><?php echo $row['IC']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><a href="patientedit.php?myID=<?php echo $row['id']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                    <td><a href="deletepatient.php?myID=<?php echo $row['id']; ?>" onclick="return confirmDelete();"><i class='fas fa-trash-alt'></i> Delete</a></td> 
                </tr>
            <?php
            }
            ?>
            </table>
            <?php
                } else {
                    echo 'Search not Found';
                }
            } else {
                $query = "SELECT * FROM tblpatients";
                $results = mysqli_query($connection, $query);
                ?>
                
                    <table class="container1">
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient First Name</th>
                        <th>Patient Last Name</th>
                        <th>Patient Phone Number</th>
                        <th>Patient IC</th>
                        <th>Patient Gender</th>
                        <th>Patient Address</th>
                        <th>Patient Email</th>
                        <th colspan=2>Actions</th>
                    </tr>
                    
                    <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>
                        <td><?php echo $row['IC']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><a href="patientedit.php?myID=<?php echo $row['id']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                        <td><a href="deletepatient.php?myID=<?php echo $row['id']; ?>" onclick="return confirmDelete();"><i class='fas fa-trash-alt'></i> Delete</a></td> 
                    </tr>
                    <?php
                    }
                }
                mysqli_close($connection);
                ?>
                </table>
                
        </div>
    </section>
            
</body>
</html>