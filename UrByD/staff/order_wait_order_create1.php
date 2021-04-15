<?php 
include('header.php');
include('..\global_service\connectdb.php');

//$sql = "SELECT * FROM aby_product ORDER BY product_id DESC ";

$sql = "SELECT p.*,c.category_name ,un.unit_name
        FROM aby_product p
        INNER JOIN aby_category c on c.category_id = p.category_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id";

$query = mysqli_query($conn,$sql);

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
              <h6 class="h2 text-white d-inline-block mb-0">การขายสินค้า</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="order_wait_for_payment.php">การขายสินค้า</a></li>
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มการขายสินค้า</li>
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
                  <h3 class="mb-0">เพิ่มการขายสินค้า</h3>
                </div>
                <div class="col text-right">
                  <a href="order_wait_order_create3.php" class="btn btn-warning">รายการ</a>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
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
                    <th class="name mb-0 text-sm text-center" >สต็อก(จำนวน)</th>
                    <th class="name mb-0 text-sm text-center">หน่วยนับ</th>
                    <th class="name mb-0 text-sm text-center">จำนวน</th>
                    <th class="name mb-0 text-sm text-center">การดำเนินการ</th>
                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                ?>
                  <tr>
                  <form action="order_wait_order_create2.php" method="post">
                    <td class="budget text-center"><?php echo $result["product_id"] ?>
                      <input type="hidden" name="product_id" value="<?php echo $result["product_id"];?>" >
                    </td>

                    <td class="budget text-left"><?php echo $result["product_name"];?></td>
                    <td class="budget text-center"><?php echo $result["category_name"];?></td>
                    <td class="budget text-right"><?php echo number_format($result['product_price'],2); ?></td>
                    <td class="budget text-center"><?php echo number_format($result['product_stock'],0); ?></td>
                    <td class="budget text-center"><?php echo $result["unit_name"];?></td>

                    <td width="90">
                      <input type="number" class="form-control" name="Qty" value="1" size="2" style="text-align: center;" min="1" 
                      max="<?php echo $result["product_stock"];?>" >
                    </td>

                    <td  class="budget text-center"><input type="submit" value="เพิ่ม" class="btn btn-info"></td>
	                </form>
                    
                  </tr>
                <?php
                    }
                ?>
                </tbody>
              </table>
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