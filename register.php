<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <div col-md-12>
      
    </div>
  </div>
  <div class="headerName">
    <h2>Register</h2>  
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
    <div class="input-group">
      <label>Employee Number</label>
      <input style="text-transform: uppercase;" type="text" name="employee_N">
    </div>

  	<div class="input-group">
  	  <label>First Name</label>
  	  <input style="text-transform: uppercase;" type="text" name="firstname" value="<?php echo $firstname; ?>">
  	</div>

    <div class="input-group">
      <label>Middle Name</label>
      <input style="text-transform: uppercase;" type="text" name="middlename" value="<?php echo $middlename; ?>">
    </div>

    <div class="input-group">
      <label>Last Name</label>
      <input style="text-transform: uppercase;" type="text" name="lastname" value="<?php echo $lastname; ?>">
    </div>

    <div class="input-group">
      <label>Department</label>
      <input style="text-transform: uppercase;" type="text" name="department">
    </div>

    <div class="input-group">
      <label>Position</label>
      <input style="text-transform: uppercase;" type="text" name="position">
    </div>

  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
      <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
    
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>