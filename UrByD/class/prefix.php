<?php

$serverName	  = "localhost";
$userName	  = "root";
$userPassword	  = "12345678";
$dbName	  = "ur";

$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($conn, 'utf8');

if (mysqli_connect_errno())
{
    echo "Database Connect Failed : " . mysqli_connect_error();
    exit();
}


class prefix {

    public function Edit($prefix_id,$prefix_name){ //แก้ไข

        if(trim($prefix_name) == "")
	    {
            echo "<script>";
            echo "alert('กรุณาใส่ คำนำหน้าชื่อ !');";
            echo "window.location='".STAFF_URL."prefix_edit.php?prefix_id=$prefix_id';";
            echo "</script>";
		    exit();
	    }
     
            $strSQL = "SELECT * FROM aby_prefix WHERE prefix_name = '".$prefix_name."' ";
            $objQuery = mysqli_query($conn,$strSQL);
    	$objResult = mysqli_fetch_array($objQuery);

            
            if($objResult)
            {
                echo "<script>";
                echo "alert('ข้อมูลซ้ำ กรุณาลองใหม่อีกครั้ง !');";
                echo "window.location='".STAFF_URL."prefix_edit.php?prefix_id=$prefix_id';";
                echo "</script>";
            }
            else
            {
                $sql = "UPDATE aby_prefix
                    SET prefix_name = '$prefix_name' 
                    WHERE prefix_id = $prefix_id ";
                $executeQry = mysqli_query($conn,$sql) or die(mysqli_error());
                if($executeQry)
                    return true;
                else
                    return false;
            }

    }


}