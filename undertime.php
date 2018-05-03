<?php include('../server.php');
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../homepage.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<title></title>

</head>
<body style="background-color: black;">
<div class="half">
    <div class="container">
        <div class="row">
            <div class = "one col-md-12">
                <img style="width: 70%; height: 200px;margin-left: auto;margin-right: auto;display: block;margin-top: 20px;" src="../img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<form style="width: 1px;" action="undertime.php" method="post">
	<?php include('../errors.php'); ?>
	<table  class="table table-bordered table-striped" align="center">
		<tr style="border: 1px solid #bb9121;">
			
			<th style="border: 1px solid #bb9121;color: #bb9121;">Employee Number</th>
			<th style="border: 1px solid #bb9121;color: #bb9121;">Full Name</th>
			<!-- <th>Email</th> -->
			<th style="border: 1px solid #bb9121;color: #bb9121;">Department</th>
			<th style="border: 1px solid #bb9121;color: #bb9121;">Request</th>
			<th style="border: 1px solid #bb9121;color: #bb9121;">Request Type</th>
			<th style="border: 1px solid #bb9121;color: #bb9121;"></th>

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
			    echo '<tr><td style="border: 1px solid #bb9121;color: #bb9121;"><input style="text-align:center; background-color:black; color:#bb9121; border:0px;" type = "text"  readonly name = "employeeNumber" value="'.$row["employeeNum"].'"></input></td>';

			    echo '<td style="border: 1px solid #bb9121;color: #bb9121;"><input style="text-align:center; background-color:black; color:#bb9121; border:0px; width:225px;" type = "text" readonly name = "full_name" value = "'.$row["lastname"].", ".$row["firstname"]." ".$row["middlename"].'"></input></td>';
			    
			    echo '<input hidden style="text-align:center; background-color:black; color:#bb9121; border:0px;" type = "text"  readonly name = "email" value="'.$row["email"].'"></input>';

			    echo '<td style="border: 1px solid #bb9121;color: #bb9121;"><input style="text-align:center; background-color:black; color:#bb9121; border:0px;" type = "text"  readonly name = "department" value="'.$row["department"].'"></input></td>';

			    echo '<td style="border: 1px solid #bb9121;color: #bb9121;"><input style="text-align:center; background-color:black; color:#bb9121; border:0px;" type = "text" readonly name = "request_type" value = "UNDERTIME"></input></td>';

			    echo '<td style="border: 1px solid #bb9121;color: #bb9121;"><input style="text-align:center; background-color:black; color:#bb9121; border:0px; width: 400px;" type = "text" name = "reason_1"></input></td>';

			    echo '<td style="border: 1px solid #bb9121;color: #bb9121;"><button type= "Submit" name= "undertime_reg">Submit</button></td></tr>';
			    // echo '';
		    }
		}
	}


?> 
</table>
<p><a href="../index.php">Home</a></p>


</form>

</div>

</div>

	

  
</form>
<!-- <p><a href="../index.php">Home</a></p> -->
</body>
</html>