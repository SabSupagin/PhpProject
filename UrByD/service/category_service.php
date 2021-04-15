<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_category"){
        $category_name = $_POST['category_name'];

        if(trim($category_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ ประเภทสินค้า !');";
            echo "window.location='/UrByD/staff/category_create.php';";
            echo "</script>";
		    exit();
        }


        $strSQL = "SELECT * FROM aby_category WHERE category_name = '".$category_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='/UrByD/staff/category_create.php';";
                echo "</script>";
        }
        else
        {
            $sql = "INSERT INTO aby_category (category_name) VALUES ('".$category_name."') ";
            $query = mysqli_query($conn,$sql);
            if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/category.php';</script>";
            }
        }



    }
    else if($action == "edit_category"){ //แก้ไข

        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        if(trim($category_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ คำนำหน้าชื่อ !');";
            echo "window.location='/UrByD/staff/category_edit.php?category_id=$category_id';";
            echo "</script>";
		    exit();
        }



        $strSQL = "SELECT * FROM aby_category WHERE category_name = '".$category_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
            {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='/UrByD/staff/category_edit.php?category_id=$category_id';";
                echo "</script>";
            }
        else{
            $sql = "UPDATE aby_category 
                    SET category_name = '".$category_name."'
			        WHERE category_id = '".$category_id."' ";
            $query = mysqli_query($conn,$sql);
            if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/category.php';</script>";
            }   
        }


    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_category"){
        $category_id = $_GET["category_id"];


        $strSQL = "SELECT * FROM aby_category WHERE category_id = '".$category_id."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);

	    if($objResult == 0){
            echo "<script>";
            echo "alert('ไม่พอข้อมูล !');";
            echo "window.location='/UrByD/staff/category.php';";
            echo "</script>";
	    }else{
            $sql = "DELETE FROM aby_category
			        WHERE category_id = '".$category_id."' ";
            $query = mysqli_query($conn,$sql);
	        if($query){
                echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/category.php';</script>";
	        }else{
			    echo "<script>";
                echo "alert('ไม่สามารถลบข้อมูลได้ !');";
                echo "window.location='/UrByD/staff/category.php';";
                echo "</script>";
	        }
	    }





    }
}
?>