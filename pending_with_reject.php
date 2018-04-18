
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="homepage.css">
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
                <img src="img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<form class="content" action="pending_with_reject.php" method="post">
	<table align="center">
		<tr>
			<!-- <th>I.D</th> -->
			<th>Employee Number</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Department</th>
			<th>Position</th>
			<th>Status</th>
		</tr>
		<?php 
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if ($conn-> connect_error) {
				die("Connection Failed:".$conn->connect_error);
			}

			$sql = "SELECT employeeNum,id, firstname, middlename, lastname, department, position, is_approved FROM user WHERE is_approved='PENDING'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

			// $id = $_POST['id'];
   // $fname = $_POST['firstname'];
   // $mname = $_POST['middlename'];
   // $lname = $_POST['lastname'];
   // $approve = $_POST['is_approved'];

           foreach ($_POST["id"] as $id) {
           	// $id = $_POST['id'];
 
   $approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);
   $query = "UPDATE `user` SET `is_approved`='".$approve."' WHERE `id` = $id";
   
   
   $result = mysqli_query($conn, $query);
           }
   // mysql query to Update data
   

   $sql = "DELETE  FROM user WHERE is_approved = 'REJECT'";

	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   mysqli_close($conn);
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo '<tr><td><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

					echo ''.$row["employeeNum"].'</td><td style="width: auto;">';

					echo ''.$row["firstname"].'</td><td style="width: auto;">';
					echo ''. $row["middlename"].'</td><td style="width: auto;">';

					echo ''. $row["lastname"].'</td><td>'; 
					echo ''.$row["department"].'</td><td>';

					echo ''.$row["position"].'</td><td>';

					echo '<select  name = is_approved['.$row["id"].']><option value = PENDING>PENDING</option><option value = APPROVED>APPROVED</option><option value = REJECT>REJECT</OPTION></select></td></tr>';
				}
				echo "</table>";
			}
			else{
				echo "0 result";
			}

			
		?>

	</table>
	 <input type="submit" name="update" value="Update Data">
	 <p><a class="loginButton" href="adminindex.php">Back</a></p>
</form>
</div>
</div>
<div>
	<form>
		<hr>
	</form>
</div>

</body>
</html>