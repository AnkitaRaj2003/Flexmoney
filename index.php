<?php
// Include the database connection file
include 'partials/connect.php';

// Fetching Batch Details
$sql = 'SELECT * FROM `batch`';
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yoga Class Admission Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Yoga Class Admission Form</h2>

    <!-- Admission Form -->
    <form id="admissionForm" onsubmit="return validate()" method="post" action="enroll.php">
      <!-- Name Input -->
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>

      <!-- Age Input -->
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
      </div>

      <!-- Phone Input -->
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="number" name="phone" id="phone" required>
      </div>

      <!-- Payment Method Dropdown -->
      <div class="form-group">
        <label for="method">Payment Method</label>
        <select name="method" id="method">
          <option value="UPI">UPI</option>
          <option value="credit_card">Credit Card</option>
          <option value="debit_card">Debit Card</option>
        </select>
      </div>

      <!-- Preferred Batch Dropdown -->
      <div class="form-group">
        <label for="batch">Preferred Batch:</label>
        <select id="batch" name="batch" required>
          <?php
            // Display batch options from the database
            while($row = mysqli_fetch_assoc($query)){
              $id = $row['id'];
              $start = $row['start'];
              $end = $row['end'];
              $time = $row['time'];
              echo "<option value='$id'>$start-$end $time</option>";
            }
          ?>
        </select>
      </div>

      <!-- Submit Button -->
      <div style="text-align: center;">
        <input type="submit" id="sub-btn" value="Submit">
      </div>
    </form>
    <!-- End Admission Form -->
  </div>

  <!-- JavaScript File -->
  <script src="script.js"></script>
</body>
</html>
