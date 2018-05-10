<?php include('../server.php');
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
      
      if ( this.value == 'BOTH')
      {
        
        $("#business1").show()
        $("#business2").show()
        $("#business3").show()
        $("#business4").show()
      }
      if ( this.value == 'NO IN')
      {
        $("#business1").show()
        $("#business2").show()
        $("#business3").hide()
        $("#business4").hide()
      }
      if ( this.value == 'NO OUT')
      {
      	$("#business1").hide()
        $("#business2").hide()
        $("#business3").show();
        $("#business4").show();
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
<form id="formID" action="official_business.php" method="post">
	<?php include('../errors.php'); ?>
	<table class="table table-bordered" align="center">
		<!-- <?php  ?> -->
		<tr style="border: 1px solid #bb9121;">
			
			<!-- <th>Employee Number</th> -->
      <!-- <th>Name</th> -->
      <!-- <th>Request Type</th> -->
      		
			<th style=" border: 1px solid #bb9121; color: #bb9121;">Date Filed</th>
			<th style="border: 1px solid #bb9121; color: #bb9121;">Date</th><th style="border: 1px solid #bb9121; color: #bb9121;">Situation</th>
			<th colspan="2" style="text-align: center; border: 1px solid #bb9121; color: #bb9121;">Regular Shit</th>
			<th id='business1'  style="border: 1px solid #bb9121; color: #bb9121;"><div id='business1'></div>Time of In</th>
			<th id='business3'  style="border: 1px solid #bb9121; color: #bb9121;"><div  id='business3'></div>Time of Out</th>
			<!-- <th style="border: 1px solid #bb9121; color: #bb9121;"></th> -->
			<!-- <th style="border: 1px solid #bb9121; color: #bb9121;">Total Minutes</th> -->
			<!-- <th></th> -->
      <th style="border: 1px solid #bb9121; color: #bb9121;">Reason</th>

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
              <input hidden style="text-align:center;" type = "text" readonly name = "request_type" value = "OFFICIAL BUSINESS"></input>

              <?php

			    		echo '<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="dateFiled" type="date" value='.date("Y-m-d").'></input></td>';
			    		?>
			    		<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="planDate" type="date" value="<?php if(!empty($_POST["planDate"])) { echo $_POST["planDate"]; } ?>"></input></td>

			    		<td style="border: 1px solid #bb9121; color: #bb9121; "><select id="purpose" name="situation" style="background-color: #fffacd; border-color: #bb9121;color: #bb9121;">
                <option value = "BOTH">Both</option>
                <option value = "NO IN">No In</option>
                <option value = "NO OUT">No Out</OPTION>
                </select></td>
			    
      					<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" required name="startOfShift" value="<?php if(!empty($_POST["startOfShift"])) { echo $_POST["startOfShift"]; } ?>"  type="time" placeholder="Start of Regular Shift"></td>
      					
      					<td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;" name="endOfShift" value="<?php if(!empty($_POST["endOfShift"])) { echo $_POST["endOfShift"]; } ?>" required=required type="time" placeholder="End of Regular Shift"></td>
      					
      					<td id='business2' style="border: 1px solid #bb9121; color: #bb9121;">
      						<div id='business2'> 
      						</div><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"  name="no_in" type="time" placeholder="Start of Overtime" />
						</td>

      					<td id="business4" style="border: 1px solid #bb9121; color: #bb9121;"><div  id='business4'> 
      						</div><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd;"  name="no_out"  type="time" placeholder="Start of Overtime"></td>

      					
  
                <td style="border: 1px solid #bb9121; color: #bb9121;"><input style="text-align:center;border: 1px solid #bb9121; color: #bb9121;background-color:#fffacd; width: 200px;" style = "width:400px" type = "text" name = "reason_1"></input></td>
      					</tr>
      					
      				</table>
<button class="btn btn-outline-warning btn-lg" align="center" type="submit" name="official_business_reg" value="Submit">Submit</button>

<p><a href="../index.php">Home</a></p>
</form>
</div>
</div> 
</form>
</body>

</html>