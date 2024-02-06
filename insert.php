<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The form has been submitted
    // Database connection code
    $conn = new mysqli('localhost', 'root', '', 'contacts');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the post records
    $fn = isset($_POST['inputfirstname4']) ? $_POST['inputfirstname4'] : '';
    $ln = isset($_POST['inputlastname4']) ? $_POST['inputlastname4'] : '';
    $phone = isset($_POST['inputph']) ? $_POST['inputph'] : '';
    $email = isset($_POST['inputemail']) ? $_POST['inputemail'] : '';
    $state = isset($_POST['inputlabel']) ? $_POST['inputlabel'] : '';
    $phoneToUpdate = isset($_POST['inputphup']) ? $_POST['inputphup'] : '';

    // Validate and sanitize user inputs if needed

    // Prepare and bind the SELECT statement
    $sqlSelect = "SELECT * FROM contactinfo WHERE Phone_Number = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $phoneToUpdate);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        // SQL UPDATE statement with prepared statements
        $sqlUpdate = "UPDATE contactinfo SET 
        First_Name = ?, 
        Last_Name = ?, 
        Phone_Number = ?, 
        Email = ?, 
        _state = ? 
        WHERE Phone_Number = ?";

        // Prepare and bind the UPDATE statement
        $stmtUpdate = $conn->prepare($sqlUpdate);
        if ($stmtUpdate) {
            // Bind parameters to the UPDATE statement
            $stmtUpdate->bind_param('ssssss', $fn, $ln, $phone, $email, $state, $phoneToUpdate);

            // Execute the UPDATE statement
            if ($stmtUpdate->execute()) {
                echo '<script type="text/javascript">'; 
                echo 'alert("Contact Updated Successfully");'; 
                echo 'window.location.href = "modifycontact.php";';
                echo '</script>';
            } else {
                echo "Error updating contact.";
                // Log detailed error message: error_log($stmtUpdate->error);
            }

            // Close the UPDATE statement
            $stmtUpdate->close();
        } else {
            echo "Error preparing update statement.";
            // Log detailed error message: error_log($conn->error);
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Contact Does not Exist in the Database");'; 
        echo 'window.location.href = "modifycontact.php";';
        echo '</script>';
    }

    // Close the SELECT statement and database connection
    $stmtSelect->close();
    $conn->close();
}
?>
