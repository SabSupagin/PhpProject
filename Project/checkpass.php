<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<?php

require('connect/connectdb.php');

$user = $_GET["user"];
$password = $_GET["password"];
if($user == "Supagin" && $password == 12345){
    header("location:shop.php");
}
else{
    echo "alert('คุณใส่ Username หรือ Password ไม่ถูกต้อง!');";
    header("location:login.php");
}
?>