<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');
define ('SITE_ROOT', realpath(dirname(__DIR__)));

function GetImagePath($prefix,$fileKey){
    $imgName = uniqid($prefix);
    $ext = pathinfo($_FILES[$fileKey]["name"], PATHINFO_EXTENSION);
    $result = array();
    $result['imgPath'] = SITE_ROOT."\\product_image\\".$imgName.".".$ext;
    return $result;
}




if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_POST["action"];
    if($action == "create_product"){


        $img = GetImagePath('product_','image1');
        $thumbnailImagePath = array();
        if(move_uploaded_file($_FILES["image1"]["tmp_name"], $img['imgPath'])){

            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_description = $_POST['product_description'];
            $category_id = $_POST['category_id'];
            //$supplier_id = $_POST['supplier_id'];
            $product_cost = $_POST['product_cost'];
            $product_price = $_POST['product_price'];
            $product_stock = $_POST['product_stock'];
            $unit_id = $_POST['unit_id'];
            //$product_img = $img['imgPath'];
            $product_img = basename($img['imgPath']);

            $sql = "INSERT INTO aby_product
                   (product_id,product_name,product_description,category_id
                    ,product_cost,product_price,product_stock,unit_id,product_img) 
                    VALUES 
                    ('".$product_id."','".$product_name."','".$product_description."','".$category_id."'
                    ,'".$product_cost."','".$product_price."','".$product_stock."','".$unit_id."','".$product_img."') ";

            $query = mysqli_query($conn,$sql);

            if($query) {
                echo "<script>alert('สร้างข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/product.php';</script>";
            }



        }

    }

    else if($action == "edit_product"){ //แก้ไข

        $image1 = $_POST['image1'];//อัพใหม่
        $image2 = $_POST['hdnOldFile']; //เก่า

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category_id = $_POST['category_id'];
        //$supplier_id = $_POST['supplier_id'];
        $product_cost = $_POST['product_cost'];
        $product_price = $_POST['product_price'];
        $product_stock = $_POST['product_stock'];
        $unit_id = $_POST['unit_id'];

       

        if(trim($image1) == "")
	    {
            //echo "บันทึกเก่า";
            $sql = "UPDATE aby_product SET
			        product_name = '".$product_name."' 
                    ,product_description = '".$product_description."' 
                    ,category_id = '".$category_id."'
                    ,product_cost = '".$product_cost."'
                    ,product_price = '".$product_price."'
                    ,product_stock = '".$product_stock."'
                    ,unit_id = '".$unit_id."'
                    ,product_img = '".$image2."'
			        WHERE product_id = '".$product_id."' ";

	        $query = mysqli_query($conn,$sql);

	        if($query) {
                echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/product.php';</script>";
	        }
            
        }
        else{
            //echo "บันทึกใหม่";
            $sql = "UPDATE aby_product SET
            product_name = '".$product_name."' 
            ,product_description = '".$product_description."' 
            ,category_id = '".$category_id."'
            ,product_cost = '".$product_cost."'
            ,product_price = '".$product_price."'
            ,product_stock = '".$product_stock."'
            ,unit_id = '".$unit_id."'
            ,product_img = '".$image1."'
            WHERE product_id = '".$product_id."' ";

    $query = mysqli_query($conn,$sql);

    if($query) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/product.php';</script>";
    }
           
		
	
            
            
        }


    }

}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET["action"];
    if($action == "delete_product"){
        $product_id = $_GET["product_id"];

        $sql = "DELETE FROM aby_product
			    WHERE product_id = '".$product_id."' ";

	    $query = mysqli_query($conn,$sql);

	    if(mysqli_affected_rows($conn)) {
            echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');location='/UrByD/staff/product.php';</script>";
	    }

    }
}
?>