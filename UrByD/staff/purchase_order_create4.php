<?php
ob_start();
session_start();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProduct_id"][$i] != "")
	  {
			$_SESSION["strQty"][$i] = $_POST["Qty".$i];
	  }
  }

	header("location:purchase_order_create3.php");

?>

<?php /* This code download from www.ThaiCreate.Com */ ?>
