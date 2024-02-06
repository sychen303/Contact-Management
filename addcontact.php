<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact-Management</title>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
</head>
<body class="mainbody">
  <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="logo" src="logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav nav-links">
        <li class="nav-item active">
          <a style="color: white; font-style:italic;" class="nav-link" id="navlink1" href="#">Add Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navlink2" href="CodingClubDisplay.php">All Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navlink3" href="modifycontact.php">Modify Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navlink4" href="aboutus.html">About Us</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
  <img src="add-img.png" class="img d-none d-md-block">
  <form action="addcontact.php" method="post">
    <div class="container" id="sectionaddform">
      <h1 style="color: black; margin-bottom: 20px;">Add Contact</h1>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label  for="inputfirstname4" style="color: black;">First Name</label>
          <input type="firstname" class="form-control" id="fn" name="fn" placeholder="First Name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputlastname4" style="color: black;">Last Name</label>
          <input type="lastname" class="form-control" id="ln" name="ln" placeholder="Last Name" >
        </div>
      </div>
      <div class="form-group">
        <label for="inputemail" style="color: black;">E-mail Address</label>
        <input type="text" class="form-control" id="mail" name="mail" placeholder="xyz@gmail.com">
      </div>
      
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputph" style="color: black;">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="99XXXXXXX9" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputlabel" style="color: black;">Label</label>
          <select id="state" name="state" class="form-control" required>
            <option selected>Choose...</option>
            <option>Home</option>
            <option>Work</option>
            <option>Other</option>
          </select>
        </div>
      </div>
      <input type="submit" value="Submit" class=" btn button">
    </div>
  </form>
  <div class="container-fluid all-contact" id="sectionallcontacts">
    

  </div>
  
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The form has been submitted

    // database connection code
    $conn = new mysqli('localhost', 'root', '', 'contacts');

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // get the post records
    $txtName = $_POST['fn'];
    $txtLastname = $_POST['ln'];
    $txtEmail = $_POST['mail'];
    $txtPhone = $_POST['phone'];
    $txtState = $_POST['state'];

    // use prepared statement for select query
    $sqlSelect = "SELECT * FROM contactinfo WHERE Phone_Number = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $txtPhone);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        $alert = "<script>alert('Contact Already Present in the Database')</script>";
        echo $alert;
    } else {
        // use prepared statement for insert query
        $sql = "INSERT INTO `contactinfo` (`First_Name`, `Last_Name`, `Email`, `Phone_Number`, `_state`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $txtName, $txtLastname, $txtEmail, $txtPhone, $txtState);

        // insert in database 
        if ($stmt->execute()) {
            $alert = "<script>alert('Contact Saved Successfully')</script>";
            echo $alert;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }

    // close prepared statement and database connection
    $stmtSelect->close();

    $conn->close();
}
?>
