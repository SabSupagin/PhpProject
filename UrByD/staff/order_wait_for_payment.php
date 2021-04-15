<?php 
include('header.php');
include('..\global_service\connectdb.php');



$sql = "SELECT p.*,c.staff_name ,s.ord_name
        FROM aby_order p
        INNER JOIN aby_staff c on c.staff_id = p.staff_id
        INNER JOIN aby_order_status s on s.ord_id = p.ord_id
        ORDER BY order_id DESC";

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
                  <li class="breadcrumb-item active" aria-current="page">การขายสินค้า</li>
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
                  <h3 class="mb-0">ตารางการขายสินค้า</h3>
                </div>
                <div class="col text-right">
                  <a href="order_wait_order_create1.php" class="btn btn-primary">เพิ่มการขายสินค้า</a>
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
                    <!-- <th class="name mb-0 text-sm text-center" >ลำดับ</th> -->
                    <th class="name mb-0 text-sm text-center" >รหัส</th>
                    <th class="name mb-0 text-sm text-center" >ราคารวม(บาท)</th>
                    <th class="name mb-0 text-sm text-center" >ส่วนลด(บาท)</th>
                    <th class="name mb-0 text-sm text-center" >วันที่ขายสินค้า</th>
                    <th class="name mb-0 text-sm text-center" >การดำเนินการ</th>
                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    $item = 1;
                    while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                ?>
                  <tr>
                      <!-- 
                    <th scope="row">
                      <div class="media align-items-center text-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php echo $item; ?></span>
                        </div>
                      </div>
                    </th> -->

                    <td class="budget text-center">
                        <?php echo $result["order_id"];?>
                    </td>
                    <td class="budget text-right"><?php echo number_format($result['order_sum_price'],2); ?></td>
                    <td class="budget text-right">
                        <?php echo number_format($result['order_discount'],2); ?>
                    </td>
                    <td class="budget text-center">
                        <?php echo $result["order_createddate"];?>
                    </td>


                    <td class="budget text-center">
                        <a  href="order_wait_order_detail.php?order_id=<?php echo $result["order_id"] ?>" class="btn btn-dark">
                        <i class="ni ni-single-copy-04"> รายละเอียด</i>
                        </a>


                        <?php if($result['ord_id'] == 1){ ?>
                            <a href="order_wait_order_edit.php?order_id=<?php echo $result["order_id"] ?>" class="btn btn-info"><i class="ni ni-scissors"> ชำระเงิน</i></a>
                        
                        <?php } ?>

                    </td>
                    
                  </tr>
                  
                  
                <?php
                    $item++;
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