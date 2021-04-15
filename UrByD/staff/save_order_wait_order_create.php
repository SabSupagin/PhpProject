<?php
session_start();
include('..\global_service\connectdb.php');

  $Total = 0;
  $SumTotal = 0;




  $order_id = $_POST["order_id"];
  $staff_id = $_POST["staff_id"];
  $order_seat = $_POST["order_seat"];
  $order_discount = $_POST["order_discount"];
  $order_sum_price = $_POST["order_sum_price"];

  $sum = $order_sum_price-$order_discount;

    $sql = "INSERT INTO aby_order(order_id,order_sum_price,staff_id,order_createddate,order_discount,order_seat,ord_id) 
            VALUES('".$order_id."','".$sum."','".$staff_id."',NOW(),'".$order_discount."','".$order_seat."',1)";

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
  
          $product_price = $result['product_price'];
          $product_stock = $result['product_stock'];
          $ss = $product_stock-$_SESSION["strQty"][$i];
  
            $sql = "INSERT INTO aby_order_detail(product_id,order_detail_qty,order_id,order_detail_price)
                    VALUES('".$_SESSION["strProduct_id"][$i]."','".$_SESSION["strQty"][$i]."','".$order_id."','".$product_price."')";
            $executeQry = mysqli_query($conn,$sql);

            if($executeQry) {
              $sql3 = "UPDATE aby_product SET
			                product_stock = '".$ss."'
                      WHERE product_id = '".$_SESSION["strProduct_id"][$i]."' ";
              $executeQry3 = mysqli_query($conn,$sql3);

            }
  
          $Line = $i;
        $_SESSION["strProduct_id"][$Line] = "";
        $_SESSION["strQty"][$Line] = "";
  
  
        }
  
    }
    header("location:order_wait_for_payment.php");



    



?>
