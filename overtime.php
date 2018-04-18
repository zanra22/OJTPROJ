

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
<h3 align="center">OVERTIME FORM</h3>
<form name="add_name" id="add_name" method="post" action="overtime.php" style="display: block;" align="center">
<table class="table table-bordered" align="center" style="margin-bottom: 10px">
  <thead>
    <tr>
      <th></th>
      <th style="display: block">Date</th>
      <!-- <th colspan="2">Regular Shift</th>
      <th colspan="2">Overtime</th>
      
      <th>Total Hours</th>
      <th></th> -->
    </tr>
  </thead>
  <tbody id="dataTable">
   <?php 

      echo '<tr><td colspan="0"><input type="checkbox" name="chk"></input></td>';
      echo '<td><input name="name[]" type="date" placeholder="yyyy-mm-dd" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31)"></td>';
      // echo '<td><input name="shift1[id]" required=required type="time" placeholder="Start of Regular Shift"></td>';
      // echo '<td><input name="shift2[id]" required=required type="time" placeholder="End of Regular Shift"></td>';
      // echo '<td><input name="over1[id]" type="time" placeholder="Start of Overtime"></td>';
      // echo '<td><input name="over2[id]" type="time" placeholder="End of Overtime"></td>';
      // echo '<td><input name="total[id]" type="text" ></td>';
   
     
    '</tr>'
    ?>
  </tbody>
</table>

	
  <input type="submit" name="overtime_submit" value="Submit">
  <INPUT type="button" value="Add Row" onClick="addRow('dataTable')" />

  <INPUT type="button" value="Delete Row" onClick="deleteRow('dataTable')" />
</form>



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

    $('#overtime_submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  

  </SCRIPT>

</body>
</html>