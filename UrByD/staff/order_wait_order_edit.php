<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["order_id"])){
    $strID = $_GET["order_id"];
}



$sql = "SELECT p.*,r.ord_name
        FROM aby_order p
        INNER JOIN aby_order_status r on r.ord_id = p.ord_id
        WHERE p.order_id = '".$strID."' ";

$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);


?>

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
    <form id="form-edit-staff" class="form-horizontal" method="POST" action="\UrByD/service/order_service.php">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">รายละเอียดการขายสินค้า <?php echo $strID; ?></h3>
                  <input class="form-control" type="hidden" name="order_id" value="<?php echo $strID; ?>" required>
                </div>
              </div>
            <div class="card-body">

            
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">

                        <label class="form-control-label" >ชำระเงิน</label>
                        <select name="ord_id" class="form-control">
                        <option value='<?php echo $result['ord_id'];?>'><?php echo $result["ord_name"];?> </opton>
                        <option value='1'>ยังไม่จ่ายเงิน</opton>
                        <option value='2'>จ่ายเงิน</opton>
                        </select>
                        <br>

                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="order_id" value="<?php echo $result['order_id']; ?>"/>
                        <input type="hidden" name="action" value="edit_order"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการแก้ไขข้อมูลพนักงาน หรือไม่')" href="javascript:$('#form-edit-staff').submit();">บันทึก</a>
                    
                        <a href="order_wait_for_payment.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>