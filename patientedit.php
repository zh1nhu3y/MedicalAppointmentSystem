<?php
session_start();
include 'dbConn.php';

$myID = $_GET['myID'];
if(isset($_POST['update'])){
    $pfirstname = $_POST['txtpFName'];
    $plastname = $_POST['txtpLName'];
    $pphonenumber = $_POST['txtpPhoneNumber'];
    $pic = $_POST['txtpIC'];
    $pgender = $_POST['txtpGender'];
    $paddress = $_POST['txtpAddress'];
    $pemail = $_POST['txtpEmail'];
    $updateQuery = "UPDATE `tblpatients` SET `firstname`='$pfirstname',`lastname`='$plastname',`phonenumber`='$pphonenumber',`IC`='$pic',`gender`='$pgender',`address`='$paddress',`email`='$pemail' WHERE id='$myID'";
    if(mysqli_query($connection, $updateQuery)) {
        echo 'Record updated successfully';
        header("Location: patientList.php");
    } else {
        echo 'Sorry, something when wrong!';
    }}

    $query = "SELECT * FROM tblpatients WHERE id = " . $myID;
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    $count = mysqli_num_rows($results);
    if ($count == 1){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Patient Edit</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/adminEdit.css">
    <link rel="stylesheet" href="styles/admin.css">
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
        <h2>Patient Profile</h2>
        <div class="div1">
        <form action="" method="post">
            <label for="pfname">Patient First Name:</label>
            <input type="text" id="pfname" name="txtpFName" placeholder="Your name.." value="<?php echo $row['firstname']; ?>" pattern="[A-Za-z\s]+" required>
            <br>
            <label for="plname">Patient Last Name</label>
            <input type="text" id="plname" name="txtpLName" placeholder="Your last name.." value="<?php echo $row['lastname']; ?>" pattern="[A-Za-z\s]+" required>
            <br>
            <label for="pic">Patient IC:</label>
            <input type="text" id="pic" name="txtpIC" placeholder="000000000000" value="<?php echo $row['IC']; ?>" pattern="[0-9]{12}" required>
            <br>
            <label for="pgender">Patient Gender:</label>
                <select id="pgender" name="txtpGender" class="form-control" >
                    <?php
                        $options = array('Male', 'Female');
                        $selected = $row['gender'];
                        foreach ($options as $option) {
                            if ($selected == $option) {
                                echo "<option selected value='$selected'>$selected</option>";
                            } else {
                                echo "<option value='$option'>$option</option>";
                            }
                        }
                    ?>
                </select>
            <br>
            <label for="pphone">Patient Phone Number:</label>
            <input type="text" id="pphone" name="txtpPhoneNumber" placeholder="0123456789" value="<?php echo $row['phonenumber']; ?>" pattern="[0-9]{10,11}" required>
            <br>
            <label for="paddress">Patient Address: </label>
            <input type="text" id="paddress" name="txtpAddress" placeholder="Your address.." value="<?php echo $row['address']; ?>" >
            <br>
            <label for="pemail">Patient Email:</label>
            <input type="text" id="pemail" name="txtpEmail" placeholder="Your email.." value="<?php echo $row['email']; ?>" readonly>
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
        header("Location: patientList.php");
    }
mysqli_close($connection);
?>
