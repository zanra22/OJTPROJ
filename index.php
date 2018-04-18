<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=testing4", "root", 'str0ngpa$$w0rd');
function fill_unit_select_box($connect)
{ 
 function differenceInHours($startdate,$enddate){

  $starttimestamp = strtotime($startdate);
  $endtimestamp = strtotime($enddate);
  $difference = abs($endtimestamp - $starttimestamp)/3600;
  return $difference;
}
if(!empty($_POST["submit1"])) {
  $hours_difference = differenceInHours($_POST["startdate"],$_POST["enddate"]); 
  // echo "The Difference is " . $hours_difference . " hours";
}
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</h3>
   <br />
   <h4 align="center">Enter Item Details</h4>
   <br />
   <form method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Enter Item Name</th>
       <th colspan="2">Regular Shift</th>
       <th colspan="2">Overtime</th>
       <th></th>
     </tr>
     <tr>
       <td><input type="date" name="item_name[]" class="form-control item_name" /></td>
       <td><input type="time" name="item_quantity[]" class="form-control item_quantity" /></td>
       <td><input type="time" name="item_quantity_2[]" class="form-control item_quantity" /></td>
       <td><input type="time" name="startdate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["startdate"]; } ?>" class="form-control item_quantity" /></td>
       <td><input type="time" name="enddate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["enddate"]; } ?>" class="form-control item_quantity" /></td>
       <td><input readonly id="display" name="result" type="number" class="form-control item_quantity" value="<?php echo isset($hours_difference)?$hours_difference:""?>"></td>
       <td><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></td>
      </tr>
     </table>
     <div align="center">
      
      <input type="submit" name="submit"  class="btn btn-info" value="Insert"/>
      <input type="submit" name="submit1" value="Find Difference" class="btnAction">
     </div>
    </div>
   </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="date" name="item_name[]" class="form-control item_name" /></td>';
  html += '<td><input type="time" name="item_quantity[]" class="form-control item_quantity" /></td>';
  html += '<td><input type="time" name="item_quantity_2[]" class="form-control item_quantity" /></td>';
  html += '<td><input type="time" name="startdate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["startdate"]; } ?>" class="form-control item_quantity" /></td>';
  html += '<td><input type="time" name="enddate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["enddate"]; } ?>" class="form-control item_quantity" /></td>';
  html += '<td><input readonly id="display" name="result" type="number" class="form-control item_quantity" value="<?php echo isset($hours_difference)?$hours_difference:""?>"></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 // <select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select>
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.item_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  
  
  $('.item_unit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {window.location.href = "http://www.yourdomain.com/somepage.html";
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
      window.location = "http://www.yoururl.com";
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>