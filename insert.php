<?php
//insert.php;

if(isset($_POST["item_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=testing4", "root", 'str0ngpa$$w0rd');
 $order_id = uniqid();
 
 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {  
  $query = "INSERT INTO tbl_order_items 
  (item_name, item_quantity, item_quantity_2, item_quantity_3, item_quantity_4) 
  VALUES (:item_name, :item_quantity, :item_quantity_2, :item_quantity_3, :item_quantity_4)
  ";

  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    // ':order_id'   => $order_id,
    ':item_name'  => $_POST["item_name"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':item_quantity_2' => $_POST["item_quantity_2"][$count],
    ':item_quantity_3' => $_POST["item_quantity_3"][$count],
    ':item_quantity_4' => $_POST["item_quantity_4"][$count], 
    // ':item_unit'  => $_POST["item_unit"][$count]

   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';

 }
}
?>
