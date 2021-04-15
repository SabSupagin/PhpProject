<?php
session_start();
include('..\global_service\connectdb.php');

  $Total = 0;
  $SumTotal = 0;




  $po_id = $_POST["po_id"];
  $staff_id = $_POST["staff_id"];
  $supplier_id = $_POST["supplier_id"];

  

    $sql = "INSERT INTO aby_purchase_order(po_id,staff_id,po_createddate,pos_id,supplier_id) 
            VALUES('".$po_id."','$staff_id',NOW(),1,'$supplier_id')";

    $query = mysqli_query($conn,$sql);

   

    
    for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
    {
      if($_SESSION["strProduct_id"][$i] != "")
      {
          $product_id = $_SESSION["strProduct_id"][$i];
          $sql = "SELECT p.*,c.category_name ,un.unit_name
                FROM aby_product p
        INNER JOIN aby_category c on c.category_id = p.category_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id
        WHERE product_id = '".$_SESSION["strProduct_id"][$i]."' ";

$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);
  
          $product_price = $result['product_cost'];
  
  
          $sql = "INSERT INTO aby_purchase_order_detail(po_id,product_id,product_price,product_qty,product_qty2)
                      VALUES('".$_POST["po_id"]."','".$_SESSION["strProduct_id"][$i]."',$product_price,'".$_SESSION["strQty"][$i]."',
                      0)";
          
  
  
          $executeQry = mysqli_query($conn,$sql);
  
          $Line = $i;
        $_SESSION["strProduct_id"][$Line] = "";
        $_SESSION["strQty"][$Line] = "";
  
  
        }
  
    }

  //session_destroy();

header("location:purchase_order.php");
?>
