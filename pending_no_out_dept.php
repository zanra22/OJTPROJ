<?php include('../server.php'); 


?>
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
<form class="content" action="pending_late_time_in.php" method="post">
	 <div class="formtable">
	<table class="table table-bordered table-striped" align="center">
		<tr>
			<!-- <th>HR</th> -->
			<th>Employee Number</th>
			<th>Full Name</th>
			<th>Request Type</th>
			<th>Reason</th>
			<th>Statsus</th>
				<!-- <?php echo $_SESSION['type']; ?></th> -->
		</tr>
		<?php 
		if($_SESSION['type'] == 'HR'){
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if ($conn-> connect_error) {
				die("Connection Failed:".$conn->connect_error);
			}

			$sql = "SELECT employeeNum,fullname,id, request_type, reason, dept_approved FROM form WHERE dept_approved='APPROVED' AND request_type='NO OUT'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

			// $id = $_POST['id'];
   			$fname = $_POST['fullname'];
   $mname = $_POST['request_type'];
   $lname = $_POST['reason'];
   $approve = $_POST['is_approved'];

           
      foreach ($_POST["id"] as $id ) {
      	// $id = $_POST['id'];
   			$fname = mysqli_real_escape_string($conn,$_POST["fullname"][$id]);
   $mname = mysqli_real_escape_string($conn,$_POST["request_type"][$id]);
   $lname = mysqli_real_escape_string($conn,$_POST["reason"][$id]);
   $approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);


   $query = "UPDATE `form` SET `fullname`='".$fname."',`reason`='".$lname."',`is_approved`='".$approve."', `request_type`='".$mname."' WHERE `id` = $id LIMIT 1";
   
   
   $result = mysqli_query($conn, $query);

   $mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'arnazdj@gmail.com';                 // SMTP username
    $mail->Password = 'asaness22';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    // $name = $_POST['name'];
    //Recipients
    $mail->setFrom('arnazdj@gmail.com', 'No Time Out Form Update');
    $mail->addAddress($email, 'Joe User');     // 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Department No Time Out Form Update';
    $mail->Body    = 'Sample1.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
      }
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

					echo '</td><td>'.$row["employeeNum"].'';

						echo '</td><td><input name = fullname['.$row["id"].'] type = text readonly = readonly value ="'.$row["fullname"].'"></input>';

						echo '</td><td><input name = request_type['.$row["id"].'] type = text readonly = readonly value="'. $row["request_type"].'"></input>';

						echo	'</td><td><input name = reason['.$row["id"].'] type = text readonly=readonly value = "'. $row["reason"].'"></input>';

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

			$sql = "SELECT * FROM form WHERE dept_approved='PENDING' AND request_type='NO OUT' AND department = '$test'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

			// $id = $_POST['id'];
   			$fname = $_POST['fullname'];
   $mname = $_POST['request_type'];
   $lname = $_POST['reason'];
   $email = $_POST['email'];
   $approve = $_POST['dept_approved'];

           
      foreach ($_POST["id"] as $id ) {
      	// $id = $_POST['id'];
   			$fname = mysqli_real_escape_string($conn,$_POST["fullname"][$id]);
   $mname = mysqli_real_escape_string($conn,$_POST["request_type"][$id]);
   $lname = mysqli_real_escape_string($conn,$_POST["reason"][$id]);
   $approve = mysqli_real_escape_string($conn,$_POST["dept_approved"][$id]);
   $email = mysqli_real_escape_string($conn,$_POST["email"][$id]);

   $query = "UPDATE `form` SET `fullname`='".$fname."',`reason`='".$lname."',`dept_approved`='".$approve."', `request_type`='".$mname."' WHERE `id` = $id LIMIT 1";
   
   
   $result = mysqli_query($conn, $query);
      }
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

					echo '</td><td>'.$row["employeeNum"].'';

						echo '</td><td><input name = fullname['.$row["id"].'] type = text readonly = readonly value ="'.$row["fullname"].'"></input>';

						echo '</td><td><input hidden name = email['.$row["id"].'] type = text readonly = readonly value ="'.$row["email"].'"></input>';

						echo '</td><td><input name = request_type['.$row["id"].'] type = text readonly = readonly value="'. $row["request_type"].'"></input>';

						echo	'</td><td><input name = reason['.$row["id"].'] type = text readonly=readonly value = "'. $row["reason"].'"></input>';

						echo '</td><td><select  name = dept_approved['.$row["id"].']><option value = PENDING>PENDING</option><option value = APPROVED>APPROVED</option><option value = REJECT>REJECT</OPTION></select></td></tr>';
						// echo $_SESSION['department'];
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
	 <<p><a class="loginButton" onclick="goBack()">Back</a></p>
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
