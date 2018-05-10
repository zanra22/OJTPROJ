<?php include('../server.php');

function differenceInHours($leaveStart,$leaveEnd){
  $starttimestamp = strtotime($leaveStart);
  $endtimestamp = strtotime($leaveEnd);
  $difference = abs( $starttimestamp- $endtimestamp)/86400;
  return $difference;
}
if(!empty($_POST["submit"])) {
  $hours_difference = differenceInHours($_POST["leaveStart"],$_POST["leaveEnd"]); 
  // echo "The Difference is " . $hours_difference . " hours";
}

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
	<title></title>

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
      
      if ( this.value == "Other")
      {
        
        $("#businessLeave").show();
        $("#business2").show();
      }
      else{
        $("#businessLeave").hide();
        $("#business2").hide();
      }

    });
});

</script>

</head>
<body style="background-color: #fffacd;">
<div class="half">
    <div class="container">
        <div class="row">
            <div class = "one col-md-12">
                <img style="width: 70%; height: 200px;margin-left: auto;margin-right: auto;display: block;margin-top: 20px;" src="../img/logo.png">
                <hr>
            </div>
        </div> 
    </div>
<form id="formID" action="leave_final.php" method="post">
	<?php include('../errors.php'); ?>
	<table class="table table-bordered" align="center">
		<!-- <?php  ?> -->
		<tr style="border: 1px solid #bb9121;">
			
			<!-- <th>Employee Number</th> -->
      <!-- <th>Name</th> -->
      <!-- <th>Request Type</th> -->
      <th style="border: 1px solid #bb9121; color: #bb9121;">Date Filed</th>
      <th style="text-align: center; border: 1px solid #bb9121; color: #bb9121;">Regular Shit</th>
			<th style=" border: 1px solid #bb9121; color: #bb9121;">Date of Leave</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;"></th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">No. of Days</th>
			
			<th style="border: 1px solid #bb9121; color: #bb9121;">Type of Leave</th>

      <th id="businessLeave" style="border: 1px solid #bb9121; color: #bb9121; display:none;">Please Specify</th>
			
			<th  style="border: 1px solid #bb9121; color: #bb9121;">Type</th>
      <th style="border: 1px solid #bb9121; color: #bb9121;">Employee`s Reason</th>
			<!-- <th></th> -->
      

		</tr>
		<?php 
			$conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
			if (isset($_SESSION['employee_N'])):
      				$employee_Number = $_SESSION['employee_N'];
					$sql = "SELECT * FROM user WHERE employeeNum = '$employee_Number'";
					$result = $conn->query($sql);

				if ($result->num_rows > 0):
		    		// output data of each row
					while($row = $result->fetch_assoc()) {
			    		echo '<input hidden style="text-align:center;"" type = "text"  readonly name = "employeeNumber" value="'.$row["employeeNum"].'"></input>';
			    		echo '<input hidden style="text-align:center;"" type = "text"  readonly name = "email" value="'.$row["email"].'"></input>';		
              echo '<input hidden style="text-align:center;"" type = "text"  readonly name = "department" value="'.$row["department"].'"></input>';
              echo '<input hidden style="text-align:center;"" type = "text" readonly name = "full_name" value = "'.$row["lastname"].", ".$row["firstname"]." ".$row["middlename"].'"></input>';
              echo '<input hidden style="text-align:center;"" type = "text"  readonly name = "position" value="'.$row["position"].'"></input>';


                }
			    		endif;
			    		endif;
			    		?>
              <input hidden style="text-align:center;" type = "text" readonly name = "request_type" value = "UNDERTIME"></input>

              <?php

              echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><br><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" readonly required name="dateFiled" type="date" value='.date("Y-m-d").'></input></td>';

			    		
			    		?>

              <td style="border: 1px solid #bb9121; color: #bb9121;"><strong>FROM<br> </strong><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="startOfShift"   type="time" placeholder="Start of Regular Shift" value="<?php if(!empty($_POST["startOfShift"])) { echo $_POST["startOfShift"]; } ?>"><br>
              <strong>TO<br> </strong> <input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="endOfShift"  type="time" placeholder="End of Regular Shift" value="<?php if(!empty($_POST["endOfShift"])) { echo $_POST["endOfShift"]; } ?>"></td>

              <input hidden style="text-align:center;" type = "text" readonly name = "request_type" value = "LEAVE APPLICATION"></input>


              <td style="border: 1px solid #bb9121; color: #bb9121;"><strong>FROM </strong><br><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;;" required name="leaveStart" type="date" value="<?php if(!empty($_POST["leaveStart"])) { echo $_POST["leaveStart"]; } ?>" ></input>
                <br><strong>TO </strong><br>
                <input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="leaveEnd" type="date" value="<?php if(!empty($_POST["leaveEnd"])) { echo $_POST["leaveEnd"]; } ?>"></input>
              </td>

              <td style="border: 1px solid #bb9121; color: #bb9121;"><br><button  type="submit" name="submit" value="Find Difference" class="btnAction">=</button></td>

			    		<td style="border: 1px solid #bb9121; color: #bb9121;"><br><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required=required readonly id="display" name="result" type="number" value="<?php echo isset($hours_difference)?$hours_difference:""?>"></td>
			    
      					
      					
      					
      					<td style="border: 1px solid #bb9121; color: #bb9121;"><br><select id="purpose" name="leaveType" style="border: 1px solid #bb9121;background-color: #fffacd; color: #bb9121;">
              <option value="Vacation">Vacation</option>
              <option value="Maternity">Maternity</option>
              <option value="Paternity">Paternity</option>
              <option value="Sick">Sick</option>
              <option value="ADO">ADO</option>
              <option value="Other">Other</option>
            </select></td>

            <td id="business2" style="border: 1px solid #bb9121; color: #bb9121;display: none;"><br><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" style = "width:400px" type = "text" name = "otherSpecify"></input></td>

      					<td style="border: 1px solid #bb9121; color: #bb9121;"><br><select name="leavePay" style="border: 1px solid #bb9121;background-color: #fffacd; color: #bb9121;">
              <option value="With Pay">With Pay</option>
              <option value="Without Pay">Without Pay</option>
            </select></td>

            <td style="border: 1px solid #bb9121; color: #bb9121;"><br><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" style = "width:400px" type = "text" name = "reason_1"></input></td>
      					</tr>
      					
      				</table>
<button class="btn btn-outline-warning btn-lg" align="center" type="submit" name="leave_submit" value="Submit">Submit</button>

<p><a href="../index.php">Home</a></p>
</form>
</div>
</div> 
</form>
</body>

</html>