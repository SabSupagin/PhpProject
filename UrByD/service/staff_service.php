<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_staff"){

        $staff_id = $_POST['staff_id'];
        $prefix_id = $_POST['prefix_id'];
        $staff_name = $_POST['staff_name'];
        $username = $_POST['username'];
        $password = MD5($_POST['password']);
        $staff_address= $_POST['staff_address'];
        $staff_telephone = $_POST['staff_telephone'];
        $role_id = $_POST['role_id'];

        if($role_id == 2){
            $sql = "INSERT INTO aby_staff (staff_id,prefix_id,staff_name,username,password,staff_address,staff_telephone,role_id,us_id) 
                    VALUES ('".$staff_id."','".$prefix_id."','".$staff_name."','".$username."'
                    ,'".$password."','".$staff_address."','".$staff_telephone."','".$role_id."',1) ";
	        $query = mysqli_query($conn,$sql);
	        if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
	        }
        }
        elseif($role_id == 4){
            $sql = "INSERT INTO aby_staff (staff_id,prefix_id,staff_name,username,password,staff_address,staff_telephone,role_id,us_id) 
                    VALUES ('".$staff_id."','".$prefix_id."','".$staff_name."','".$username."'
                    ,'".$password."','".$staff_address."','".$staff_telephone."','".$role_id."',2) ";
	        $query = mysqli_query($conn,$sql);
	        if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
	        }
        }else {
            echo "<script>alert('เกิดข้อผิดพลาด');location='/UrByD/staff/staff.php';</script>";
        }


    }
    else if($action == "edit_staff"){ //แก้ไข

        $staff_id = $_POST['staff_id'];
        $prefix_id = $_POST['prefix_id'];
        $staff_name = $_POST['staff_name'];
        $username = $_POST['username'];
        $password = MD5($_POST['password']);
        $staff_address= $_POST['staff_address'];
        $staff_telephone = $_POST['staff_telephone'];
        $role_id = $_POST['role_id'];

        if($password == ""){ //ไม่ได้แก้ไขรหัส
            $sql = "UPDATE aby_staff SET
			        prefix_id = '".$prefix_id."'
                    ,staff_name = '".$staff_name."'
                    ,username = '".$username."'
                    ,staff_address = '".$staff_address."'
                    ,staff_telephone = '".$staff_telephone."'
                    ,role_id = '".$role_id."'
			        WHERE staff_id = '".$staff_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
            }
        }else {
            $sql = "UPDATE aby_staff SET
			        prefix_id = '".$prefix_id."'
                    ,staff_name = '".$staff_name."'
                    ,username = '".$username."'
                    ,staff_address = '".$staff_address."'
                    ,staff_telephone = '".$staff_telephone."'
                    ,role_id = '".$role_id."'
                    ,password = '".$password."'
			        WHERE staff_id = '".$staff_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
            }
        }
    }

    else if($action == "edit_staff_us"){ //แก้ไข

        $staff_id = $_POST['staff_id'];
        $us_id = $_POST['us_id'];

        $sql = "UPDATE aby_staff SET
			        us_id = '".$us_id."'
			        WHERE staff_id = '".$staff_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
            }

        
    }


}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_staff"){
   
        $staff_id = $_GET["staff_id"];

        $sql = "DELETE FROM aby_staff
			    WHERE staff_id = '".$staff_id."' ";

	    $query = mysqli_query($conn,$sql);

	    if(mysqli_affected_rows($conn)) {
            //header("location:prefixs.php");
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/staff.php';</script>";
	    }

    }
}
?>