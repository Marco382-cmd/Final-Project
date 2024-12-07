<?php
include 'connect.php';  // Assuming this file contains the connection to the database

// Select the correct database
$conn->select_db('login'); // Ensure the 'login' database is selected

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least one checkbox is selected
    $selected_transactions = [];

    // Collect the selected transactions
    if (isset($_POST['transaction'])) {
        // 'transaction' is the name for all checkboxes
        $selected_transactions = $_POST['transaction'];
    }

    // Check if any transaction was selected
    if (count($selected_transactions) > 0) {
        // Prepare the registrar transactions data for insertion into the database
        $registrar_transactions = implode(', ', $selected_transactions);  // Converts the array to a comma-separated string

        // SQL query to insert the selected transactions into the admin table
        $sql = "INSERT INTO admin (registrar_transactions, queue_system) 
                VALUES ('$registrar_transactions', 'Registrar')";

        // Execute the query for admin table
        if ($conn->query($sql) === TRUE) {
            // Get the last inserted ID
            $last_id = $conn->insert_id;

            // Redirect to homepage.php with the queue ID and selected transactions as URL parameters
            $transactions_str = urlencode($registrar_transactions);
            header("Location: Registrarconfirmation.php?id=$last_id&transactions=$transactions_str");
            exit();
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please select at least one service.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar</title>
  <link rel="stylesheet" href="Registrar.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>  

  <div class="container">
    <a href="home.html" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>
    <h1>Registrar</h1>

    <form action="" method="POST" class="registrar-form">
      <section class="checkbox-group">
        <div class="checkbox-item">
          <input type="checkbox" id="certi" name="transaction[]" value="Certification">
          <label for="certi">Certification</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="courseDesc" name="transaction[]" value="Course Description">
          <label for="courseDesc">Course Description</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="rle" name="transaction[]" value="Related Learning Experience (RLE)">
          <label for="rle">Related Learning Experience (RLE)</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="chi" name="transaction[]" value="Clock Hours / Internship">
          <label for="chi">Clock Hours / Internship</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="diploma" name="transaction[]" value="Diploma">
          <label for="diploma">Diploma</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="cav" name="transaction[]" value="CAV">
          <label for="cav">CAV</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="syllabus" name="transaction[]" value="Syllabus">
          <label for="syllabus">Syllabus</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="transcriptGraduate" name="transaction[]" value="Transcript of Records (Graduate)">
          <label for="transcriptGraduate">Transcript of Records (Graduate)</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="transcriptUndergraduate" name="transaction[]" value="Transcript of Records (Undergraduate)">
          <label for="transcriptUndergraduate">Transcript of Records (Undergraduate)</label>
        </div>
        <div class="checkbox-item">
          <input type="checkbox" id="transcriptTransfer" name="transaction[]" value="Transcript of Records (Transfer Credentials)">
          <label for="transcriptTransfer">Transcript of Records (Transfer Credentials)</label>
        </div>
      </section>

      <input type="submit" class="btn" id="queueBtn" name="queue" value="Queue">
    </form>
  </div>

</body>
</html>
