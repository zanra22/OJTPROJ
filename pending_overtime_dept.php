<?php include('../server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../ojtCss/homepage.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<style>
table, td {
    border: 1px solid black;
}

.th{
  margin-left: 100px;
}
</style>
	<title></title>
</head>
<body>
<div class="half">
    <div class="container">
        <div class="row">
            <div class = "one col-md-12">
                <img src="../img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<form class="content" action="pending_overtime.php" method="post">
 <div class="formtable"> 
	<table class="table table-bordered table-striped" align="center">
		<tr>
			<!-- <th>I.D</th> -->
			<th>Employee Number</th>
			<th>Request Type</th>
			<th>Date Filed</th>
			<th colspan="2">Regular Shift</th>
			<th>Overtime</th>
			<th>Total Hours</th>
			<th>Status</th>
		</tr>
		<?php 

		if($_SESSION['type'] == 'HR') {
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if ($conn-> connect_error) {
				die("Connection Failed:".$conn->connect_error);
			}
			$employee_Number = $_SESSION['employee_N'];
      			$user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
      				$price = mysqli_query($db,$user);
      				$result = mysqli_fetch_assoc($price);

      				$_SESSION['department'] = $result['department'];
      				$test = $_SESSION['department'];

			$sql = "SELECT employeeNum,request_type,id, name, shift1, is_approved, startdate, enddate, result FROM  form WHERE dept_approved='APPROVED' AND request_type='OVERTIME' AND is_approved = 'PENDING'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

			// $id = $_POST['id'];

   			// $fname = $_POST['fullname'];
   			// $mname = $_POST['request_type'];
   			// $lname = $_POST['reason'];
   			$approve = $_POST['is_approved'];

           
      foreach ($_POST["id"] as $id ) {
      	// $id = $_POST['id'];
   			// $fname = mysqli_real_escape_string($conn,$_POST["fullname"][$id]);
   			// $rtype = mysqli_real_escape_string($conn,$_POST["request_type"][$id]);
   			// $reason = mysqli_real_escape_string($conn,$_POST["reason"][$id]);
   			$approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);


   			$query = "UPDATE `form` SET `is_approved`='".$approve."' WHERE `id` = $id LIMIT 1";
   
   
   			$result = mysqli_query($conn, $query);
      			}
   // mysql query to Update data
   


 //   $sql = "DELETE  FROM form WHERE is_approved = 'REJECT'";

	// if ($conn->query($sql) === TRUE) {
	//     echo "Record deleted successfully";
	// } else {
	//     echo "Error deleting record: " . $conn->error;
	// }
 //   if($result)
 //   {
 //       echo 'Data Updated';
 //   }else{
 //       echo 'Data Not Updated';
 //   }
 //   mysqli_close($conn);
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

					echo '</td><td>'.$row["employeeNum"].'';

						echo '</td><td><input name = request_type['.$row["id"].'] type = text readonly = readonly value ="'.$row["request_type"].'"></input>';

						echo '</td><td><input name = name['.$row["id"].'] type = text readonly = readonly value="'. $row["name"].'"></input></td>';
						// echo date("g:i a", strtotime("$row[startdate]"));
						echo	'<td><input name = shift1['.$row["id"].'] type = text readonly=readonly value = "'.date("g:i a", strtotime($row["shift1"])).'"></input></td>';

						echo	'<td><input name = shift2['.$row["id"].'] type = text readonly=readonly value = "'. date("g:i a", strtotime($row["startdate"])).'"></input></td>';

						echo	'<td><input name = overtime1['.$row["id"].'] type = text readonly=readonly value = "'. date("g:i a", strtotime($row["enddate"])).'"></input></td>';

						echo	'<td><input name = reason['.$row["id"].'] type = text readonly=readonly value = "'. $row["result"].'"></input></td>';

						echo '</td><td><select  name = is_approved['.$row["id"].']><option value = PENDING>PENDING</option><option value = APPROVED>APPROVED</option><option value = REJECT>REJECT</OPTION></select></td></tr>';
				}
				echo "</table>";
			}
			else{
				echo "0 result";
			}
		}

		if($_SESSION['type'] == 'deptHead'){
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if ($conn-> connect_error) {
				die("Connection Failed:".$conn->connect_error);
			}
			$employee_Number = $_SESSION['employee_N'];
      			$user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
      				$price = mysqli_query($db,$user);
      				$result = mysqli_fetch_assoc($price);

      				$_SESSION['department'] = $result['department'];
      				$test = $_SESSION['department'];

			$sql = "SELECT employeeNum,request_type,id, name, shift1, is_approved, startdate, enddate, result FROM  form WHERE is_approved='PENDING' AND request_type='OVERTIME' AND department ='$test'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

			// $id = $_POST['id'];

   			// $fname = $_POST['fullname'];
   			// $mname = $_POST['request_type'];
   			// $lname = $_POST['reason'];
   			$approve = $_POST['is_approved'];

           
      foreach ($_POST["id"] as $id ) {
      	// $id = $_POST['id'];
   			// $fname = mysqli_real_escape_string($conn,$_POST["fullname"][$id]);
   			// $rtype = mysqli_real_escape_string($conn,$_POST["request_type"][$id]);
   			// $reason = mysqli_real_escape_string($conn,$_POST["reason"][$id]);
   			$approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);


   			$query = "UPDATE `form` SET `is_approved`='".$approve."' WHERE `id` = $id LIMIT 1";
   
   
   			$result = mysqli_query($conn, $query);
      			}
   // mysql query to Update data
   


 //   $sql = "DELETE  FROM form WHERE is_approved = 'REJECT'";

	// if ($conn->query($sql) === TRUE) {
	//     echo "Record deleted successfully";
	// } else {
	//     echo "Error deleting record: " . $conn->error;
	// }
 //   if($result)
 //   {
 //       echo 'Data Updated';
 //   }else{
 //       echo 'Data Not Updated';
 //   }
 //   mysqli_close($conn);
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

					echo '</td><td>'.$row["employeeNum"].'';

						echo '</td><td><input name = request_type['.$row["id"].'] type = text readonly = readonly value ="'.$row["request_type"].'"></input>';

						echo '</td><td><input name = name['.$row["id"].'] type = text readonly = readonly value="'. $row["name"].'"></input></td>';
						// echo date("g:i a", strtotime("$row[startdate]"));
						echo	'<td><input name = shift1['.$row["id"].'] type = text readonly=readonly value = "'.date("g:i a", strtotime($row["shift1"])).'"></input></td>';

						echo	'<td><input name = shift2['.$row["id"].'] type = text readonly=readonly value = "'. date("g:i a", strtotime($row["startdate"])).'"></input></td>';

						echo	'<td><input name = overtime1['.$row["id"].'] type = text readonly=readonly value = "'. date("g:i a", strtotime($row["enddate"])).'"></input></td>';

						echo	'<td><input name = reason['.$row["id"].'] type = text readonly=readonly value = "'. $row["result"].'"></input></td>';

						echo '</td><td><select  name = is_approved['.$row["id"].']><option value = PENDING>PENDING</option><option value = APPROVED>APPROVED</option><option value = REJECT>REJECT</OPTION></select></td></tr>';
				}
				echo "</table>";
			}
			else{
				echo "0 result";
			}

		}

			
		?>

	</table>
</div> 
	 <input type="submit" class="btn btn-default" name="update" value="Update Data">
	 <p><a class="loginButton" onclick="goBack()">Back</a></p>
</form>
</div>
</div>
<div>
	<form>
		<hr>
	</form>
</div>

</body>
<script>
function goBack() {
    window.history.back();
}
</script>
</html>