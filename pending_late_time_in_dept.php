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
	<style>
table, td {
    border: 1px solid black;
}

.th{
  margin-left: 100px;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
  $(document).ready(function(){
    $('#purpose').on('change', function() {
      
      if ( this.value == "REJECT")
      {
        
        $("#business1").show();
        $("#business2").show();
      }
      else{
        $("#business1").hide();
        $("#business2").hide();
      }

    });
});

</script>
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
<form class="content" action="pending_late_time_in_dept.php" method="post">
   <div class="formtable">
	<table class="table table-bordered" align="center">
		<tr>
			<!-- <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">HR</th> -->
			<th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Employee Number</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Full Name</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Date Filed</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Date</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Employee Sched</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Late Time-In</th>
			<!-- <th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Request Type</th> -->
			<th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Reason</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">Status</th>
      <th id="business1" style="display: none;">Reason Why</th>
				<!-- <?php echo $_SESSION['type']; ?></th> -->
		</tr>
		<?php 
		if($_SESSION['type'] == 'HR'){
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if ($conn-> connect_error) {
				die("Connection Failed:".$conn->connect_error);
			}

        $sql = "SELECT * FROM form WHERE request_type='LATE TIME-IN' AND dept_approved = 'APPROVED' AND is_approved = 'PENDING'";			
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{
 $email = $_POST['email'];
   $reasonHr = $_POST['reasonHr'];
   $approve = $_POST['is_approved'];
   $hrDateUpdate =$_POST['hrDateUpdate'];
      foreach ($_POST["id"] as $id ) {
        $approve = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);
        $reasonHr = mysqli_real_escape_string($conn,strtoupper($_POST["reasonHr"][$id]));
        $email = mysqli_real_escape_string($conn,$_POST["email"][$id]);
        $hrDateUpdate = mysqli_real_escape_string($conn, strtoupper($_POST['hrDateUpdate']));


        $query = "UPDATE `form` SET `is_approved`='".$approve."',`reasonHr`='".$reasonHr."',`hrDateUpdate`='".$hrDateUpdate."'  WHERE `id` = $id LIMIT 1";

   
   
   $result = mysqli_query($conn, $query);


   if($approve == 'APPROVED'){
                    $mail = new PHPMailer\PHPMailer\PHPMailer();  
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
                    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port 
                    $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Form Approved');
                    $mail->addAddress($email);     // 

    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Late Time In Form Update HR';
                    $mail->Body    = 'Form Accepted.';

                    $mail->send();
            }

            if($approve == 'REJECT'){
                    $mail = new PHPMailer\PHPMailer\PHPMailer();  
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
                    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port 
                    $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Form Rejected');
                    $mail->addAddress($email);     // 

    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Late Time In Form Update HR';
                    $mail->Body    = "Form Rejected <br> Reason: ".$reasonHr.".";

                    $mail->send();
            }
      }
}

      
       if ($result1-> num_rows > 0) {
        while ($row = $result1-> fetch_assoc()){
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';
          echo '<input type = hidden  name = email['.$row["id"].'] type = text readonly = readonly value ="'.$row["email"].'"></input>';

          echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.$row["employeeNum"].'';

          echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.$row["fullname"].'';

         echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.date("M d, Y , l",strtotime($row["dateFiled"])).'';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.date("M d, Y , l",strtotime($row["planDate"])).'';

echo  '<td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">From: <br>'.date("g:i a", strtotime($row["startOfShift"])).'<br>To: <br>'. date("g:i a", strtotime($row["endOfShift"])).'</td>';
            

echo '<input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" hidden required name="hrDateUpdate" type="date" value='.date("Y-m-d").'></input>';
            echo  '<td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>
            '. date("g:i a", strtotime($row["lateTimeIn"])).'</td>';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><textarea style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" name = reason['.$row["id"].'] type = text readonly = readonly >'. $row["reason"].'</textarea>';

              echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>
            <select style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" class="purpose" id="purpose"  name = is_approved['.$row["id"].']><option value = "PENDING">PENDING</option><option value = "APPROVED">APPROVED</option><option value = "REJECT">REJECT</OPTION></select></td>';

            echo  '</td><td id="business2" style="display:none;"><textarea  style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" placeholder="Optional..." name = reasonHr['.$row["id"].'] type = text></textarea></td></tr>';

            
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

			$sql = "SELECT * FROM form WHERE dept_approved='PENDING' AND request_type='LATE TIME-IN' AND department = '$test'";
			$result1 = $conn-> query($sql);
 
if(isset($_POST['update']))
{

       $email = $_POST['email'];
      $reasonDept = $_POST['reasonDept'];
      $approve = $_POST['deptApproved'];
      $deptDateUpdate =$_POST['deptDateUpdate'];

           
      foreach ($_POST["id"] as $id ) {
        $approve = mysqli_real_escape_string($conn,$_POST["deptApproved"][$id]);
        $reasonDept = mysqli_real_escape_string($conn,strtoupper($_POST["reasonDept"][$id]));
        $email = mysqli_real_escape_string($conn,$_POST["email"][$id]);
        $deptDateUpdate = mysqli_real_escape_string($conn, strtoupper($_POST['deptDateUpdate']));


$query = "UPDATE `form` SET `is_approved`='".$approve."',`reasonDept`='".$reasonDept."',`deptDateUpdate`='".$deptDateUpdate."'  WHERE `id` = $id LIMIT 1";  


   
   
   $result = mysqli_query($conn, $query);
   $mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions

    //Server settings
       if($approve == 'APPROVED'){
                    $mail = new PHPMailer\PHPMailer\PHPMailer();  
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
                    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port 
                    $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Form Approved');
                    $mail->addAddress($email);     // 

    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Late Time In Form Update Department Head';
                    $mail->Body    = 'Form Accepted.';

                    $mail->send();
            }

            if($approve == 'REJECT'){
                    $mail = new PHPMailer\PHPMailer\PHPMailer();  
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
                    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port 
                    $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Form Rejected');
                    $mail->addAddress($email);     // 

    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Late Time In Form Update Departmend Head';
                    $mail->Body    = "Form Rejected <br> Reason: ".$reasonDept.".";

                    $mail->send();
            }

      }
}

			if ($result1-> num_rows > 0) {
				while ($row = $result1-> fetch_assoc()){
					         echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';
          echo '<input type = hidden  name = email['.$row["id"].'] type = text readonly = readonly value ="'.$row["email"].'"></input>';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.$row["employeeNum"].'';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.$row["fullname"].'';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.date("M d, Y , l",strtotime($row["dateFiled"])).'';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>'.date("M d, Y , l",strtotime($row["planDate"])).'';

            echo  '<td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;">From: <br>'.date("g:i a", strtotime($row["startOfShift"])).'<br>To: <br>'. date("g:i a", strtotime($row["endOfShift"])).'</td>';

            

            
echo '<input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" hidden required name="hrDateUpdate" type="date" value='.date("Y-m-d").'></input>';
            
            echo  '<td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>
            '. date("g:i a", strtotime($row["lateTimeIn"])).'</td>';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><textarea style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" name = reason['.$row["id"].'] type = text readonly = readonly >'. $row["reason"].'</textarea>';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"><br>
            <select style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" class="purpose" id="purpose"  name = dept_approved['.$row["id"].']><option value = "PENDING">PENDING</option><option value = "APPROVED">APPROVED</option><option value = "REJECT">REJECT</OPTION></select></td>';

            echo  '</td><td id="business2" style="display:none;"><br><textarea style="background-color:#fffacd;border: 1px solid #bb9121; color: #bb9121;" style="height: 30px;width:150px;" placeholder="Optional..." name = reasonDept['.$row["id"].'] type = text></textarea></td></tr>';

            
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
	 <input type="submit" style="background-color:#fffacd;" class="btn btn-default" name="update" value="Update Data">
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
