<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="ojtCss/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title></title>
</head>
<body style="background-color: #fffacd;">
<div class="adminindex_half">
    <div class="container">
        <div class="row">
            <div class = "adminindex_one col-md-12">
                <img src="img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
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

<?php if ($_SESSION['type'] == 'Employee') { ?>

<div class="adminindex_content">
		<!-- <hr> -->
	<p><a  class="loginButton class1 zoom" href="ojtForm/undertime.php" name="employee_form">Undertime</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/late_timein.php" name="employee_form">Late Time In</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/overtime_final.php" name="employee_form">Overtime</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/official_business.php" name="employee_form">Official Business</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_in.php" name="employee_form">No In</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_out.php" name="employee_form">No Out</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/leave_final.php" name="employee_form">Leave Application</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeSchedule.php" name="employee_form">Change Schedule</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeOff.php" name="employee_form">Change Off</a><br><br></p><br>
   	<!-- <p><a  class="loginButton class1 zoom" href="ojtForm/changeOff.php" name="employee_form">Others</a><br><br></p><br> -->
   	<p><a class="loginButton class1 zoom" href="../index.php">Home</a></p>
</div>
<?php } ?>

<?php if ($_SESSION['type'] == 'HR') { ?>

<div class="adminindex_content">
		<!-- <hr> -->
	<p><a  class="loginButton class1 zoom" href="ojtForm/undertime.php" name="employee_form">Undertime</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/late_timein.php" name="employee_form">Late Time In</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/overtime_final.php" name="employee_form">Overtime</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/official_business.php" name="employee_form">Official Business</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_in.php" name="employee_form">No In</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_out.php" name="employee_form">No Out</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/leave_final.php" name="employee_form">Leave Application</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeSchedule.php" name="employee_form">Change Schedule</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeOff.php" name="employee_form">Change Off</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/others.php" name="employee_form">Others</a><br><br></p><br>
   	<p><a class="loginButton class1 zoom" href="../index.php">Home</a></p>
</div>
<?php } ?>

<?php if ($_SESSION['type'] == 'deptHead') { ?>

<div class="adminindex_content">
		<!-- <hr> -->
	<p><a  class="loginButton class1 zoom" href="ojtForm/undertime.php" name="employee_form">Undertime</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/late_timein.php" name="employee_form">Late Time In</a><br><br></p><br>
	<p><a  class="loginButton class1 zoom" href="ojtForm/overtime_final.php" name="employee_form">Overtime</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/official_business.php" name="employee_form">Official Business</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_in.php" name="employee_form">No In</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/no_out.php" name="employee_form">No Out</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/leave_final.php" name="employee_form">Leave Application</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeSchedule.php" name="employee_form">Change Schedule</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeOff.php" name="employee_form">Change Off</a><br><br></p><br>
   	<p><a  class="loginButton class1 zoom" href="ojtForm/changeOff.php" name="employee_form">Others</a><br><br></p><br>
   	<p><a class="loginButton class1 zoom" href="../index.php">Home</a></p>
</div>
<?php } ?>
</body>
</html>