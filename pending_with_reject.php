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
<body style="background-color:#fffacd;">
<div class="half">
    <div class="container">
        <div class="row">
            <div class = "one col-md-12">
                <img src="../img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<form class="content" action="pending_with_reject.php" method="post">
 <!--     <div  class="table-responsive-sm"> -->
 <div class="formtable">
	<table class="table table-bordered" align="center">
    
		<tr>
			<!-- <th>I.D</th> -->
			<th style="border: 1px solid #bb9121; color: #bb9121;">Employee Number</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Email</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">First Name</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Middle Name</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Last Name</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Department</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Position</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Status</th>
		</tr>
		<?php 
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

			$sql = "SELECT employeeNum,id, firstname, middlename, lastname, department, position, is_approved, email FROM user WHERE is_approved='PENDING'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

  $email = $_POST['email'];
           foreach ($_POST["id"] as $id) {
            // $id = $_POST['id'];
 
   $approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);
   $email = mysqli_real_escape_string($conn,$_POST["email"][$id]);
   $query = "UPDATE `user` SET `is_approved`='".$approve."' WHERE `id` = $id";
   
   
   $result = mysqli_query($conn, $query);

   if($approve == 'APPROVED'){
    $mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    // $name = $_POST['name'];
    //Recipients
    $mail->setFrom('localhost.roycehotel@gmail.com', 'Register Form Update');
    $mail->addAddress($email);     // 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Register Form Update';
    $mail->Body    = 'Register Approved.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
           }
   // mysql query to Update data
   

   
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   }
   

   $sql = "DELETE  FROM user WHERE is_approved = 'REJECT'";
   if($approve == 'REJECT'){
    $mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    // $name = $_POST['name'];
    //Recipients
    $mail->setFrom('localhost.roycehotel@gmail.com', 'Register Update');
    $mail->addAddress($email);     // 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Register Update';
    $mail->Body    = 'Register Rejected.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
  if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
   }
   
   mysqli_close($conn);
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					echo "<tr?";
					echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';
					
					echo '<td  style="border: 1px solid #bb9121; color: #bb9121;">'.$row["employeeNum"].'</td>';
					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'.$row["email"].'</td>';
					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'.$row["firstname"].'</td>';
					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'. $row["middlename"].'</td>';

					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'. $row["lastname"].'</td>'; 
					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'.$row["department"].'</td>';

					echo '<td style="border: 1px solid #bb9121; color: #bb9121;">'.$row["position"].'</td>';

					echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><select style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" id = "is_approved['.$row["id"].']"   name = "is_approved['.$row["id"].']"><option value = "PENDING">PENDING</option>
          <option value = "APPROVED">APPROVED</option>
          <option value = "REJECT">REJECT</OPTION>
          </select></td>';
					echo "</tr>";
				}
				echo "</table>";
			}
			else{
				echo "0 result";
			}

			
		?>

	</table>

 </div>
 <input type="submit" style="background-color: #fffacd;" class="btn btn-default" name="update" value="Update Data">
   <p><a class="loginButton" href="../index.php">Home</a></p>
</div>
	
</form>
</div>
</div>
<div>
	<form>
		<hr>
	</form>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>