<?php
session_start();
include 'dbConn.php';

$myID = $_GET['myID'];
if(isset($_POST['update'])){
    $status = $_POST['txtStatus'];
    $updateQuery = "UPDATE `tblappointment` SET `status`='$status' WHERE apptID='$myID'";
    if(mysqli_query($connection, $updateQuery)) {
        echo 'Record updated successfully';
        header("Location: appointmentList.php");
    } else {
        echo 'Sorry, something when wrong!';
    }
}

$query = "SELECT * FROM `tblappointment` WHERE apptID = $myID";
$results = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($results);
$count = mysqli_num_rows($results);
$time = strtotime($row['apptTime']);
$apptTime = date('h:i a', $time); 
if ($count == 1){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit Appointment</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/adminEdit.css">
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
        <h2>Appointment Details</h2>
        <div class="div1">
        <form action="" method="post">
            <label for="pID">Patient ID:</label>
            <input type="text" id="pID" name="txtpID" placeholder="Patient ID.." value="<?php echo $row['id']; ?>" readonly>
            <br>
            <label for="dID">Doctor ID:</label>
            <input type="text" id="dID" name="txtdFName" placeholder="Doctor name.." value="<?php echo $row['docID']; ?>" readonly>
            <br>
            <label for="sID">Service ID:</label>
            <input type="text" id="sID" name="txtsName" placeholder="Service name.." value="<?php echo $row['serviceID']; ?>" readonly>
            <br>
            <label for="apptdate">Appointment Date:</label>
            <input type="text" id="apptdate" name="txtApptdate" placeholder="Appointment Date.." value="<?php echo $row['apptDate']; ?>" readonly>
            <br>
            <label for="appttime">Appointment Time:</label>
            <input type="text" id="appttime" name="txtAppttime" placeholder="Appointment Time.." value="<?php echo $apptTime; ?>" readonly>
            <br>
            <label for="status">Status:</label>
                <select id="status" name="txtStatus" class="form-control" >
                <?php
                    $options = array('Booked', 'Completed', 'Canceled');
                    $selected = $row['status'];
                    foreach ($options as $option) {
                        if ($selected == $option) {
                            echo "<option selected='selected' value='$selected'>$selected</option>";
                        } else {
                            echo "<option value='$option'>$option</option>";
                        }
                    }
                ?>
                </select>
            <br>
            <input type="submit" value="Update" name="update" onclick="return confirmChange()">
        </form>
        </div>
    </section>
</body>
</html>

<?php
}
    else {
        header("Location: appointmentList.php");
    }
mysqli_close($connection);
?>
