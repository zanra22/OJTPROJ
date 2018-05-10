<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="ojtCss/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title></title>
</head>
<body style="background-color: black;">
	<div class="adminindex_half">
    <div class="container">
        <div class="row">
            <div class = "adminindex_one col-md-12">
                <img src="img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<div style="text-align: center;color: #bb9121;font-size: 20px;" class = "form">
	<?php
		$servername = 'localhost';
		$username = 'root';
		$password = 'str0ngpa$$w0rd';
		$dbname = 'registration';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
   			 die("Connection failed: " . $conn->connect_error);
			} 

	if (isset($_SESSION['employee_N'])) {
      	$employee_Number = $_SESSION['employee_N'];
		$sql = "SELECT * FROM user WHERE employeeNum = '$employee_Number'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
			while($row = $result->fetch_assoc()) {
			    echo "<br><strong> Employee Number: </strong>".$row['employeeNum']. "<br><strong> Full Name: </strong> ". $row['firstname']. " " .
			    $row['middlename']. " " . $row['lastname'] . " "."<br><strong>Department: </strong>". $row['department']. "<br><strong> Position: </strong>". $row['position'];
		    }
		}
	}


?> 

</div>
<div>
	<form>
		<hr>
	</form>
</div>
<div class="adminindex_content">
		<!-- <hr> -->
	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/undertime.php" name="employee_form">Undertime</a></p>
	<p><a  style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/late_timein.php" name="employee_form">Late Time In</a></p>
	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/overtime_final.php" name="employee_form">Overtime</a></p>
   	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/official_business.php" name="employee_form">Official Business</a></p>
   	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/no_in.php" name="employee_form">No In</a></p>
   	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="ojtForm/no_out.php" name="employee_form">No Out</a></p>

   	<p><a style="text-decoration: none;color: #bb9121;" class="loginButton" href="../index.php">Home</a></p>
</div>
</body>
</html>