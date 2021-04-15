<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_prefix"){
        //if($prefix->Create($_POST['name'])){
        //    echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='".STAFF_URL."prefix.php';</script>";
        //}

        $prefix_name = $_POST['prefix_name'];

        if(trim($prefix_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ คำนำหน้าชื่อ !');";
            echo "window.location='/UrByD/staff/prefix_create.php';";
            echo "</script>";
		    exit();
        }
        
        $strSQL = "SELECT * FROM aby_prefix WHERE prefix_name = '".$prefix_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='/UrByD/staff/prefix_create.php';";
                echo "</script>";
        }
        else
        {
            $sql = "INSERT INTO aby_prefix (prefix_name) VALUES ('".$prefix_name."') ";
            $query = mysqli_query($conn,$sql);
            if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/prefix.php';</script>";
            }
        }





    }
    else if($action == "edit_prefix"){ //แก้ไข

        $prefix_id = $_POST['prefix_id'];
        $prefix_name = $_POST['prefix_name'];

        if(trim($prefix_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ คำนำหน้าชื่อ !');";
            echo "window.location='/UrByD/staff/prefix_edit.php?prefix_id=$prefix_id';";
            echo "</script>";
		    exit();
        }

        $strSQL = "SELECT * FROM aby_prefix WHERE prefix_name = '".$prefix_name."' ";
        $executeQry = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
        if($objResult)
        {
            echo "<script>";
            echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
            echo "window.location='/UrByD/staff/prefix_edit.php?prefix_id=$prefix_id';";
            echo "</script>";
        }
        else
        {
            $sql = "UPDATE aby_prefix SET
			        prefix_name = '".$prefix_name."'
			        WHERE prefix_id = '".$prefix_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/prefix.php';</script>";
	        }
        }




    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_prefix"){
        $prefix_id = $_GET["prefix_id"];

    $strSQL = "SELECT * FROM aby_prefix WHERE prefix_id = '".$prefix_id."' ";
    $executeQry = mysqli_query($conn,$strSQL);
    $objResult = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);

	if($objResult == 0){
        echo "<script>";
        echo "alert('ไม่พอข้อมูล !');";
        echo "window.location='/UrByD/staff/prefix.php';";
        echo "</script>";
	}else{
    $sql = "DELETE FROM aby_prefix
            WHERE prefix_id = '".$prefix_id."' ";
    $query = mysqli_query($conn,$sql);
	    if($query){
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/prefix.php';</script>";
	    }else{
			echo "<script>";
            echo "alert('ไม่สามารถลบข้อมูลได้ !');";
            echo "window.location='/UrByD/staff/prefix.php';";
            echo "</script>";
	    }
	}

        




    }
}
?>