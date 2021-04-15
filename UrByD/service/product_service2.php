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

}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $img = GetImagePath('product_','image1');
    


}
?>