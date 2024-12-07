<?php
// Fetch the data passed via URL
$inquire = isset($_GET['inquire']) ? $_GET['inquire'] : '';
$course = isset($_GET['course']) ? $_GET['course'] : '';
$certification = isset($_GET['certification']) ? $_GET['certification'] : '';

// Fetch the latest queue ID from the admin table
include 'connect.php';
$conn->select_db('login');
$result = $conn->query("SELECT MAX(id) AS last_id FROM admin WHERE queue_system = 'Accounting'");
$row = $result->fetch_assoc();
$queue_id = $row['last_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accounting Confirmation</title>
  <link rel="stylesheet" href="AccountingConfirmation.css">
</head>
<body>
  <div class="confirmation">
    
    <h1>Queue Confirmation</h1>

    <p><strong>QUEUE NUMBER</strong> <br><?php echo $queue_id; ?></p>

    <h2>Selected Details:</h2>
    <ul class="transactions">
      <?php if ($inquire) echo "<li>Inquire</li>"; ?>
      <?php if ($course) echo "<li>Course: $course</li>"; ?>
      <?php if ($certification) echo "<li>Certification</li>"; ?>
    </ul>

    <a href="home.html" class="btn">Go Home</a>
  </div>
</body>
</html>
