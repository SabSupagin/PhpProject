<?php
	ob_start();
	session_start();


	$Line = $_GET["Line"];
	$_SESSION["strProduct_id"][$Line] = "";
	$_SESSION["strQty"][$Line] = "";

	header("location:purchase_order_create3.php");
?>
