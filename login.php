<?php include('server.php');
      // include('mail.php');

 ?>


<!DOCTYPE html>
<html>
<head>
  <title>Royce Hotel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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
</head>

<body col-md-12>
  <div class="form">
      
      <ul class="tab-group col-s-6">
        <li class="tab active"><a href="#signup">Register</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <p class="item-1">Hi, Welcome!</p>
          <p class="item-2">Hi, Welcome!</p>
          <p class="item-3">Hi, Welcome!</p>
          <br><br><br><br>
          
          <form class="col-s-6" action="login.php" method="post">
          <?php include('errors.php'); ?>
          <div class="top-row">
            <div class="field-wrap">
              <label class="font-weight-bold">
              Email Address<span class="req">*</span>
            </label>
            <input name="email" value="<?php echo $email; ?>" type="email" autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <label class="font-weight-bold">
                First Name<span class="req">*</span>
              </label>
                <input name="firstname" value="<?php echo $firstname; ?>" type="text"  autocomplete="off"/>
          </div>

          </div>

          <div class="top-row">
            
          
            <div class="field-wrap">
              <label class="font-weight-bold">
                Middle Name<span class="req">*</span>
              </label>
              <input name="middlename" value="<?php echo $middlename; ?>" type="text"  autocomplete="off"/>
            </div>
            <div class="field-wrap">
              <label class="font-weight-bold">
                Last Name<span class="req">*</span>
              </label>
                <input name="lastname" value="<?php echo $lastname; ?>" type="text"  autocomplete="off"/>
          </div>
          </div>
          <div class="top-row">
            
          
            <div class="field-wrap">
              <label class="font-weight-bold">
                Department<span class="req">*</span>
              </label>
              <select autocomplete="off"  id="department-list" name="department" onChange="getPosition(this.value);">
              <option autocomplete="off" style="text-align: center;" value="department"></option>
    
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

            <div class="field-wrap">
              <label class="font-weight-bold">
                Position<span class="req">*</span>
              </label>
                <select id="position-list" name="position">
                <option value="<?php echo $rs["position"]; ?>"><?php
                echo $rs["position"] ?></option>
              </select>
              </div>
          </div>


          <div class="top-row">
            
          
            <div class="field-wrap">
              <label class="font-weight-bold">
                Password<span class="req">*</span>
              </label>
              <input name="password_1" type="password" autocomplete="off"/>
            </div>
            <div class="field-wrap">
              <label class="font-weight-bold">
                Re-type Password<span class="req">*</span>
              </label>
              <input name="password_2" type="password" autocomplete="off"/>
            </div>
          </div>
            <div class="field-wrap">
              <label class="font-weight-bold">
                Employee Number<span class="req">*</span>
              </label>
              <input name="employee_N" type="text" autocomplete="off"/>
            </div>
          <button type="submit" name="reg_user" class="button button-block"/>Submit</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="login.php" method="post">
          
           <div class="field-wrap">
            <label class="font-weight-bold">
              Employee Number<span class="req">*</span>
            </label>
            <input name="employee_N" type="text" autocomplete="off"/>
           </div>
          
          <div class="field-wrap">
            <label class="font-weight-bold">
              Password<span class="req">*</span>
            </label>
            <input name="password" type="password" autocomplete="off"/>
          </div>
          
          <!-- <p class="forgot"><a href="#">Forgot Password?</a></p> -->
          
          <button name="login_user" class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>

</body>
</html>
