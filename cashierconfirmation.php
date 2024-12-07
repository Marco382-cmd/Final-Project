<?php
include 'connect.php';  // Assuming this file contains the connection to the database

// Select the correct database
$conn->select_db('login'); // Ensure the 'login' database is selected

// Fetch the query parameters from the URL
$tuition = isset($_GET['tuition']) ? $_GET['tuition'] : '';
$other = isset($_GET['other']) ? $_GET['other'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : '';

// Fetch the latest queue ID from the admin table
$result = $conn->query("SELECT MAX(id) AS last_id FROM admin WHERE queue_system = 'Cashier'");
$row = $result->fetch_assoc();
$queue_id = $row['last_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cashier Confirmation</title>
  <link rel="stylesheet" href="CashierConfirmation.css">
</head>
<body>
  <div class="confirmation">
   
    <h1>Queue Confirmation</h1>

    <p><strong>QUEUE NUMBER</strong> <br><?php echo $queue_id; ?></p>

    <h2>Selected Details:</h2>
    <ul class="transactions">
      <?php if ($tuition) echo "<li>Tuition</li>"; ?>
      <?php if ($other) echo "<li>Other: $other</li>"; ?>
      <?php if ($amount) echo "<li>Amount: $amount</li>"; ?>
    </ul>

    <a href="home.html" class="btn">Go Home</a>
  </div>
</body>
</html>
