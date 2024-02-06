<!-- PHP code to establish connection with the localserver -->
<?php
 $mysqli = new mysqli('localhost', 'root',
                '', 'contacts');
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = " SELECT * FROM contactinfo";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">
 
<head>

    <meta charset="UTF-8">
    <title>Contact Styling</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin-top:10%;
            font-size: large;
            border: 1px solid black;
            width: 100%;
        }
 
        h1 {
            text-align: center;
            color: black;
            font-size: xx-large;
            font-family: 'Raleway';
        }
 
        td {
            border: 1px solid black;
        }
        th{
            background-color: #89ABE3FF;
        }
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            font-family:'Raleway';
        }
 
       
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c6266cbdf4.js" crossorigin="anonymous"></script>

</head>
 
<body class="display-body">
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="logo" src="logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav nav-links">
        <li class="nav-item active">
          <a class="nav-link" id="navlink1" href="addcontact.php">Add Contact</a>
        </li>
        <li class="nav-item">
          <a style="color: white; font-style:italic;" class="nav-link" id="navlink2" href="CodingClubDisplay.php">All Contacts</a>
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
    <section>
        <h1>Contacts</h1>
        <!-- TABLE CONSTRUCTION -->
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 display-table">
                <h1 style="color: black; text-align:left;margin-bottom:-5%;">All Contacts</h1>
                <table>
            <tr>
                <th>First_Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>State</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['First_Name'];?></td>
                <td><?php echo $rows['Last_Name'];?></td>
                <td><?php echo $rows['Email'];?></td>
                <td><?php echo $rows['Phone_Number'];?></td>
                <td><?php echo $rows['_state'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
                </div>
            </div>
        </div>
    </section>
</body>
 
</html>