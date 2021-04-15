<?php 
include('header.php');
include('..\global_service\connectdb.php');

//$sql = "SELECT * FROM aby_product ORDER BY product_id DESC ";

$staff_name = $_SESSION['authen']['staff_name'] ;
$staff_id = $_SESSION['authen']['staff_id'] ;

$sql = "SELECT * FROM aby_staff WHERE staff_id = '$staff_id' ";
$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);


$staff_id= $result["staff_id"]; 

$code = "HT";//query MAX ID
$strSQL = "SELECT MAX(po_id) AS po_id FROM aby_purchase_order";
$executeQry = mysqli_query($conn,$strSQL);
$rs = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
$maxId = substr($rs['po_id'], -4);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
$maxId = ($maxId+1);

$maxId = substr("0000".$maxId, -4);
$po_id = $code.$maxId;


?>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

<!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">การสั่งซื้อสินค้า</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="purchase_order.php">การสั่งซื้อสินค้า</a></li>
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มการสั่งซื้อสินค้า</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
            <!-- Card header -->
            
            <form id="form-create-unit" name="form1" method="post" action="save_purchase_order_create.php">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">เพิ่มการสั่งซื้อสินค้า <?php echo $po_id; ?> </h3>
                  <input class="form-control" type="hidden" name="po_id" value="<?php echo $po_id; ?>" required>
                </div>
                <div class="col text-right">
                    <a class="btn btn-info" href="purchase_order_create1.php">เลือกสินค้าเพิ่ม</a>
                </div>
              </div>
            </div>

            <div class="form-group">
                <label  class="col-md-2 control-label">พนักงาน  </label>
                <div class="col-md-10">
                    <input class="form-control" type="hidden" name="staff_id" value="<?php echo $staff_id; ?>" required>
                    <h3><?php echo $staff_name ?></h3>
                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label" >บริษัทตัวแทนจำหน่าย</label>
                <select name="supplier_id" class="form-control">
                    <?php
                        ini_set('display_errors', 1);
                        error_reporting(~0);

                        $strsql = "SELECT * FROM aby_supplier ORDER BY supplier_id ASC";
                        $result2 = mysqli_query($conn, $strsql) or die ("Error in query: $strsql " . mysqli_error());

                        while($rs = mysqli_fetch_array($result2)){?>
                            <option value='<?php echo $rs['supplier_id'];?>'><?php echo $rs['supplier_name'];?> </opton>
                        <?php } ?>
                </select>
            </div>
            

            <!-- Light table -->
            <div class="table-responsive">
            <form id="form-create-unit" action="purchase_order_create4.php" method="post">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="name mb-0 text-sm text-center">รหัส</th>
                    <th class="name mb-0 text-sm text-center">ชื่อสินค้า</th>
                    <th class="name mb-0 text-sm text-center">ประเภทสินค้า</th>
                    <th class="name mb-0 text-sm text-center">ราคา(บาท)</th>
                    <th class="name mb-0 text-sm text-center">สต็อก(จำนวน)</th>
                    <th class="name mb-0 text-sm text-center">หน่วยนับ</th>
                    <th class="name mb-0 text-sm text-center">จำนวน</th>
                    <th class="name mb-0 text-sm text-center">ราคารวม(บาท)</th>

                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    $Total = 0;
                    $SumTotal = 0;

                    for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                    {
	                    if($_SESSION["strProduct_id"][$i] != "")
	                    {
                            $sql = "SELECT p.*,c.category_name ,un.unit_name
                                    FROM aby_product p
                                    INNER JOIN aby_category c on c.category_id = p.category_id
                                    INNER JOIN aby_unit un on un.unit_id = p.unit_id
                                    WHERE product_id = '".$_SESSION["strProduct_id"][$i]."' ";

                            $query = mysqli_query($conn,$sql);
                            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
        
		                    $Total = $_SESSION["strQty"][$i] * $result["product_cost"];
		                    $SumTotal = $SumTotal + $Total;
	            ?>
                  <tr>

                    <td class="budget text-center"><?php echo $result["product_id"];?></td>
                    <td class="budget text-left"><?php echo $result["product_name"];?></td>
                        <input type="hidden" name="product_id<?php echo $i;?>" value="<?php echo $_SESSION["strProduct_id"][$i];?>">
  	                </td>
                    <td class="budget text-center"><?php echo $result["category_name"];?></td>
                    <td class="budget text-right"><?php echo number_format($result['product_cost'],2); ?></td>
                    <td class="budget text-right"><?php echo number_format($result['product_stock'],0); ?></td>
                    <td class="budget text-center"><?php echo $result["unit_name"];?></td>
                    <td class="text-center">
                        <input class="form-control" type="hidden" name="Qty<?php echo $i;?>" 
                                value="<?php echo $_SESSION["strQty"][$i];?>" required>
                                <?php echo $_SESSION["strQty"][$i];?>
                    </td>
                    <td class="budget text-right"><?php echo number_format($Total,2);?></td>
                    
                  </tr>
                <?php
                    }
                }
                ?>
                </tbody>
                
            </table>
                <h4 class="text-right" >รวมทั้งหมด <?php echo number_format($SumTotal,2);?> บาท</h4>

                <a class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกรายการสั่งซื้อ หรือไม่')" href="javascript:$('#form-create-unit').submit();">บันทึก</a>
        
            </form>
            </div>
            <!-- Card footer -->
            
            <div class="card-footer py-4">
              <!--
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
              -->
            </div>
          </div>
        </div>
      </div>
      

      <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<?php include('footer.php');?>