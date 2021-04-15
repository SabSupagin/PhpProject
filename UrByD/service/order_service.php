<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "edit_order"){

        $order_id = $_POST['order_id'];
        $ord_id = $_POST['ord_id'];

        //echo $order_id;
        //echo $ord_id;
        

        $sql = "UPDATE aby_order SET
                   ord_id = '".$ord_id."'
                    WHERE order_id = '".$order_id."' ";
            
            $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('ชำระเงินเรียบร้อยแล้ว');location='/UrByD/staff/order_wait_for_payment.php';</script>";
            }



    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_category"){
        $category_id = $_GET["category_id"];

        $sql = "DELETE FROM aby_category
			    WHERE category_id = '".$category_id."' ";

	    $query = mysqli_query($conn,$sql);

	    if(mysqli_affected_rows($conn)) {
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/category.php';</script>";
	    }

    }
}
?>