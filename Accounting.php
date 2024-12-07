<?php
include 'connect.php';  // Assuming this file contains the connection to the database

// Select the correct database
$conn->select_db('login'); // Ensure the 'login' database is selected

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect values from the form
    $inquire = isset($_POST['Inquire']) ? $_POST['Inquire'] : '';  // Handle checkbox value
    $course = isset($_POST['Course']) ? $_POST['Course'] : '';      // Handle dropdown value
    $certification = isset($_POST['Certification']) ? $_POST['Certification'] : '';

    // Insert the data into the 'admin' table
    if ($inquire || $course || $certification) {
        // Prepare the SQL query to insert the values
        $sql = "INSERT INTO admin (inquire, course, certification, queue_system) 
                VALUES ('$inquire', '$course', '$certification', 'Accounting')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Redirect or show a success message
            echo "<script>alert('You have been added to the queue!'); window.location.href = 'home.html';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please select options and fill in all required fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounting</title>
    <link rel="stylesheet" href="Accounting.css">
</head>
<body>
    <div class="cashier">
        <a href="home.html" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>
        <h1>Accounting</h1>
        <form action="" method="POST">
            <div class="form-group checkbox-group">
                <input type="checkbox" id="Inquire" name="Inquire" value="Inquire">
                <label for="Inquire">Inquire</label>
            </div>   
              
            <div class="form-group">
                <label for="Course">Choose Course:</label>
                <select name="Course" id="cars">
                    <option value="BSIT">BSIT</option>
                    <option value="BSN">BSN</option>    
                    <option value="BSA">BSA</option>
                    <option value="BSIS">BSIS</option>
                </select>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="Certification" name="Certification" value="Certification">
                <label for="Certification">Certification</label>
            </div> 

            <button type="submit" class="btn" id="queueBtn">Queue</button>
        </form>
    </div>
</body>
</html>
