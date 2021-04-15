<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_unit"){

        $unit_name = $_POST['unit_name'];

        if(trim($unit_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ หน่วยนับ !');";
            echo "window.location='/UrByD/staff/unit_create.php';";
            echo "</script>";
		    exit();
        }

        
        
        $strSQL = "SELECT * FROM aby_unit WHERE unit_name = '".$unit_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='/UrByD/staff/unit_create.php';";
                echo "</script>";
        }
        else
        {
            $sql = "INSERT INTO aby_unit (unit_name) VALUES ('".$unit_name."') ";
            $query = mysqli_query($conn,$sql);
            if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/unit.php';</script>";
            }
        }



    }
    else if($action == "edit_unit"){ //แก้ไข

        $unit_id = $_POST['unit_id'];
        $unit_name = $_POST['unit_name'];

        if(trim($unit_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ คำนำหน้าชื่อ !');";
            echo "window.location='/UrByD/staff/unit_edit.php?unit_id=$unit_id';";
            echo "</script>";
		    exit();
        }

        
        $strSQL = "SELECT * FROM aby_unit WHERE unit_name = '".$unit_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
            echo "<script>";
            echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
            echo "window.location='/UrByD/staff/unit_edit.php?unit_id=$unit_id';";
            echo "</script>";
        }
        else
        {
            $sql = "UPDATE aby_unit SET
			        unit_name = '".$unit_name."'
			        WHERE unit_id = '".$unit_id."' ";
            $query = mysqli_query($conn,$sql);
            if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/unit.php';</script>";
            }
        }


    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_unit"){
        $unit_id = $_GET["unit_id"];


        $strSQL = "SELECT * FROM aby_unit WHERE unit_id = '".$unit_id."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);

	    if($objResult == 0){
            echo "<script>";
            echo "alert('ไม่พอข้อมูล !');";
            echo "window.location='/UrByD/staff/unit.php';";
            echo "</script>";
	    }else{
            $sql = "DELETE FROM aby_unit
			        WHERE unit_id = '".$unit_id."' ";
            $query = mysqli_query($conn,$sql);
	        if($query){
                echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/unit.php';</script>";
	        }else{
			    echo "<script>";
                echo "alert('ไม่สามารถลบข้อมูลได้ !');";
                echo "window.location='/UrByD/staff/unit.php';";
                echo "</script>";
	        }
	    }



    }
}
?>