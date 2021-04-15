<?php 
include('header.php');
include('..\global_service\connectdb.php');

//$sql = "SELECT * FROM aby_product ORDER BY product_id DESC ";

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
            

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">เพิ่มการสั่งซื้อสินค้า</h3>
                </div>
                <div class="col text-right">
                    <a class="btn btn-info" href="purchase_order_create1.php">เลือกสินค้าเพิ่ม</a>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
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
                    <th class="name mb-0 text-sm text-center" >สต็อก(จำนวน)</th>
                    <th class="name mb-0 text-sm text-center">หน่วยนับ</th>
                    <th class="name mb-0 text-sm text-center">จำนวน</th>
                    <th class="name mb-0 text-sm text-center">ราคารวม(บาท)</th>
                    <th class="name mb-0 text-sm text-center">การดำเนินการ</th>
                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    $Total = 0;
                    $SumTotal = 0;

                    for($i=0;$i<=(int)$_SESSION["intLine"];$i++){
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
                    <td class="budget text-center"><?php echo number_format($result['product_stock'],0); ?></td>
                    <td class="budget text-center"><?php echo $result["unit_name"];?></td>

                    <td width="90">
                        <input type="number" class="form-control" name="Qty<?php echo $i;?>" value="<?php echo $_SESSION["strQty"][$i];?>" size="2" style="text-align: center;" min="1" >
                    </td>

                    <td class="budget text-right"><?php echo number_format($Total,2);?></td>
		            <td class="budget text-center">
                        <a href="<?php echo STAFF_URL ?>purchase_order_create6.php?Line=<?php echo $i ?>" class="btn btn-danger"><i class="fa fa-trash-o"> ลบ</i></a>
                    </td>

	                </form>
                    
                  </tr>
                <?php
                    }
                }
                ?>
                </tbody>
                
              </table>
              <h4 class="budget text-right" >รวมทั้งหมด <?php echo number_format($SumTotal,2);?> บาท</h4>
            </form>

            <form action="purchase_order_create5.php" method="post">
            <a class="btn btn-warning" href="javascript:$('#form-create-unit').submit();">คำนวนราคาใหม่</a>
                <button class="btn btn-success " >สั่งซื้อสินค้า</button>
            </form>


            <?php
	            if($SumTotal > 0)
	            {
            ?>
            <?php
	            }
            ?>

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