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
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];
     header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=form_backup_hr_staff.csv');

    $output = fopen('php://output', 'w');

    fputcsv($output, array('Employee Name', 'Department','Date Filed','Unified Form','Department Approved/Pending','HR Approved/Pending'));
    $con = mysqli_connect('localhost', 'root', 'str0ngpa$$w0rd', 'registration');
    
    $rows = mysqli_query($con, "SELECT fullname,department,dateFiled,request_type,dept_approved,is_approved FROM form WHERE DATE(dateFiled) BETWEEN '$date1' AND '$date2' ");

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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- nofitification -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook Like Header Notification in PHP</title>
  <link rel="stylesheet" href="notification-demo-style.css" type="text/css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
   function getPosition(val, val2){
    var id = $(val2).data("id");
    $.ajax({
      type:"POST",
      url: "get_state.php",
      data: 'department='+val,
      success: function(data){
        $("#position-list_" + id).html(data);
        // alert(id);
      }
    });
  }
     
  </script>
</head>
<body style="background-color: #fffacd;">
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
                <a href="search_dept.php" name="approval_form" id="penreg1">Search</a>
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

    <div class="sec">
<div class="container-fluid">
<div class="section text-center">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <h3>Mission</h3>
      <p align="middle">Foster and celebrate winning moments by providing exceptional customer experience<br> through throughful service, fair dealings, excellent facilities, and orgnizational synergy.</p>
      <h3>Vision</h3>
      <p align="middle" style="text-align: center;">The premiere and most preferred integrated entertainment and tourism destination at the<br> heart of central luzon, renowned for service excellence that showcases regional pride at a world class level.</p>
    </div>
    <div class="carousel-item">
      <h3>Core Values</h3>
      <ul class="list-group">
        <li><strong>-Respect</strong> : We recognized and accept the diverse opinions of other members of the team.</li>
      <li><strong>-Ownerhip</strong> : We genuinely show concern to the company.</li>
      <li><strong>-Yng Calinisan</strong> : It our endeavor to be always clean of mind, heart and in our daily actions.</li>
      <li><strong>-Commitment</strong> : We commit our loyalty to the organization and to always show teamwork in everything that we do.</li>
      <li><strong>-Excellence </strong>: We see ourselves as the leader in the industry; we set industry standards and is the benchmark for excellence and innovation</li>
      </ul>
      
     

    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
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

            <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border-left: none;border-right: none;border-bottom: none;" class="table" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr >
      <!-- <th>I.D</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Employee Number</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Request Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Leave Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Total Minutes</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Reason</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT * FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        while ($row = $result1-> fetch_assoc()){
          
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border-left: none;border-right: none;">'.$row["employeeNum"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["request_type"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["leaveType"].'';
            echo '</td><td sstyle="border-left: none;border-right: none;">'. date("M d, Y", strtotime($row["dateFiled"])).'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["result"].'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["reason"].'</td>';
            echo '<td style="border-left: none;border-right: none;">'. $row["is_approved"].'</td></tr>';
        }
        echo "</table>";
      }
      else{
        echo "0 result";
      }
    }
    ?>


         <?php } ?>

          <?php if($_SESSION['type'] == 'staff'){ ?>
          <div class="bg">
            <div id="mySidenav" class="sidenav1">
              <a href="form.php" name="employee_form" id="unified1">UNIFIED EMPLOYEE ATTENDANCE FORM</a>
              <a href="index.php?logout='1'" id="logout1_employee">Logout</a>
              </div>
          </div>

         
      
            
            <form action="index.php" method="post" style="border: 0;  " class="col-md-12">
             <div class="row col-md-8">

             <div class="column_center">
                <div class="labels col-md-6">
                  <label class="formtext_left"> From: </label>
                  <input type="date"  class="left" id="date1" name="date1" required/>
                </div>
                <div class="inputs col-md-6">
                  <label class="formtext_right"> To: </label>
                  <input type="date"  class="left" id="date2" name="date2" required/>
                </div>
            <div>
          <input id="logout1_employee" type="submit" value="Export" name="exp" />  
        </div>
              
            
            </form>
                <!-- <a href="index.php?logout='1'" id="logout1_employee">Logout</a> -->
                
              </div>
            </div>

            <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border-left: none;border-right: none;border-bottom: none;" class="table" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr >
      <!-- <th>I.D</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Employee Number</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Request Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Leave Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Total Minutes</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Reason</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT * FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        while ($row = $result1-> fetch_assoc()){
          
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border-left: none;border-right: none;">'.$row["employeeNum"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["request_type"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["leaveType"].'';
            echo '</td><td sstyle="border-left: none;border-right: none;">'. date("M d, Y", strtotime($row["dateFiled"])).'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["result"].'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["reason"].'</td>';
            echo '<td style="border-left: none;border-right: none;">'. $row["is_approved"].'</td></tr>';
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
         <?php } ?>





         <?php if($_SESSION['type'] == 'deptHead'){ ?>
         <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span href="#" id="notification-count"><?php if($count>0) { echo $count; } ?></span><img style="height: 50px; margin-bottom: 10px; width: 50px;" src="notify.png" /></button>
         <div class="notification-latest" id="notification-latest"></div>
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
                  
                  <a href="ojtPending/pending_leave_forms_dept.php" name="approval_form" id="testSide">Pending Leave Forms</a>

                  <a href="ojtPending/pending_change_schedule_dept.php" name="approval_form" id="testSide2">Pending Change Schedule</a>

                  <a href="ojtPending/pending_change_off_dept.php" name="approval_form" id="testSide3">Pending Change Off</a>

                  <a href="index.php?logout='1'" id="logout1Hr">Logout</a>
              </div>
          </div>

          <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border-left: none;border-right: none;border-bottom: none;" class="table" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr >
      <!-- <th>I.D</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Employee Number</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Request Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Leave Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Total Minutes</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Reason</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT * FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        while ($row = $result1-> fetch_assoc()){
          
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border-left: none;border-right: none;">'.$row["employeeNum"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["request_type"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["leaveType"].'';
            echo '</td><td sstyle="border-left: none;border-right: none;">'. date("M d, Y", strtotime($row["dateFiled"])).'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["result"].'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["reason"].'</td>';
            echo '<td style="border-left: none;border-right: none;">'. $row["is_approved"].'</td></tr>';
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
         <?php } ?>


         <!-- GM -->

                  <?php if($_SESSION['type'] == 'gm'){ ?>
         <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span href="#" id="notification-count"><?php if($count>0) { echo $count; } ?></span><img style="height: 50px; margin-bottom: 10px; width: 50px;" src="notify.png" /></button>
         <div class="notification-latest" id="notification-latest"></div>
          <div class="bg">
              <div id="mySidenav"  class="sidenav">
                  <a href="form.php" name="employee_form" id="unified1_gm">UNIFIED EMPLOYEE ATTENDANCE FORM</a>

                  <a href="ojtPending/pending_overtime_dept.php" name="approval_form" id="penov1_gm">Pending Overtime</a>
                </div>
            </div>

          <div class="gb">
              <div id="mySidenav1" class="sidenav1">
                  <a href="index.php?logout='1'" id="logout1Gm">Logout</a>
              </div>
          </div>

          <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border-left: none;border-right: none;border-bottom: none;" class="table" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr >
      <!-- <th>I.D</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Employee Number</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Request Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Leave Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Total Minutes</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Reason</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT * FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        while ($row = $result1-> fetch_assoc()){
          
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border-left: none;border-right: none;">'.$row["employeeNum"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["request_type"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["leaveType"].'';
            echo '</td><td sstyle="border-left: none;border-right: none;">'. date("M d, Y", strtotime($row["dateFiled"])).'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["result"].'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["reason"].'</td>';
            echo '<td style="border-left: none;border-right: none;">'. $row["is_approved"].'</td></tr>';
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
         <?php } ?>

        <!-- END GM -->


      <?php if($_SESSION['type'] == 'ADMIN'){ ?>
        <div class="bg">
            <a href="index.php?logout='1'" id="logout1">Logout</a>
        </div>
      <?php } ?>


         <?php if($_SESSION['type'] == 'HR'){ ?>
         <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span href="#" id="notification-count"><?php if($count>0) { echo $count; } ?></span><img style="height: 50px; margin-bottom: 10px;" src="notify.png" /></button>
         <div class="notification-latest" id="notification-latest"></div>
         <div class="bg">
            <div id="mySidenav" class="sidenav1">
              <a href="search_dept.php" name="employee_form" id="search">Search</a>

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

                  <a href="ojtPending/pending_leave_forms_dept.php" name="approval_form" id="testSide">Pending Leave Forms</a>

                  <a href="ojtPending/pending_change_schedule_dept.php" name="approval_form" id="testSide2">Pending Change Schedule</a>

                  <a href="ojtPending/pending_change_off_dept.php" name="approval_form" id="testSide3">Pending Change Off</a>
          
                  <a href="index.php?logout='1'" id="logout1Hr">Logout</a>
              </div>
          </div>

          <form class="content" action="index.php" method="post">
   <div  class="maintable">
      <table style="border-left: none;border-right: none;border-bottom: none;" class="table" align="center">
        <!-- <table class="table table-bordered table-striped" align="center"> -->
    <tr >
      <!-- <th>I.D</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Employee Number</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Request Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Leave Type</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Date Filed</th>
      <!-- <th colspan="2">Regular Shift</th> -->
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Total Minutes</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Reason</th>
      <th style="border-left: none;border-right: none;border-bottom: none;text-align: center;">Status</th>
    </tr>
<!-- </table> -->


    <?php 
      $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      if (isset($_SESSION['employee_N'])) {
        $employee_Number = $_SESSION['employee_N'];
      $sql = "SELECT * FROM form WHERE employeeNum = '$employee_Number'  ";
      $result1 = $conn-> query($sql);
      if ($result1-> num_rows > 0) {
        // echo '<table class="table table-bordered table-striped" align="center">';
        echo '<div class="table-responsive">';
        while ($row = $result1-> fetch_assoc()){
          
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

            echo '</td><td style="border-left: none;border-right: none;">'.$row["employeeNum"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["request_type"].'';
            echo '</td><td style="border-left: none;border-right: none;">'.$row["leaveType"].'';
            echo '</td><td sstyle="border-left: none;border-right: none;">'. date("M d, Y", strtotime($row["dateFiled"])).'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["result"].'</td>';
            echo  '<td style="border-left: none;border-right: none;">'. $row["reason"].'</td>';
            echo '<td style="border-left: none;border-right: none;">'. $row["is_approved"].'</td></tr>';
           
        }
         echo '</div>';
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

          <?php } ?>

      
    <?php endif ?>

    <?php if($_SESSION['type'] == 'ADMIN') { ?>
      <form class="content" action="index.php" method="post">
 <div class="formtable"> 
  <table class="table table-bordered table-striped" align="center">
    <tr>
      <!-- <th>I.D</th> -->
      <th>Employee Number</th>
      <th>First Name</th>
      <th>Middle Name</th>
      <th>Last Name</th>
      <th>Department</th>
      <th>Position</th>
      <th>E-mail</th>
      <th>Status</th>
      <th>Account Type</th>
    </tr>
 

<?php 
    $conn = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
      if ($conn-> connect_error) {
        die("Connection Failed:".$conn->connect_error);
      }
      $employee_Number = $_SESSION['employee_N'];
            $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
              $price = mysqli_query($conn,$user);
              $result = mysqli_fetch_assoc($price);

              $_SESSION['department'] = $result['department'];
              $test = $_SESSION['department'];
              $x = 0;
      $sql = "SELECT * FROM user ";
      $result1 = $conn-> query($sql);
if(isset($_POST['update'])){
      $fname = $_POST['firstname'];
      $mname = $_POST['middlename'];
      $lname = $_POST['lastname'];
      $eNum = $_POST['employee_Number'];
      $dept = $_POST['department'];
      $posi = $_POST['position'];
      $email = $_POST['email'];
      $approved = $_POST['is_approved'];
      $type = $_POST['type'];

      foreach ($_POST["id"] as $id) {
        $approved = mysqli_real_escape_string($conn,$_POST["is_approved"][$id]);
        $fname = mysqli_real_escape_string($conn,$_POST["firstname"][$id]);
        $mname = mysqli_real_escape_string($conn,$_POST["middlename"][$id]);
        $lname = mysqli_real_escape_string($conn,$_POST["lastname"][$id]);
        $eNum = mysqli_real_escape_string($conn,$_POST["employee_Number"][$id]);
        $dept = mysqli_real_escape_string($conn,$_POST["department"][$id]);
        $posi = mysqli_real_escape_string($conn,$_POST["position"][$id]);
        $email = mysqli_real_escape_string($conn,$_POST["email"][$id]);
        $type = mysqli_real_escape_string($conn,$_POST["type"][$id]);

        $query = "UPDATE `user` SET `employeeNum`='".$eNum."', `firstname`='".$fname."', `middlename`='".$mname."', `lastname`='".$lname."', `department`='".$dept."', `position`='".$posi."', `email`='".$email."', `is_approved`='".$approved."', `type`='".$type."' WHERE `id` = $id LIMIT 1";
   
   
        $result = mysqli_query($conn, $query);
      }
}
      if ($result1-> num_rows > 0) {
        while ($row = $result1-> fetch_assoc() ){
          $x++;
          echo '<tr><input type = hidden  name = id['.$row["id"].'] type = text readonly = readonly value ="'.$row["id"].'"></input>';

          echo '</td><td><input name = employee_Number['.$row["id"].'] type = text value="'. $row["employeeNum"].'"></input></td>';

            echo '</td><td><input name = firstname['.$row["id"].'] type = text value="'. $row["firstname"].'"></input></td>';

            echo '</td><td><input name = middlename['.$row["id"].'] type = text  value="'. $row["middlename"].'"></input></td>';

            echo '</td><td><input name = lastname['.$row["id"].'] type = text value="'. $row["lastname"].'"></input></td>';
            ?>
            
          <?php  
            echo '<td><select autocomplete="off" data-id="'.$x.'"  id="department-list" name="department['.$row["id"].']" onChange="getPosition(this.value, this)"><option autocomplete="off" style="text-align: center;" value="'.$row['department'].'">'.$row['department'].'</option>';
              ?>
              <?php
            $sql = "SELECT * FROM dept";
                $result = $conn->query($sql);
                while ($rs=$result->fetch_assoc()) {
                ?>
                
              <option value="<?php echo $rs["department"]; ?>"><?php echo $rs["department"]?></option>
           <?php } ?>

            </select></td>  
          <?php
            echo '<td><select id="position-list_'.$x.'" name="position['.$row["id"].']">
            <option autocomplete="off" style="text-align: center;" value="'.$row['position'].'">'.$row['position'].'</option>
              <option value="'.$rs["position"].'">'.$rs["position"].'</option>
              </select></td>';
              
            echo '</td><td><input name = email['.$row["id"].'] type = text  value="'. $row["email"].'"></input></td>';

            echo '</td><td><select  name = is_approved['.$row["id"].']>
            <option value = '.$row['is_approved'].'>'.$row['is_approved'].'</option>
            <option value = PENDING>PENDING</option><option value = APPROVED>APPROVED</option><option value = REJECT>REJECT</OPTION></select></td>';

            echo '</td><td><select  name = type['.$row["id"].']>
            <option value = '.$row['type'].'>'.$row['type'].'</option>
            <option value = HR>HR</option>
            <option value = deptHead>Department Head</option>
            <option value = Employee>Employee</OPTION>
            <option value = staff>Staff</OPTION>
            </select></td></tr>';
        }
        echo "</table>";
      }
      else{
        echo "0 result";
      }


?>
<input type="submit" class="btn btn-default" name="update" value="Update Data">
 </table>
</div>
</form>
<?php } ?>


    
  </div>
</div>
    
</body>
</html>
