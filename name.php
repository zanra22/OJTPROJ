 <?php  
 $errors = array();

 $connect = mysqli_connect("localhost", "root", 'str0ngpa$$w0rd', "registration");  
 $number = count($_POST["name"]);  
 // if($number > 0)  
 // {  
  
      for($i=0; $i<$number; $i++)  
      {  
        $test = mysqli_real_escape_string($connect, $_POST["name"][$i]);
           if(trim($_POST["name"][$i] != ''))  
           {  
                $sql = "INSERT INTO overtime   VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";  
                mysqli_query($connect, $sql);

                
                  
           }
      }  
      // if(empty($test))
      //      {
      //         echo "This Field is Required";
      //      }  
 


 
 ?> 