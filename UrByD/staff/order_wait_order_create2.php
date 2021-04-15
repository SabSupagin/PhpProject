<?php
ob_start();
session_start();


if(!isset($_SESSION["intLine"]))
{
	if(isset($_POST["product_id"]))
	{
		 $_SESSION["intLine"] = 0;
		 $_SESSION["strProduct_id"][0] = $_POST["product_id"];
         $_SESSION["strQty"][0] = $_POST["Qty"];
         
		 header("location:order_wait_order_create3.php");
	}
}
else
{

	$key = array_search($_POST["product_id"], $_SESSION["strProduct_id"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + $_POST["Qty"];
	}
	else
	{

		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProduct_id"][$intNewLine] = $_POST["product_id"];
		 $_SESSION["strQty"][$intNewLine] = $_POST["Qty"];

	}

	 header("location:order_wait_order_create3.php");

}
?>

<?php /* This code download from www.ThaiCreate.Com */ ?>
