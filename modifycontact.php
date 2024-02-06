<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection code
    $conn = new mysqli('localhost', 'root', '', 'contacts');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the post records
    $delPhone = $_POST['delphone']; // Store the value in a variable to prevent SQL injection

    // Prepare and bind the DELETE statement
    $sqlSelect = "SELECT * FROM contactinfo WHERE Phone_Number = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $delPhone);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM contactinfo WHERE Phone_Number = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("s", $delPhone);

        // Execute the DELETE statement
        if ($stmtDelete->execute()) {
            $alert = "<script>alert('Contact Deleted Successfully')</script>";
            echo $alert;
        } else {
            echo 'Error deleting contact';
        }

        // Close the DELETE statement
        $stmtDelete->close();
    } else {
        $alert = "<script>alert('Contact Not Present in the Database')</script>";
        echo $alert;
    }

    // Close the SELECT statement and database connection
    $stmtSelect->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script>
    function setVisibility(id, visibility) {
  document.getElementById(id).style.display = visibility;
  }
    </script>
</head>
<body class="modbody">
  <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="logo" src="logo.png"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav nav-links">
        <li class="nav-item active">
          <a class="nav-link" id="navlink1" href="addcontact.php">Add Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navlink2" href="CodingClubDisplay.php">All Contacts</a>
        </li>
        <li class="nav-item">
          <a style="color: white; font-style:italic;"class="nav-link" id="navlink3" href="modifycontact.php">Modify Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navlink4" href="aboutus.html">About Us</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
  <div class="container-fluid " id="sectionmodify">
    <img src="modify-img.png" class=" img-mod d-none d-md-block">
    <form action="modifycontact.php" method="post">
      <div class="container-fluid modify-contact">
        <div class="form-row">
          <div class="form-group col-md-12">
            <h1 style="color: black; ">Delete Contact</h1>
            <label for="inputph" style="color: black;">Phone Number</label>
            <input style="width: 40%;" type="text" class="form-control" id="delphone" name="delphone" placeholder="99XXXXXXX9" required>
            <input style="margin-top: 8px; margin-bottom: 50px;" type="submit" value="Delete" class=" btn button">
          </div>
        </div>
      </div>
    </form>
    <form action="insert.php" method="post">
      <div class="container-fluid modify-contact">
        <div class="form-row">
          <div class="form-group col-md-6">
            <h1 style="color: black; ">Edit Contact</h1>
            <label for="inputph" style="color: black;">Phone Number</label>
            <input style="width: 143%;" type="text" class="form-control" id="inputphup" name="inputphup" placeholder="99XXXXXXX9" required>
            <input style="margin-top: 8px; margin-bottom: 20px;" class="btn button" type=button name=type value='Edit'  onclick="setVisibility('myform', 'inline');";>
            <input style="margin-top: 8px; margin-left: 10px; margin-bottom: 20px;" class="btn button" type=button name=type value='Clear'onclick="setVisibility('myform', 'none');";>
          </div>
        </div>
      </div>    
        <div id="myform" style="display: none;">
            <div class="container" id="sectionaddform">
            <h1 style="color: #00203FFF; ">Modify Contact Details</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label  for="inputfirstname4" style="color: black;">First Name</label>
                <input type="firstname" class="form-control" id="inputfirstname4" name="inputfirstname4" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputlastname4" style="color: black;">Last Name</label>
                <input type="lastname" class="form-control" id="inputlastname4" name="inputlastname4" placeholder="Last Name" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputemail" style="color: black;">E-mail Address</label>
                <input type="text" class="form-control" id="inputemail" name="inputemail" placeholder="xyz@gmail.com">
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputph" style="color: black;">Phone Number</label>
                <input type="text" class="form-control" id="inputph" name="inputph" placeholder="99XXXXXXX9" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputlabel" style="color: black;">State</label>
                <select id="inputlabel" name="inputlabel" class="form-control">
                    <option selected>Choose...</option>
                    <option>Home</option>
                    <option>Work</option>
                    <option>Other</option>
                </select>
    
                </div>
            </div>
          <input type="submit" value="Modify" class=" btn button">
        </div>
      </form>
    </div>
  </div>
</body>
</html>


