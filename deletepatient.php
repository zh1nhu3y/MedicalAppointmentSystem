<?php
include 'dbConn.php';

$myID = $_GET['myID'];

$query = "DELETE FROM tblpatients WHERE id = '$myID'";
if(mysqli_query($connection, $query)) {
    header("Location: patientList.php"); //redirect the user to another page
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>