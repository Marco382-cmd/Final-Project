<?php
// Assuming the database connection is included here
include 'connect.php';

if (isset($_GET['id']) && isset($_GET['transactions'])) {
    // Get the queue ID and the selected transactions from URL parameters
    $queue_id = $_GET['id'];
    $transactions = urldecode($_GET['transactions']);
} else {
    // Redirect back if parameters are not set
    header("Location: home.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Queue Confirmation</title>
  <link rel="stylesheet" href="RegistrarConfirmation.css">
</head>
<body>

  <div class="container">
    <h1>Queue Confirmation</h1>
    <p><strong>QUEUE NUMBER:</strong><br> <?php echo $queue_id; ?></p>
    <p><strong>Selected Transactions:</strong><br> <?php echo $transactions; ?></p>
    <a href="home.html" class="btn">Go to Home</a>
  </div>

</body>
</html>
