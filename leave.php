<?php include('../server.php');
      // include('mail.php');

 ?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="../homepage.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<title>Leave</title>
	<style type="text/css">
		* {
			background-color: white;
			font-family: Proxima Nova;
			margin: 0;
			padding: 0;
		}

		img {
			width: 80%;
			height: auto;
		}

		.logo {
			width: 50%;
			margin: auto;
			padding: 10px;
		}
		.leave {
			text-align: center;
			padding-top: 50px;
			width: 100%;
			height: auto;
		}

		th {
		    border: 1px solid #bb9121;
		    color: black;
		    text-align: center;
		    padding: 12px;
		}

		.table-bordered th{
		    border: 1px solid #bb9121;
		}

		td {
			padding: 12px;
			border: 1px solid #bb9121;
		}
	</style>
</head>
<body>
	<div class="logo">
		<img src="../img/logo.png">
	</div>
	
	<div class="leave">
		<form action="leave.php" method="post">
			<table>
				<tr>
					<tr>
						<th>Employee Number</th>
						<th>Name</th>
						<th>Department</th>
						<th>Date of Leave</th>
						<th>No. of Days</th>
						<th>Time Shift</th>
						<th>Reason</th>
						<th>Choice</th>

					</tr>
					<?php 
						$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
						if (isset($_SESSION['employee_N'])) {
				      	$employee_Number = $_SESSION['employee_N'];
						$sql = "SELECT * FROM user WHERE employeeNum = '$employee_Number'";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
						    // output data of each row
							while($row = $result->fetch_assoc()) {
							    echo '<tr><td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:black;" type = "text"  readonly name = "employeeNumber" value="'.$row["employeeNum"].'"></input></td>';

							    echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:black; width:223px;" type = "text" readonly name = "full_name" value = "'.$row["lastname"].", ".$row["firstname"]." ".$row["middlename"].'"></input></td>';
							    echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:black;" type = "text"  readonly name = "department" value="'.$row["department"].'"></input></td>';

			    }
			}
		}


	?> <td>
						
							<strong>FROM </strong><input type="Date" name="first"><br>
							<strong>TO </strong> <input type="Date" name="last">
						
					</td>
					<td>
						
							<input type="number" name="quantity" min="1" style="text-align: center;">
						
					</td>
					<td>
						
							<input type="Time" name="in"> To 
							<input type="Time" name="out">
						
					</td>
					<td>
						<select style="border: 1px solid #bb9121;">
							<option value="vacay">Vacation</option>
							<option value="mater">Maternity</option>
							<option value="pater">Paternity</option>
							<option value="sick">Sick</option>
							<option value="ado">ADO</option>
							<option value="other">Other</option>
						</select>
					</td>

					<td>
						<select style="border: 1px solid #bb9121;">
							<option value="wp">With Pay</option>
							<option value="wop">Without Pay</option>
						</select>
					</td>
				</tr>
			</table>
		</form>
	</div>

	
	<button class="btn btn-outline-warning btn-lg" align="center" type="submit" name="leave_submit" value="Submit">Submit</button>
	<div style="text-align: center;"><a href="../index.php">Back</a></div>

</body>
</html>