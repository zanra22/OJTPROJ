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
			    echo "<br> Employee Number: ". "<input value=".$row['employeeNum']."></input>" . "<br> Full Name: ". $row['firstname']. " " .
			    $row['middlename']. " " . $row['lastname'] . " "."<br>Department: ". $row['department']. "<br> Position: ". $row['position'];
		    }
		}
	}


?> 
<input type="text" name="employeeNum" value="<?php ?>">
</div>
<div>
	<form>
		<hr>
	</form>
</div>
<div class="radioButton">
	<form method="POST" action="result.php">
		<!-- <hr> -->
    <input type="radio" name="MyRadio" value=1 checked>Undertime<br> 
    <input type="radio" name="MyRadio" value=2>Late Time-In<br> 
    <input type="radio" name="MyRadio" value=3>Overtime<br> 
    <input type="radio" name="MyRadio" value=4>Change Schedule<br> 
    <input type="radio" name="MyRadio" value=5>Official Business<br> 
    <input type="radio" name="MyRadio" value=6>No In<br> 
    <input type="radio" name="MyRadio" value=7>No Out<br> 
    <button class="btn" type="submit" value="Submit" name="Result">Submit </button>
</form>

</div>
</body>
</html>