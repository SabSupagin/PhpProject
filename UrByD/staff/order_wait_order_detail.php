<?php 
include('header.php');
include('..\global_service\connectdb.php');

//$sql = "SELECT * FROM aby_product ORDER BY product_id DESC ";

$strID = null;

if(isset($_GET["order_id"])){
    $strID = $_GET["order_id"];
}

$sql = "SELECT p.*
        ,c.order_detail_price ,c.order_detail_qty
        ,un.unit_name
        FROM aby_product p
        INNER JOIN aby_order_detail c on c.product_id = p.product_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id
        WHERE order_id = '".$strID."'";

$query = mysqli_query($conn,$sql);

$staff_name = $_SESSION['authen']['staff_name'] ;
$staff_id = $_SESSION['authen']['staff_id'] ;

$sql3 = "SELECT p.* 
        ,m.prefix_name
        FROM aby_staff p
        INNER JOIN aby_prefix m on m.prefix_id = p.prefix_id
        WHERE p.staff_id = '".$staff_id."'";
$query3 = mysqli_query($conn,$sql3);
$result3=mysqli_fetch_array($query3,MYSQLI_ASSOC);

$sql2 = "SELECT p.* 
        ,m.ord_name 
        FROM aby_order p
        INNER JOIN aby_order_status m on m.ord_id = p.ord_id
        WHERE p.order_id = '".$strID."'";
$query2 = mysqli_query($conn,$sql2);
$result2=mysqli_fetch_array($query2,MYSQLI_ASSOC);

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
                  <li class="breadcrumb-item active" aria-current="page">รายละเอียดการขายสินค้า</li>
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
                  <h3 class="mb-0">รายละเอียดการขายสินค้า <?php echo $strID; ?></h3>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">โต๊ะ </h3><?php echo $result2["order_seat"]; ?>  
                </div>
                <div class="col">
                  <h3 class="mb-0">สถาณะการชำระเงิน  </h3><?php echo $result2["ord_name"]; ?>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col"> 
                  <h3 class="mb-0">พนักงาน </h3><?php echo $result3["prefix_name"]; ?> <?php echo $staff_name; ?>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">วันที่ขายสินค้า </h3><?php echo $result2["order_createddate"]; ?>
                </div>
              </div>
            </div>

            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="name mb-0 text-sm text-center" >ลำดับ</th>
                    <th class="name mb-0 text-sm text-center" >ชื่อสินค้า</th>
                    <th class="name mb-0 text-sm text-center">ราคา(บาท)</th>
                    <th class="name mb-0 text-sm text-center">จำนวนสั่ง</th>
                    <th class="name mb-0 text-sm text-center" >หน่วยนับ</th>
                    <th class="name mb-0 text-sm text-center">ราคารวม(บาท)</th>
                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    $item = 1;
                    $Total = 0;
                    $SumTotal = 0;
                    while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                      $Total = $result["order_detail_qty"]*$result["order_detail_price"];
                      $SumTotal = $SumTotal + $Total;
                ?>
                  <tr>
                      
                    <th scope="row">
                      <div class="media align-items-center text-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php echo $item; ?></span>
                        </div>
                      </div>
                    </th> 

                    <td class="budget ">
                        <?php echo $result["product_id"];?> <?php echo $result["product_name"];?>
                    </td>
                    <td class="budget text-right">
                        <?php echo number_format($result["order_detail_price"],2); ?>
                    </td>
                    <td class="budget text-center">
                        <?php echo $result["order_detail_qty"];?>
                    </td>
                    <td class="budget text-center">
                        <?php echo $result["unit_name"];?>
                    </td>
                    <td class="budget text-right">
                        <?php echo number_format($Total,2); ?>
                    </td>
                    
                  </tr>
                  
                  
                <?php
                    $item++;
                    }
                ?>
                </tbody>
              </table>
              <h4 class="budget text-right" >รวม<?php echo number_format($SumTotal,2);?> บาท</h4>
              <h4 class="budget text-right" >ส่วนลด <?php echo number_format($result2["order_discount"],2);?> บาท</h4> 
              <h4 class="budget text-right" >รวมทั้งหมด <?php echo number_format($result2["order_sum_price"],2);?> บาท</h4>
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