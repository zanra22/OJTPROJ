<?php include('server.php');
 ?>

<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="homepage.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<style>
table, td {
    border: 1px solid black;
}

.th{
  margin-left: 100px;
}
</style>
	<title></title>
</head>
<body>
<!-- <?php
$radioVal = $_POST["MyRadio"];
?> -->

<?php if($radioVal == 1) :?>
	<form method="post" action="result.php">
		<?php include('errors.php'); ?>
		
		<h3 style="text-align: center;">UNDERTIME FORM</h3>
	    <form style="display: block;" align="center">
	<strong><label style="text-align: center;">Reason</label></strong>
	<br>
	<input style="text-transform: uppercase;" type="text" name="reason_1">
	<br>
  <button type="submit" class="btn btn-outline-warning btn-lg" name="form_reg">Submit</button>
</form>

<?php endif ?>


	<?php if($radioVal == 2) :?>
		<h3 style="text-align: center;">LATE TIME-IN FORM</h3>
	    <form style="display: block;" align="center">
		<strong><label style="text-align: center;">Reason</label></strong>
		<br>
		<textarea cols="108" style="width: auto;"></textarea>
		<br>
  		<input type="submit" name="submit" value="Submit">
  		<INPUT type="button" value="Add Row" onClick="addRow('dataTable')" />

  		<INPUT type="button" value="Delete Row" onClick="deleteRow('dataTable')" />
		</form>
	<?php endif ?>


	<?php if($radioVal == 3) :?>
		<h3 style="text-align: center;">OVERTIME FORM</h3>
	    <form style="display: block;" align="center">
		<table class="table table-bordered" align="center" style="margin-bottom: 10px">
  		<thead>
   		 <tr>
     		 <th></th>
     		 <th style="display: block">Date</th>
      		<th colspan="2">Regular Shift</th>
      		<th colspan="2">Overtime</th>
     		 <th>Total Hours</th>
    	</tr>
  		</thead>
  		<tbody id="dataTable">
   			 <tr>
     			 <td colspan="0"><input type="checkbox" name="chk"></input></td>
      			<td><input type="date" placeholder="yyyy-mm-dd" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31)"></td>
     			<td><input type="time" placeholder="Start of Regular Shift"></td>
     			<td><input type="time" placeholder="End of Regular Shift"></td>
      			<td><input type="time" placeholder="Start of Overtime"></td>
      			<td><input type="time" placeholder="End of Overtime"></td>
      			<td><input type="text" ></td>
      
    		</tr>
  		</tbody>
</table>
		<strong><label style="text-align: center;">Reason</label></strong>
		<br>
		<textarea cols="108" style="width: auto;"></textarea>
		<br>
  		<input type="submit" name="submit" value="Submit">
  		<INPUT type="button" value="Add Row" onClick="addRow('dataTable')" />

  		<INPUT type="button" value="Delete Row" onClick="deleteRow('dataTable')" />
</form>
<?php endif ?>


<!-- SCRIPTS -->
<!-- SCRIPT FOR OVERTIME -->

<SCRIPT language="javascript">
    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = document.getElementById(tableID).rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

  </SCRIPT>
</body>
</html>