<?php
include 'dbConn.php';
$apptID = $_GET['apptID'];
$query = "SELECT * FROM tblappointment WHERE apptID = '$apptID'";
$result = mysqli_query ($connection, $query);
$row = mysqli_fetch_assoc($result);
$docID = $row['docID'];
$date = $row['apptDate'];
$time = $row['apptTime'];

$query2 = "UPDATE `tblappointment` SET status='Canceled' WHERE apptID = '$apptID' ; UPDATE `tbldocshedule` SET id = NULL WHERE docID = '$docID' AND date = '$date' AND time = '$time';";
$results2 = $connection->multi_query($query2);

if ($results2) {
    echo '<script>alert("Appointment Canceled")</script>';
    echo "<script> window.location.href='myAppointment.php'; </script>";
} else {
    echo 'Sorry, something went wrong!';
}
mysqli_close($connection);
?>