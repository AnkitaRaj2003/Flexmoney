<?php
include 'partials/connect.php';

// Fetching Data
$name = $_POST['name'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$batch = $_POST['batch'];
$method = $_POST['method'];

// Extra variables
$flag = 0;
$currentDate = new DateTime();

// Check if this person has already enrolled in any batch
$sql = "SELECT * FROM `enrollment` WHERE `phone`='$phone' ORDER BY `enroll_at` DESC";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);

if ($count > 0) {
    $row = mysqli_fetch_assoc($query);

    // Convert the database 'expiry' value to a DateTime object
    $expiryDate = new DateTime($row['expiry']);

    if ($expiryDate > $currentDate) {
        $flag = 1;
        echo '<script>alert("You have already enrolled in a batch!")</script>';
    }
}

if ($flag == 0) {
    // Making Payment ID
    $paymentId = uniqid('PAY');

    // Insert payment information
    $sql = "INSERT INTO `payment`(`method`) VALUES('$method')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // Calculate expiry date (last day of the current month)
        $currentDate->modify('last day of this month');
        $lastDayOfMonth = $currentDate->format('Y-m-d H:i:s');

        // Insert enrollment information
        $sql = "INSERT INTO `enrollment`(`name`,`age`,`phone`,`b_id`,`p_id`,`expiry`) VALUES('$name','$age','$phone','$batch','$paymentId','$lastDayOfMonth')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '<script>alert("You have successfully enrolled in the batch. All other details will be shared with you through WhatsApp or email. Stay Tuned!")</script>';
        } else {
            echo '<script>alert("Error in submitting the form. Kindly try again later!")</script>';
        }
    } else {
        echo '<script>alert("Error in submitting the form. Kindly try again later!")</script>';
    }
}
//Redireting to Home Page
echo '<script>window.location.href = "index.php";</script>';
?>
