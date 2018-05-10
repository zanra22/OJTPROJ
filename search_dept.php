<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Search</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
 </head>
 <body style="background-color: #fffacd;">
  <div class="container">
   <br />
   <h2 align="center">Search Record</h2><br />

   <div class="form-group">
    <a style="margin-bottom: 5px;" href="index.php" class="btn btn-info btn-md">
          <span class="glyphicon glyphicon-arrow-left"></span> Back
        </a>
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input style="background-color: #fffacd;" type="text" name="search_text" id="search_text" placeholder="Search by First Name, Middle Name, Last Name, Employee Number, Department, Request Type or Status" class="form-control" />
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>