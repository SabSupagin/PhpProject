<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_supplier"){//เพิ่ม

        $supplier_id = $_POST['supplier_id'];
        $supplier_name = $_POST['supplier_name'];
        $supplier_address = $_POST['supplier_address'];
        $supplier_telephone = $_POST['supplier_telephone'];

        if(trim($supplier_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ บริษัทตัวแทนจำหน่าย !');";
            echo "window.location='/UrByD/staff/supplier_create.php';";
            echo "</script>";
		    exit();
        }
        if(trim($supplier_address) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ ที่อยู่ !');";
            echo "window.location='/UrByD/staff/supplier_create.php';";
            echo "</script>";
		    exit();
        }
        if(trim($supplier_telephone) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ เบอร์ติดต่อ !');";
            echo "window.location='/UrByD/staff/supplier_create.php';";
            echo "</script>";
		    exit();
        }

        

        $strSQL = "SELECT * FROM aby_supplier WHERE supplier_name = '".$supplier_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='/UrByD/staff/supplier_create.php';";
                echo "</script>";
        }
        else
        {
            $sql = "INSERT INTO aby_supplier 
                    (supplier_id,supplier_name,supplier_address,supplier_telephone) 
                    VALUES 
                    ('".$supplier_id."','".$supplier_name."','".$supplier_address."','".$supplier_telephone."') ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/supplier.php';</script>";
            }


        }




    }
    else if($action == "edit_supplier"){ //แก้ไข

        $supplier_id = $_POST['supplier_id'];
        $supplier_name = $_POST['supplier_name'];
        $supplier_address = $_POST['supplier_address'];
        $supplier_telephone = $_POST['supplier_telephone'];

        if(trim($supplier_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ บริษัทตัวแทนจำหน่าย !');";
            echo "window.location='/UrByD/staff/supplier_edit.php?supplier_id=$supplier_id';";
            echo "</script>";
		    exit();
        }
        if(trim($supplier_address) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ ที่อยู่ !');";
            echo "window.location='/UrByD/staff/supplier_edit.php?supplier_id=$supplier_id';";
            echo "</script>";
		    exit();
        }
        if(trim($supplier_telephone) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ เบอร์ติดต่อ !');";
            echo "window.location='/UrByD/staff/supplier_edit.php?supplier_id=$supplier_id';";
            echo "</script>";
		    exit();
        }


         $sql = "UPDATE aby_supplier SET
			        supplier_name = '".$supplier_name."' 
                    , supplier_address = '".$supplier_address."' 
                    , supplier_telephone = '".$supplier_telephone."'
			        WHERE supplier_id = '".$supplier_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                 echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/supplier.php';</script>";
            }
        


    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_supplier"){
        $supplier_id = $_GET["supplier_id"];


        $strSQL = "SELECT * FROM aby_supplier WHERE supplier_id = '".$supplier_id."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);

	    if($objResult == 0){
            echo "<script>";
            echo "alert('ไม่พอข้อมูล !');";
            echo "window.location='/UrByD/staff/supplier.php';";
            echo "</script>";
	    }else{
            $sql = "DELETE FROM aby_supplier
			    WHERE supplier_id = '".$supplier_id."' ";
            $query = mysqli_query($conn,$sql);
	        if($query){
                echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/supplier.php';</script>";
	        }else{
			    echo "<script>";
                echo "alert('ไม่สามารถลบข้อมูลได้ !');";
                echo "window.location='/UrByD/staff/supplier.php';";
                echo "</script>";
	        }
    }
    



    }
}
?>