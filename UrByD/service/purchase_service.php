<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "confirm_receive"){
        $product_ids = $_POST['product_ids'];
        $product_qty = $_POST['product_qty'];
        $product_qty2 = $_POST['product_qty2'];
        $purchase_detail = array();
        foreach( $product_ids as $key => $product_id ) {
            $detail['product_id'] = $product_id;
            $detail['product_qty'] = $product_qty[$key];
            $detail['product_qty2'] = $product_qty2[$key];
            array_push($purchase_detail,$detail);
        }
        $po_id = $_POST['po_id'];

        $sql = "DELETE FROM aby_purchase_order_detail WHERE po_id = '$po_id' ";
        $executeQry = mysqli_query($conn,$sql);

        foreach($purchase_detail as $detail){

            $product_id = $detail['product_id'];
            $product_qty2 = $detail['product_qty2'];

            $sql = "SELECT p.*,c.category_name ,un.unit_name
                    FROM aby_product p
                    INNER JOIN aby_category c on c.category_id = p.category_id
                    INNER JOIN aby_unit un on un.unit_id = p.unit_id
                    WHERE product_id = '".$product_id."' ";

            $query = mysqli_query($conn,$sql);
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);


            $product_price = $result['product_cost'];
            $product_qty = $detail['product_qty'];


            $sql3 = "INSERT INTO aby_purchase_order_detail(po_id,product_id,product_price,product_qty,product_qty2)
                    VALUES('".$po_id."','".$product_id."',$product_price,'".$product_qty."',
                    '".$product_qty2."')";
            $executeQry3 = mysqli_query($conn,$sql3);
    
            $sql12 = "UPDATE aby_product SET product_stock = product_stock + $product_qty2 WHERE product_id = '".$product_id."' ";
            $query12 = mysqli_query($conn,$sql12);

        

        }
        if($query12) {

            //$sql = "INSERT INTO aby_purchase_order(po_enddate) 
            //VALUES(NOW())";

            $sql = "UPDATE aby_purchase_order SET
                    po_enddate = NOW() ,
                    pos_id = 2
                    WHERE po_id = '".$po_id."' ";
            
            $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('รับสินค้าเรียบร้อยแล้ว');location='/UrByD/staff/purchase_order.php';</script>";
            }
        }
        
            




    }
    else if($action == "confirm_edit"){ //แก้ไข
        $product_ids = $_POST['product_ids'];
        $product_qty = $_POST['product_qty'];
        $product_qty2 = $_POST['product_qty2'];
        $purchase_detail = array();
        foreach( $product_ids as $key => $product_id ) {
            $detail['product_id'] = $product_id;
            $detail['product_qty'] = $product_qty[$key];
            $detail['product_qty2'] = $product_qty2[$key];
            array_push($purchase_detail,$detail);
        }

        $po_id = $_POST['po_id'];

        $sql = "DELETE FROM aby_purchase_order_detail WHERE po_id = '$po_id' ";
        $executeQry = mysqli_query($conn,$sql);

        foreach($purchase_detail as $detail){

            $product_id = $detail['product_id'];

            $sql = "SELECT p.*,c.category_name ,un.unit_name
                    FROM aby_product p
                    INNER JOIN aby_category c on c.category_id = p.category_id
                    INNER JOIN aby_unit un on un.unit_id = p.unit_id
                    WHERE product_id = '".$product_id."' ";

            $query = mysqli_query($conn,$sql);
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);


            $product_price = $result['product_cost'];
            $product_qty = $detail['product_qty'];

            //$sql3 = "INSERT INTO aby_purchase_order_detail(po_id,product_id,product_price,product_qty,product_qty2)
            //       VALUES('".$po_id."',$product_id,$product_price,$product_qty,$product_qty)";

            $sql3 = "INSERT INTO aby_purchase_order_detail(po_id,product_id,product_price,product_qty,product_qty2)
                    VALUES('".$po_id."','".$product_id."',$product_price,'".$product_qty."',
                    '".$product_qty."')";
            $executeQry3 = mysqli_query($conn,$sql3);
        }
        if($executeQry3) {
            echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/purchase_order.php';</script>";
       }
    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "cancel_purchase"){ //ยกเลิก

        $po_id = $_GET["po_id"];

        $sql = "UPDATE aby_purchase_order SET
                pos_id = 3
                WHERE po_id = '".$po_id."'  ";
        

	    $query = mysqli_query($conn,$sql);

	    if(mysqli_affected_rows($conn)) {
            //header("location:prefixs.php");
            echo "<script>alert('ยกเลิกข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/purchase_order.php';</script>";
	    }

    }
}
?>