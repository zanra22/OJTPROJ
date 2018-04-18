<?php include('server.php');
 ?>

<html>
<head>
	
<style>
table, td {
    border: 1px solid black;
}

</style>

	<title></title>
</head>
<body>
<?php

$radioVal = $_POST["MyRadio"];
$_SESSION['MyRadio'] = $radioVal;
?>

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
		
		<h3 align="center">OVERTIME FORM</h3>
<form method="post" action="result.php" style="display: block;" align="center">
<table class="table table-bordered" align="center" style="margin-bottom: 10px">
  <thead>
    <tr>
      <th></th>
      <th style="display: block">Date</th>
      <th colspan="2">Regular Shift</th>
      <th colspan="2">Overtime</th>
      
      <th>Total Hours</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="dataTable">
    <tr>
      <td colspan="0"><input type="checkbox" name="chk"></input></td>
      <td><input name="date" type="date" placeholder="yyyy-mm-dd" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31)"></td>
      <td><input name="shift1" type="time" placeholder="Start of Regular Shift"></td>
      <td><input name="shift2" type="time" placeholder="End of Regular Shift"></td>
      <td><input name="over1" type="time" placeholder="Start of Overtime"></td>
      <td><input name="over2" type="time" placeholder="End of Overtime"></td>
      <td><input name="total" type="text" ></td>
<!--       <td><button type="submit" name="overtime_submit">Submit</button></td>
 -->      
    </tr>
  </tbody>
</table>

	
  <input type="submit" name="overtime_submit" value="Submit">
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
        switch(newcell.childNodes[0].name) {
          case "text":
              newcell.childNodes[0].name = "";
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