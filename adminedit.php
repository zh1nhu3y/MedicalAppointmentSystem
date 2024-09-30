<?php
session_start();
include 'dbConn.php';

$myID = $_GET['myID'];
if(isset($_POST['update'])){
    $afirstname = $_POST['txtAFName'];
    $alastname = $_POST['txtALName'];
    $aic = $_POST['txtAIC'];
    $agender = $_POST['txtAGender'];
    $aphonenumber = $_POST['txtAPhoneNumber'];
    $aaddress = $_POST['txtAAddress'];
    $updateQuery = "UPDATE `tbladmin` SET `adminFirstname`='$afirstname',`adminLastname`='$alastname',`adminIC`='$aic',`adminGender`='$agender',`adminPhonenumber`='$aphonenumber',`adminAddress`='$aaddress' WHERE adminID='$myID'";
    if(mysqli_query($connection, $updateQuery)) {
        echo 'Record updated successfully';
        header("Location: adminList.php");
    } else {
        echo 'Sorry, something when wrong!';
    }
}
// load data to the form (display)
$query = "SELECT * FROM tbladmin WHERE adminID = " . $myID;
$results = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($results); //$row['email'];
$count = mysqli_num_rows($results);//1 or 0
if ($count == 1){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
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
        <h2>Admin Profile</h2>
        <div class="div1">
        <form action="" method="post">
            <label for="afname">Admin First Name:</label>
            <input type="text" id="afname" name="txtAFName" placeholder="Your name.." value="<?php echo $row['adminFirstname']; ?>" pattern="[A-Za-z\s]+" required>
            <br>
            <label for="alname">Admin Last Name:</label>
            <input type="text" id="alname" name="txtALName" placeholder="Your last name.." value="<?php echo $row['adminLastname']; ?>" pattern="[A-Za-z\s]+" required>
            <br>
            <label for="aic">Admin IC:</label>
            <input type="text" id="aic" name="txtAIC" placeholder="000000000000" value="<?php echo $row['adminIC']; ?>" pattern="[0-9]{12}" required>
            <br>
            <label for="agender">Admin Gender:</label>
                <select id="agender" name="txtAGender" class="form-control" >
                <?php
                    $options = array('Male', 'Female');
                    $selected = $row['adminGender'];
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
            <label for="aphone">Admin Phone Number:</label>
            <input type="text" id="aphone" name="txtAPhoneNumber" placeholder="0123456789" value="<?php echo $row['adminPhonenumber']; ?>" pattern="[0-9]{10,11}" required>
            <br>
            <label for="aaddress">Admin Address: </label>
            <input type="text" id="aaddress" name="txtAAddress" placeholder="Your address.." value="<?php echo $row['adminAddress']; ?>">
            <br>
            <label for="aemail">Admin Email:</label>
            <input type="email" id="aemail" name="txtAEmail" placeholder="Your email.." value="<?php echo $row['adminEmail']; ?>" readonly>
            <br>
            <input type="submit" value="Update" name="update" onclick="return confirmChange()">
        </form>
        </div>

    </section>
    
</body>
</html>

<?php
}else {
        header("Location: adminList.php");
    }
mysqli_close($connection);
?>
