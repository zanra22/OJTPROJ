<?php include('server.php');
      


 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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
</head>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  function getPosition(val){
    $.ajax({
      type:"POST",
      url: "get_state.php",
      data: 'department='+val,
      success: function(data){
        $("#position-list").html(data);
      }
    });
  }

</script>
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
  <div class="headerName">
    <h2>Register</h2>  
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>

    <div class="input-group col-md-12">
      <strong><label>Employee Number</label></strong>
      <input style="text-transform: uppercase;" type="text" name="employee_N">
    </div>

  	<div class="input-group col-md-12">
  	  <strong><label>First Name</label></strong>
  	  <input style="text-transform: uppercase;" type="text" name="firstname" value="<?php echo $firstname; ?>">
  	</div>

    <div class="input-group col-md-12">
      <strong><label>Middle Name</label></strong>
      <input style="text-transform: uppercase;" type="text" name="middlename" value="<?php echo $middlename; ?>">
    </div>

    <div class="input-group col-md-12">
      <strong><label>Last Name</label></strong>
      <input style="text-transform: uppercase;" type="text" name="lastname" value="<?php echo $lastname; ?>">
    </div>

    <div class="input-group col-md-12">
      <strong><label>Department</label></strong>
      <select  id="department-list" name="department" onChange="getPosition(this.value);">
    <option value="department"></option>
    
       <?php 
        $sql = "SELECT * FROM dept";
         $result = $db->query($sql);
         while ($rs=$result->fetch_assoc()) {
        ?>
        <option value="<?php echo $rs["department"]; ?>"><?php
        echo $rs["department"] ?></option>
       <?php
          }
        ?>

       </select>
    </div>

    <div class="input-group col-md-12">
        <strong><label>Position</label></strong>
        <select id="position-list" name="position">
        <option value="<?php echo $rs["position"]; ?>"><?php
        echo $rs["position"] ?></option>
        </select>
    </div>

  	<div class="input-group col-md-12">
  	  <strong><label>Email</label></strong>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>

  	<div class="input-group col-md-12">
  	  <strong><label>Password</label></strong>
  	  <input type="password" name="password_1">
  	</div>

  	<div class="input-group col-md-12">
      <strong><label>Confirm password</label></strong>
  	  <input type="password" name="password_2">
  	</div>
    <br>
    
  	<div class="input-group col-md-12">
  	  <button type="submit" class="btn btn-outline-warning btn-lg" name="reg_user">Register</button>
  	</div>

  	<p>
  		Already a member?<a class="loginReg" href="login.php">Sign in</a>
  	</p>

  </form>
</body>
</html>