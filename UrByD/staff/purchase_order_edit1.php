<?php 
include('header.php');
include('..\global_service\connectdb.php');

//$sql = "SELECT * FROM aby_product ORDER BY product_id DESC ";

$staff_name = $_SESSION['authen']['staff_name'] ;
$staff_id = $_SESSION['authen']['staff_id'] ;

$sql = "SELECT * FROM aby_staff WHERE staff_id = '$staff_id' ";
$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);

$strID = null;

if(isset($_GET["po_id"])){
    $strID = $_GET["po_id"];
}

$sql = "SELECT p.*,c.supplier_name
        FROM aby_purchase_order p
        INNER JOIN aby_supplier c on c.supplier_id = p.supplier_id
        WHERE po_id = '".$strID."' ";


$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);

$po_id = $result["po_id"];

$sql3 = "SELECT p.*
        ,c.product_id ,c.product_price ,c.product_qty
        ,s.product_name ,s.product_stock
        ,f.category_name
        ,u.unit_name
        FROM `aby_purchase_order` p
        INNER JOIN `aby_purchase_order_detail` c on c.po_id = p.po_id
        INNER JOIN `aby_product` s on s.product_id = c.product_id
        INNER JOIN `aby_category` f on f.category_id = s.category_id
        INNER JOIN `aby_unit` u on u.unit_id = s.unit_id
        WHERE p.po_id = '".$strID."' ";
        
$query3 = mysqli_query($conn,$sql3);


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
                  <li class="breadcrumb-item active" aria-current="page">แก้ไขการสั่งซื้อสินค้า</li>
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
            

            <div class="card-header border-0">
            <form id="form-confirm-purchase" class="form-horizontal" method="POST" action="\UrByD/service/purchase_service.php">
              <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">แก้ไขการสั่งซื้อสินค้า <?php echo $po_id; ?> </h3>
                  <input class="form-control" type="hidden" name="po_id" value="<?php echo $po_id; ?>" required>
                </div>
                <!--
                <div class="col text-right">
                    <a class="btn btn-info" href="purchase_order_create1.php">เลือกสินค้าเพิ่ม</a>
                </div>
                -->
              </div>
              <br>

            <div class="form-group">
                <label  class="col-md-2 control-label">พนักงาน  </label>
                <div class="col-md-10">
                    <input class="form-control" type="hidden" name="staff_id" value="<?php echo $staff_id; ?>" required>
                    <h3><?php echo $staff_name ?></h3>
                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label" >บริษัทตัวแทนจำหน่าย</label>
                <div class="col-md-10">
                    <input class="form-control" type="hidden" name="supplier_id" value="<?php echo $result["supplier_id"]; ?>" required>
                    <h3><?php echo $result["supplier_name"]; ?></h3>
                </div>
            </div>

            </div>

            

            <!-- Light table -->
            <div class="table-responsive">
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
                    while($rt=mysqli_fetch_array($query3,MYSQLI_ASSOC)){
                    $Total = $rt["product_qty"]*$rt["product_price"];
                    $SumTotal = $SumTotal + $Total;
                    
                    
	            ?>
                  <tr>
                    <td class="budget text-center"><?php echo $rt["product_id"];?></td>
                        <input type="hidden" name="product_ids[]" value="<?php echo $rt['product_id'] ?>" >
                    <td class="budget text-left"><?php echo $rt["product_name"];?></td>
                    <td class="budget text-left"><?php echo $rt["category_name"];?></td> 
                    <td class="budget text-right"><?php echo $rt["product_price"];?></td> 
                    <td class="budget text-center"><?php echo $rt["product_stock"];?></td> 
                    <td class="budget text-center"><?php echo $rt["unit_name"];?></td>
                    <!--<td width="90">
                      <input type="number" class="form-control" name="product_qty" value="<?php echo $rt["product_qty"];?>" 
                            size="2" style="text-align: center;" min="0" >
                    </td> -->
                    <td width="100">
                        <input type="number" class="form-control" name="product_qty[]" value="<?php echo $rt['product_qty'] ?>" 
                                size="2" />
                        <input type="hidden" name="product_qty2[]" value="<?php echo $rt['product_qty'] ?>" />
                    </td>
                    <td class="budget text-right"><?php echo number_format($Total,2);?></td>
	              
                    
                  </tr>
                <?php
                    
                }
                ?>
                </tbody>
                
              </table>
              <h4 class="budget text-right" >รวมทั้งหมด <?php echo number_format($SumTotal,2);?> บาท</h4>

                <input type="hidden" name="po_id" value="<?php echo $po_id ?>" />
                <input type="hidden" name="action" value="confirm_edit"/>

                <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการแก้ไขการสั่งซื้อสินค้า หรือไม่')" href="javascript:$('#form-confirm-purchase').submit();">บันทึก</a>
                    
                        <a href="purchase_order.php" class="btn btn-danger">ยกเลิก</a>
                </div>

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