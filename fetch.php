<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM form 
  WHERE employeeNum LIKE '%".$search."%'
  OR fullname LIKE '%".$search."%' 
  OR department LIKE '%".$search."%' 
  OR request_type LIKE '%".$search."%' 
  OR is_approved LIKE '%".$search."%'
  OR position LIKE '%".$search."%'
 ";
  $query2 = "
  SELECT * FROM user 
  WHERE position LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM form ORDER BY id

 ";

}
$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered ">
    <tr>
     <th>Employee Num</th>
     <th>Employee Name</th>
     <th>Department</th>
     <th>Position</th>
     <th>Schedule</th>
     <th>Request Type</th>
     <th>Form Filed</th>
     <th>Requested Date</th>
     <th>Leave Start Date</th>
     <th>Leave End Date</th>
     <th>Total Days</th>
     <th>Total Hours</th>
     <th>Employee`s Reason</th>
     <th>HR Approval</th>
     <th>HR Reason</th>
     <th>Dept. Head Approval</th>
     <th>Dept. Head Reason</th>
    </tr>
     ';
 while($row = mysqli_fetch_array($result))
 {
  if(is_null($row["leaveStart"])){
    $date = "";
  }
  else{
    $date = date("M d, Y , l",strtotime($row["leaveStart"]));
  }
  if(is_null($row["planDate"])){
    $date2 = "";
  }
  else{
    $date2 = date("M d, Y , l",strtotime($row["planDate"]));
  }
  if(is_null($row["leaveEnd"])){
    $date3 = "";
  }
  else{
    $date3 = date("M d, Y , l",strtotime($row["leaveEnd"]));
  }
  $output .= '
   <tr>
    <td>'.$row["employeeNum"].'</td>
    <td>'.$row["fullname"].'</td>
    <td>'.$row["department"].'</td>
    <td>'.$row["position"].'</td>
    <td>'.date("g:i a", strtotime($row["startOfShift"])).' -- '.date("g:i a", strtotime($row["endOfShift"])).'</td>
    <td>'.$row["request_type"].'</td>
    <td>'.date("M d, Y , l",strtotime($row["dateFiled"])).'</td>
    <td>'.$date2.'</td>
    <td>'.$date.'</td>
    <td>'.$date3.'</td>
    <td>'.$row["numOfDays"].'</td>
    <td>'.$row["result"].'</td>
    <td>'.$row["reason"].'</td>
    <td>'.$row["is_approved"].'</td>
    <td>'.$row["reasonHr"].'</td>
    <td>'.$row["dept_approved"].'</td>
    <td>'.$row["reasonDept"].'</td>
   </tr>
   </div>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>