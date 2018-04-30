<?php
// $conn = new mysqli("localhost","root",'str0ngpa$$w0rd',"registration");
include('server.php');

$employee_Number = $_SESSION['employee_N'];
      			$user = "SELECT * FROM user WHERE employeeNum = '$employee_Number'";
      				$price = mysqli_query($db,$user);
      				$result = mysqli_fetch_assoc($price);

      				$_SESSION['department'] = $result['department'];
      				$_SESSION['type'] = $result['type'];
      				$test = $_SESSION['department'];
if($_SESSION['type'] == 'HR'){
$sql="UPDATE form SET status=1 WHERE status=0";	
$result=mysqli_query($db, $sql);

$sql3="SELECT * FROM form WHERE is_approved = 'PENDING' ORDER BY id DESC limit 10";
$result=mysqli_query($db, $sql3);

$response='';
while($row=mysqli_fetch_array($result)) {
	// if($row['request_type'] == 'UNDERTIME'){
// 	$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='#'>" .
// 	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
// 	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
// 	"</a>".
// 	"</div>";
// }
	if($row['request_type'] == 'UNDERTIME' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_undertime_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'LATE TIME-OUT' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_out_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'LATE TIME-IN' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_late_time_in_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'NO OUT' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_out_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'NO IN' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_time_in_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'OFFICIAL BUSINESS' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_official_business_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'OVERTIME' && $row['dept_approved'] == 'APPROVED'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_overtime_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}
}

if(!empty($response)) {
	print $response;
}
else
 {
  $response .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
}


if($_SESSION['type'] == 'deptHead'){
$sql="UPDATE form SET status=1 WHERE status=0";	
$result=mysqli_query($db, $sql);

$sql2="SELECT * FROM form WHERE  dept_approved = 'PENDING' AND department = '$test' ORDER BY id DESC limit 10";
$result=mysqli_query($db, $sql2);

$response='';
while($row=mysqli_fetch_array($result)) {
	if($row['request_type'] == 'UNDERTIME'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_undertime_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'LATE TIME-OUT'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_out_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'LATE TIME-IN'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_late_time_in_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

	if($row['request_type'] == 'NO OUT'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_out_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'NO IN'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_no_time_in_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'OFFICIAL BUSINESS'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_official_business_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}

if($row['request_type'] == 'OVERTIME'){
$response .=  "<div class='notification-item'><a style='text-decoration: none;color:#bb9121;' href='ojtPending/pending_overtime_dept.php'>" .
	"<div class='notification-subject'>". $row["employeeNum"] . "</div>" . 
	"<div class='notification-comment'>" . $row["request_type"]  . "</div>" .
	"</a>".
	"</div>";
}
}

if(!empty($response)) {
	print $response;
}
else
 {
  $response .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
}


?>