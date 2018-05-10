<?php
session_start();
require 'E:\xampp\htdocs\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'E:\xampp\htdocs\PHPMailer-master\PHPMailer-master\src\SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

// initializing variables
$firstname = "";
$email    = "";
$middlename ="";
$lastname = "";
$position = "";
$reason1 = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'str0ngpa$$w0rd', 'registration');


$db1 = mysqli_connect('localhost', 'root', 'str0ngpa$$w0rd', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, strtoupper($_POST['firstname']));
  $middlename = mysqli_real_escape_string($db, strtoupper($_POST['middlename']));
  $lastname = mysqli_real_escape_string($db, strtoupper($_POST['lastname']));
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $employee_Number =  mysqli_real_escape_string($db, strtoupper($_POST['employee_N']));
  $dept = mysqli_real_escape_string($db, strtoupper($_POST['department']));
  $position= mysqli_real_escape_string($db, strtoupper($_POST['position']));

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

  
  if (empty($firstname)) { array_push($errors, "First name is required"); }
  if (empty($middlename)) { array_push($errors, "Middle name is required"); }
  if (empty($lastname)) { array_push($errors, "Last name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($employee_Number)) { array_push($errors, "Employee Number is required"); }
  if (empty($position)) { array_push($errors, "Position is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE employeeNum='$employee_Number' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);


  
  if ($user) { // if user exists
    if ($user['employeeNum'] === $employee_Number) {
      array_push($errors, "Employee Number already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (firstname, middlename, lastname, email, password, employeeNum, department, position) 
  			  VALUES('$firstname','$middlename', '$lastname', '$email', '$password', '$employee_Number', '$dept', '$position')";
  	mysqli_query($db, $query);
  	$_SESSION['employee_N'] = $employee_Number;
    $_SESSION['firstname'] = $firstname;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    $mail->setFrom('localhost.roycehotel@gmail.com', 'New User Registration');
    $mail->addAddress('arnazdj@gmail.com');     // HR EMail

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New User Registration';
    $mail->Body    = 'This is to inform you that a new user is trying to register on our system <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
  }
}

    

// ... 
    if (isset($_POST['undertime_reg'])) {
        $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $undertime =  mysqli_real_escape_string($db, $_POST['undertime']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        // $reason =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';        
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }

        // $_SESSION['employee_N'] = $employee_Number;
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,undertime,result,request_type,dept_approved,reason,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$undertime','$total','$request_type','$test2','$reason_undertime','$position')";
    mysqli_query($db, $query3);
    // session_start();
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];
    header('location: undertime.php');

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Undertime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }


        // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Undertime Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Undertime Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}

    if (isset($_POST['no_in_reg'])) {
         $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $no_in =  mysqli_real_escape_string($db, $_POST['no_in']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        // $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,no_in,result,request_type,dept_approved,reason,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$no_in','$total','$request_type','$test2','$reason_undertime','$position')";
    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: no_in.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }    // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'No-In Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a No-In Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}

if (isset($_POST['no_out_reg'])) {
      $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $no_out =  mysqli_real_escape_string($db, $_POST['no_out']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,no_out,result,request_type,dept_approved,reason,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$no_out','$total','$request_type','$test2','$reason_undertime','$position')";
    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: no_out.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'No Out Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }        // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'No-Out Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a No-Out Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}


if (isset($_POST['changeSchedule_reg'])) {
      $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $newStartOfShift =  mysqli_real_escape_string($db, $_POST['newStartOfShift']);
        $newEndOfShift =  mysqli_real_escape_string($db, $_POST['newEndOfShift']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,result,request_type,dept_approved,reason,position,newStartOfShift,newEndOfShift) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$total','$request_type','$test2','$reason_undertime','$position','$newStartOfShift','$newEndOfShift')";
    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: changeSchedule.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('arnazdj@gmail.com'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Schedule Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }        // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Schedule Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a No-Out Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}


if (isset($_POST['changeOff_reg'])) {
      $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $offDate =  mysqli_real_escape_string($db, $_POST['offDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $newStartOfShift =  mysqli_real_escape_string($db, $_POST['newStartOfShift']);
        $newEndOfShift =  mysqli_real_escape_string($db, $_POST['newEndOfShift']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,result,request_type,dept_approved,reason,position,newStartOfShift,newEndOfShift,offDate) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$total','$request_type','$test2','$reason_undertime','$position','$newStartOfShift','$newEndOfShift','$offDate')";
    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: changeOff.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('arnazdj@gmail.com'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Change Off Request');
    $mail->addAddress('jamesleft123@gmail.com'); 
    }        // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Off Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Change Off Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}

if (isset($_POST['official_business_reg'])) {
         $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $no_in =  mysqli_real_escape_string($db, $_POST['no_in']);
        $no_out =  mysqli_real_escape_string($db, $_POST['no_out']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $situation =  mysqli_real_escape_string($db, strtoupper($_POST['situation'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        
 $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,no_in,result,request_type,dept_approved,reason,situation,no_out,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$no_in','$total','$request_type','$test2','$reason_undertime','$situation','$no_out','$position')";

    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: official_business.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('localhost.roycehotel@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Official Business Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }      // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Official Business Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Official Business Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}


    if (isset($_POST['latetimein_reg'])) {
        $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $lateTimeIn =  mysqli_real_escape_string($db, $_POST['late_timein']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        // $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,lateTimeIn,result,request_type,dept_approved,reason,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$lateTimeIn','$total','$request_type','$test2','$reason_undertime','$position')";
    mysqli_query($db, $query3);
    // session_start();
 ;
    header('location: late_timein.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'localhost.roycehotel@gmail.com';                 // SMTP username
    $mail->Password = 'str0ngpa$$w0rd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to


    $name = $_POST['name'];
    //Recipients
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Late Time In Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }       // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Late Time In Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Late Time In Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}


if (isset($_POST['overtime_submit'])) {
        $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
        $department =  mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $fullname =  mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $planDate =  mysqli_real_escape_string($db, $_POST['planDate']);
        $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']);  
        $overtime =  mysqli_real_escape_string($db, $_POST['overtime']);
        $total =  mysqli_real_escape_string($db, $_POST['result']);
        $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
        // $request =  mysqli_real_escape_string($db, strtoupper($_POST['request_1'])); 
        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($total)) { array_push($errors, "Total Hours is Required! Press the = button."); }
        // $_SESSION['employee_N'] = $employee_Number;
        // if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (dateFiled,employeeNum,department,fullname,email,planDate,startOfShift,endOfShift,overtime,result,request_type,dept_approved,reason,position) 
              VALUES('$date','$emp','$department','$fullname','$email','$planDate','$startOfShift','$endOfShift','$overtime','$total','$request_type','$test2','$reason_undertime','$position')";

    mysqli_query($db, $query3);
     
    // session_start();
    // echo "alert(\"You didn't fill all fields!\");";
    // echo "<div><td>SUBMITTED</td></div>";
    array_push($errors, "FORM SUBMITTED");
    // header('location: overtime_final.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

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
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }      // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Overtime Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Overtime Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}


if (isset($_POST['leave_submit'])) {
        $emp = mysqli_real_escape_string($db, strtoupper($_POST['employeeNumber']));
        $department = mysqli_real_escape_string($db, strtoupper($_POST['department']));
        $position =  mysqli_real_escape_string($db, strtoupper($_POST['position']));
        $reason_undertime = mysqli_real_escape_string($db, strtoupper($_POST['reason_1']));
         $fullname = mysqli_real_escape_string($db, strtoupper($_POST['full_name']));
         $email = mysqli_real_escape_string($db, $_POST['email']);
         $date = mysqli_real_escape_string($db, strtoupper($_POST['dateFiled']));
         $leaveStart = mysqli_real_escape_string($db, strtoupper($_POST['leaveStart']));
         $leaveEnd = mysqli_real_escape_string($db, strtoupper($_POST['leaveEnd']));
         $leaveType = mysqli_real_escape_string($db, strtoupper($_POST['leaveType']));
         $leavePay = mysqli_real_escape_string($db, strtoupper($_POST['leavePay']));
         $request_type =  mysqli_real_escape_string($db, strtoupper($_POST['request_type'])); 
         $startOfShift =  mysqli_real_escape_string($db, $_POST['startOfShift']);
        $endOfShift =  mysqli_real_escape_string($db, $_POST['endOfShift']); 

        $otherSpecify =  mysqli_real_escape_string($db, $_POST['otherSpecify']); 
        // $result_days =  mysqli_real_escape_string($db, $_POST['result_days']);
        $result_days =  mysqli_real_escape_string($db, $_POST['result']); 

        $test2 = 'PENDING';
$employee_Number = $_SESSION['employee_N'];
                $user = "SELECT department FROM user WHERE employeeNum = '$employee_Number'";
                    $price = mysqli_query($db,$user);
                    $result = mysqli_fetch_assoc($price);

                    $_SESSION['department'] = $result['department'];
                    $test = $_SESSION['department'];

                    if($test == 'HUMAN RESOURCES'){
                        $test2 = 'APPROVED';
                    }
        if (empty($result_days)) { array_push($errors, "Total Hours is Required! Press the = button."); }
        // $_SESSION['employee_N'] = $employee_Number;
        // if (empty($reason_undertime)) { array_push($errors, "Reason is required!"); }

if (count($errors) == 0) {
        $query3 = "INSERT INTO form (employeeNum,department,fullname,email,dateFiled,leaveType,request_type,dept_approved,leaveStart,leaveEnd,startOfShift,endOfShift,leavePay,numOfDays,position,reason,otherSpecify) 
              VALUES('$emp','$department','$fullname','$email','$date','$leaveType','$request_type','$test2','$leaveStart','$leaveEnd','$startOfShift','$endOfShift','$leavePay','$result_days','$position','$reason_undertime','$otherSpecify')";

    mysqli_query($db, $query3);
     
    // session_start();
    // echo "alert(\"You didn't fill all fields!\");";
    // echo "<div><td>SUBMITTED</td></div>";
    array_push($errors, "Leave SUBMITTED");
    // header('location: overtime_final.php');
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

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
    if($test == 'MARKETING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('arnazdj@gmail.com', 'Joe User'); 
    }
    if($test == 'ENGINEERING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'EXECUTIVE OFFICE AND ADMIN'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FINANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'FOOD AND BEVERAGES CULLINARY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FOOD AND BEVERAGES SERVICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'FRONT OFFICE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
     if($test == 'HOUSEKEEPING'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'HUMAN RESOURCES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SALES'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SANITATION'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SECURITY'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }
    if($test == 'SURVELLIANCE'){
        $mail->setFrom('localhost.roycehotel@gmail.com', 'Overtime Request');
    $mail->addAddress('jamesleft123@gmail.com', 'Joe User'); 
    }      // 

    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Leave Request Submitted';
    $mail->Body    = 'This is to inform you that one of our employee has submitted a Overtime Request <br> Please do not reply on this email.';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    }
}



// 



// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $employee_Number = mysqli_real_escape_string($db, $_POST['employee_N']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  if (empty($employee_Number)) {
    array_push($errors, "Employee Number is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM user WHERE employeeNum='$employee_Number' AND password='$password' AND 'is_approved'=0";
    $results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
    if ($user['is_approved'] == 'APPROVED') {
      $_SESSION['employee_N'] = $employee_Number;
        if (isset($_SESSION['employee_N'])) {
        // $employee_Number = $_SESSION['employee_N'];
    $sql = "SELECT * FROM user WHERE employeeNum = '$employee_Number'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
      while($row = $result->fetch_assoc()) {
          $_SESSION['type'] = $row['type'];
        }
    }
      $_SESSION['success'] = "Login Successful";
      header('location: index.php');
    
  
        }
    }

    else{
        array_push($errors, "Please confirm if your account is approved by the H.R Department");
    }
       if(mysqli_num_rows($results) == 0) {
           # code...array_push($errors, "Wrong username/password combination");
      array_push($errors, "Wrong Username/Password combination");
       }
  }
}

?>

