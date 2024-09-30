<?php
include 'dbConn.php' ;
session_start();
$query = "SELECT * FROM tbladmin";
$results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Elderly Home's Club Admin Page</title>
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
        <!-- <div id="line"></div> -->
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
        <div class="infoAdmin" align="left">
            <h1>Admin List</h1>
            <div align="left">
                <form class="adminsearchbox" action="" method="get" >
                    Enter Admin ID: <input type="text" placeholder="Search Admin ID..." name="txtAdminID" id="">
                    <input type="submit" value="Search" name='Search'>
                </form>
                <button class="all-btn" onclick="window.location.href='adminList.php';">Display All</button>
                <div class="clear"></div>
            </div>
            <hr>
            <?php
                if (isset ($_GET['Search'])) {
                    $id = $_GET['txtAdminID'];
                    $query = "SELECT * FROM tbladmin WHERE adminID = '$id'";
                    $results = mysqli_query($connection, $query); 
                    $count = mysqli_num_rows($results); 
                
                    if ($count != 0) {
            ?>
            <table class="container1">
            <tr>
                <th>Admin ID</th>
                <th>Admin First Name</th>
                <th>Admin Last Name</th>
                <th>Admin IC</th>
                <th>Admin Gender</th>
                <th>Admin Contact</th>
                <th>Admin Address</th>
                <th>Admin Email Address</th>
                <th colspan=2>Actions</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <tr>
                    <td><?php echo $row['adminID']; ?></td>
                    <td><?php echo $row['adminFirstname']; ?></td>
                    <td><?php echo $row['adminLastname']; ?></td>
                    <td><?php echo $row['adminIC']; ?></td>
                    <td><?php echo $row['adminGender']; ?></td>
                    <td><?php echo $row['adminPhonenumber']; ?></td>
                    <td><?php echo $row['adminAddress']; ?></td>
                    <td><?php echo $row['adminEmail']; ?></td>
                    <td><a href="adminedit.php?myID=<?php echo $row['adminID']; ?>"><i class='fas fa-edit'></i>Edit</a></td>
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
                $query = "SELECT * FROM tbladmin";
                $results = mysqli_query($connection, $query);
                ?>

                    <table class="container1">
                            <tr>
                                <th>Admin ID</th>
                                <th>Admin First Name</th>
                                <th>Admin Last Name</th>
                                <th>Admin IC</th>
                                <th>Admin Gender</th>
                                <th>Admin Contact</th>
                                <th>Admin Address</th>
                                <th>Admin Email Address</th>
                                <th colspan=2>Actions</th>
                            </tr>
                    
                    <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                    ?>
                            <tr>
                                <td><?php echo $row['adminID']; ?></td>
                                <td><?php echo $row['adminFirstname']; ?></td>
                                <td><?php echo $row['adminLastname']; ?></td>
                                <td><?php echo $row['adminIC']; ?></td>
                                <td><?php echo $row['adminGender']; ?></td>
                                <td><?php echo $row['adminPhonenumber']; ?></td>
                                <td><?php echo $row['adminAddress']; ?></td>
                                <td><?php echo $row['adminEmail']; ?></td>
                                <td><a href="adminedit.php?myID=<?php echo $row['adminID']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
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