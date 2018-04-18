<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>
<div class = "form">
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
<div class="radioButton">
	<form method="POST" action="late_timein.php">
		<!-- <hr> -->
    <input type="radio" name="MyRadio" value=1 onclick="document.location.href='undertime.php'">Undertime<br>  
    <input type="radio" name="MyRadio" value=2 onclick="document.location.href='late_timein.php'">Late Time-In<br>
    <input type="radio" name="MyRadio" value=3 onclick="document.location.href='overtime.php'">Overtime<br> 
    <input type="radio" name="MyRadio" value=4 onclick="document.location.href='#'">Change Schedule<br> 
    <input type="radio" name="MyRadio" value=5 onclick="document.location.href='official_business.php'">Official Business<br> 
    <input type="radio" name="MyRadio" value=6 onclick="document.location.href='no_in.php'">No In<br> 
    <input type="radio" name="MyRadio" value=7 onclick="document.location.href='no_out.php'">No Out<br> 
  


    </button>
</form>

</div>
</body>
</html>