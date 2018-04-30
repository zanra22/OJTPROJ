<?php 
  session_start(); 

  if (!isset($_SESSION['employee_N'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['employee_N']);
    header("location: login.php");
  }

// Export
  if(isset($_POST['exp'])){
     header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=form_backup_hr_staff.csv');

    $output = fopen('php://output', 'w');

    fputcsv($output, array('Employee Number', 'Department', 'Full Name', 'E-Mail', 'Date Filed', 'Start of Shift', 'End of Shift/Start of Overtime','End of Overtime','Total Hours(Overtime)','Request Type','Reason','HR Form Status','Department Head Form Status'));
    $con = mysqli_connect('localhost', 'root', 'str0ngpa$$w0rd', 'registration');
    $rows = mysqli_query($con, 'SELECT employeeNum, department, fullname, email, name, shift1, startdate, enddate, result, request_type, reason, is_approved, dept_approved FROM form');

    while ($row = mysqli_fetch_assoc($rows)) {
      fputcsv($output, $row);
    }
    fclose($output);
    mysqli_close($con);
    exit();
  }

  // Notification

      $conn = new mysqli("localhost","root",'str0ngpa$$w0rd',"registration");
      $count=0;
if(!empty($_POST['add'])) {
       $subject = mysqli_real_escape_string($conn,$_POST["subject"]);
        $comment = mysqli_real_escape_string($conn,$_POST["comment"]);
        $sql = "INSERT INTO comments (subject,comment) VALUES('" . $subject . "','" . $comment . "')";
        mysqli_query($conn, $sql);
      }
    $sql2="SELECT * FROM form WHERE status = 0";
        $result=mysqli_query($conn, $sql2);
        $count=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- nofitification -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook Like Header Notification in PHP</title>
  <link rel="stylesheet" href="notification-demo-style.css" type="text/css">
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script type="text/javascript">

  function myFunction() {
    $.ajax({
      url: "view_notification.php",
      type: "POST",
      processData:false,
      success: function(data){
        $("#notification-count").remove();          
        $("#notification-latest").show();$("#notification-latest").html(data);
      },
      error: function(){}           
    });
   }
   
   $(document).ready(function() {
    $('body').click(function(e){
      if ( e.target.id != 'notification-icon'){
        $("#notification-latest").hide();
      }
    });
  });
     
  </script>
</head>
<body style="background-color: black;">
<?php if($_SESSION['type'] == 'Employee') { ?>
<div class="test">
  <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
        aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i  class="fa fa-bars fa-1x" style="color: #bb9121;"></i></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a href="form.php" name="employee_form" class="unified1_test" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM<span class="sr-only">(current)</span></a> 
            </li>
            
            <li class="nav-item">
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    </div>
    <!-- Collapsible content -->


<?php } ?>

<?php if($_SESSION['type'] == 'Staff') { ?>
<div class="test">
  <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
        aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i  class="fa fa-bars fa-1x" style="color: #bb9121;"></i></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a href="form.php" name="employee_form" class="unified1_test" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM<span class="sr-only">(current)</span></a> 
            </li>
            
            <li class="nav-item">
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    </div>
    <!-- Collapsible content -->


<?php } ?>


<?php if($_SESSION['type'] == 'staff') { ?>
<div class="test">
  <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
        aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i  class="fa fa-bars fa-1x" style="color: #bb9121;"></i></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a href="form.php" name="employee_form" class="unified1_test" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM<span class="sr-only">(current)</span></a> 
            </li>
            
            <li class="nav-item">
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    </div>
    <!-- Collapsible content -->


<?php } ?>


<?php if($_SESSION['type'] == 'deptHead') { ?>
<div class="test">
  <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
        aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i style="color: #bb9121;" class="fa fa-bars fa-1x"></i></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a href="form.php" name="employee_form" class="unified1_test" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM<span class="sr-only">(current)</span></a> 
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_undertime_dept.php" name="approval_form" id="penund1">Pending Undertime</a>
            </li>

            <li class="nav-item">
                <a href="ojtPending/pending_overtime_dept.php" name="approval_form" id="penov1">Pending Overtime</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_late_time_in_dept.php" name="approval_form" id="penlate1">Pending Late Time-In</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_official_business_dept.php" name="approval_form" id="penoff1">Pending Official Business</a>
            </li>
            <a href="ojtPending/pending_no_time_in_dept.php" name="approval_form" id="penni1">Pending No In</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_no_out_dept.php" name="approval_form" id="penno1">Pending No Out</a>
            </li>

            <li class="nav-item">
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    </div>
    <!-- Collapsible content -->


<?php } ?>

<?php if($_SESSION['type'] == 'HR') { ?>
<div class="test">
  <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
        aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i style="color: #bb9121;" class="fa fa-bars fa-1x"></i></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a href="form.php" name="employee_form" class="unified1_test" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM<span class="sr-only">(current)</span></a> 
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_with_reject.php" name="approval_form" id="penreg1">Pending Registration</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_undertime_dept.php" name="approval_form" id="penund1">Pending Undertime</a>
            </li>

            <li class="nav-item">
                <a href="ojtPending/pending_overtime_dept.php" name="approval_form" id="penov1">Pending Overtime</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_late_time_in_dept.php" name="approval_form" id="penlate1">Pending Late Time-In</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_official_business_dept.php" name="approval_form" id="penoff1">Pending Official Business</a>
            </li>
            <a href="ojtPending/pending_no_time_in_dept.php" name="approval_form" id="penni1">Pending No In</a>
            </li>
            <li class="nav-item">
                <a href="ojtPending/pending_no_out_dept.php" name="approval_form" id="penno1">Pending No Out</a>
            </li>

            <li class="nav-item">
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    </div>
    <!-- Collapsible content -->


<?php } ?>

<div class="half">
    <div class="container">
        <div class="row">
            <div class = "one">
                <img align="middle" src="img/logo.png">
                <hr>
            </div>
        </div> 
    </div>

  <div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3 style="color: #bb9121;">
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['employee_N'])) : ?>
      <p style="color: #bb9121;">Welcome <strong><?php echo strtoupper($_SESSION['employee_N']); ?></strong></p>
    
      <!-- <div style="position:relative"> -->
         <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span href="#" id="notification-count"><?php if($count>0) { echo $count; } ?></span><img style="height: 50px; margin-bottom: 10px;" src="notify.png" /></button>
         <div class="notification-latest" id="notification-latest"></div>
        <!-- </div> -->
        <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>
        <?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?> 
         <?php if($_SESSION['type'] == 'Employee'){ ?>
            <div class="bg">
              <div id="mySidenav"  class="sidenav">
                <a href="form.php" name="employee_form" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM</a>
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
              </div>
            </div>
         <?php } ?>

          <?php if($_SESSION['type'] == 'staff'){ ?>
            <div class="bg">
              <div id="mySidenav"  class="sidenav">
                <a href="form.php" name="employee_form" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM</a>
                <form action="index.php" method="post">
                <input id="logout1_employee" type="submit" value="Export" name="exp" />
              </form>
                <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
              </div>
            </div>
         <?php } ?>





         <?php if($_SESSION['type'] == 'deptHead'){ ?>
          <div class="bg">
              <div id="mySidenav"  class="sidenav">
                  <a href="form.php" name="employee_form" id="unified1_dept">UNIFIED EMPLOYEE ATTENDANCE FORM</a>

                  <a href="ojtPending/pending_undertime_dept.php" name="approval_form" id="penund1">Pending Undertime</a>

                  <a href="ojtPending/pending_overtime_dept.php" name="approval_form" id="penov1">Pending Overtime</a>

                  <a href="ojtPending/pending_late_time_in_dept.php" name="approval_form" id="penlate1">Pending Late Time-IN</a>
                </div>
            </div>

          <div class="gb">
              <div id="mySidenav1" class="sidenav1">
                  <a href="ojtPending/pending_official_business_dept.php" name="approval_form" id="penoff1">Pending Official Business</a>

                  <a href="ojtPending/pending_no_time_in_dept.php" name="approval_form" id="penni1">Pending No In</a>

                  <a href="ojtPending/pending_no_out_dept.php" name="approval_form" id="penno1">Pending No Out</a>
          
                  <a href="index.php?logout='1'" id="logout1">Logout</a>
              </div>
          </div>
         <?php } ?>
      
         <?php if($_SESSION['type'] == 'HR'){ ?>
         <div class="bg">
            <div id="mySidenav" class="sidenav1">
              <a href="form.php" name="employee_form" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM</a>
              <a href="ojtPending/pending_with_reject.php" name="approval_form" id="penreg1">Pending Registration</a>
              <a href="ojtPending/pending_undertime_dept.php" name="approval_form" id="penund1">Pending Undertime</a>
              <a href="ojtPending/pending_overtime_dept.php" name="approval_form" id="penov1">Pending Overtime</a>
              <a href="ojtPending/pending_late_time_in_dept.php" name="approval_form" id="penlate1">Pending Late Time-IN</a>
            </div>
        </div>

        <div class="gb">
              <div id="mySidenav1" class="sidenav1">
                  <a href="ojtPending/pending_official_business_dept.php" name="approval_form" id="penoff1">Pending Official Business</a>

                  <a href="ojtPending/pending_no_time_in_dept.php" name="approval_form" id="penni1">Pending No In</a>

                  <a href="ojtPending/pending_no_out_dept.php" name="approval_form" id="penno1">Pending No Out</a>
          
                  <a href="index.php?logout='1'" id="logout1">Logout</a>
              </div>
          </div>

          <?php } ?>

      
    <?php endif ?>


    <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border: 1px solid #bb9121;" class="table table-bordered table-striped" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr style="border: 1px solid #bb9121;">
      <!-- <th>I.D</th> -->
      <th style="border: 1px solid #bb9121;color: #bb9121;">Employee Number</th>
      <th style="border: 1px solid #bb9121;color: #bb9121;">Request Type</th>
      <th style="border: 1px solid #bb9121;color: #bb9121;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border: 1px solid #bb9121;color: #bb9121;">Total Hours</th>
      <th style="border: 1px solid #bb9121;color: #bb9121;">Reason</th>
      <th style="border: 1px solid #bb9121;color: #bb9121;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT employeeNum,request_type,id, name, shift1, is_approved, startdate, enddate, result, reason FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        while ($row = $result1-> fetch_assoc()){
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border: 1px solid #bb9121; color: #bb9121;">'.$row["employeeNum"].'';
            echo '</td><td style="border: 1px solid #bb9121;color: #bb9121;">'.$row["request_type"].'';
            echo '</td><td style="border: 1px solid #bb9121;color: #bb9121;">'. $row["name"].'</td>';
            echo  '<td style="border: 1px solid #bb9121;color: #bb9121;">'. $row["result"].'</td>';
            echo  '<td style="border: 1px solid #bb9121;color: #bb9121;">'. $row["reason"].'</td>';
            echo '<td style="border: 1px solid #bb9121;color: #bb9121;">'. $row["is_approved"].'</td></tr>';
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



</form>
  </div>
</div>
    
</body>
</html>
