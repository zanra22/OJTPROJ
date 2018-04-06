<?php
session_start();

// initializing variables
$firstname = "";
$email    = "";
$middlename ="";
$lastname = "";
$position = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'str0ngpa$$w0rd', 'registration');
// $asd = strtoupper(string)
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($db, $_POST['middlename']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $employee_Number =  mysqli_real_escape_string($db, $_POST['employee_N']);
  $dept = mysqli_real_escape_string($db, $_POST['department']);
  $positition= mysqli_real_escape_string($db, $_POST['position']);
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
  	header('location: index.php');
  }
}





// ... 

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
    $query = "SELECT * FROM user WHERE employeeNum='$employee_Number' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['employee_N'] = $employee_Number;
      $_SESSION['department'] = $dept;  
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

  $query1 = "SELECT * FROM user";
  $resultss = mysqli_query($db, $query1);
  if (mysqli_num_rows($resultss) == 1) {
      $_SESSION['employee_N'] = $employee_Number;
      $_SESSION['department'] = $dept;  
      $_SESSION['success'] = "TEST";
    }

?>

