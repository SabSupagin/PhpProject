<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["supplier_id"])){
    $strID = $_GET["supplier_id"];
}


$sql = "SELECT * FROM aby_supplier WHERE supplier_id = '".$strID."' ";
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
              <h6 class="h2 text-white d-inline-block mb-0">บริษัทตัวแทนจำหน่าย</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="supplier.php">บริษัทตัวแทนจำหน่าย</a></li>
                  <li class="breadcrumb-item active" aria-current="page">รายละเอียดบริษัทตัวแทนจำหน่าย</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">รายละเอียดบริษัทตัวแทนจำหน่าย </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-edit-supplier" class="form-horizontal" method="POST" action="\UrByD/service/supplier_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">รหัสบริษัทตัวแทนจำหน่าย</label>
                            <input type="text" class="form-control" value="<?php echo $result['supplier_id']; ?>" readonly/>

                        <label class="form-control-label" for="input-username">บริษัทตัวแทนจำหน่าย</label>
                            <input type="text" class="form-control" value="<?php echo $result['supplier_name']; ?>" readonly/>

                        <label class="form-control-label" for="input-username">ที่อยู่</label>
                            <textarea type="text" rows="4" class="form-control" readonly ><?php echo $result['supplier_address']; ?>
                            </textarea> 

                        <label class="form-control-label" for="input-username">เบอร์ติดต่อ</label>
                            <input type="text" class="form-control" value="<?php echo $result['supplier_telephone']; ?>" readonly/>
                    
                        
                      </div>
                    </div>
                  </div>
                    <!--
                  <div>
                        <input type="hidden" name="supplier_id" value="<?php echo $result['supplier_id']; ?>"/>
                        <input type="hidden" name="action" value="edit_supplier"/>
                  </div>
                       -->
                    <div class="panel-footer">
                        <a href="supplier.php" class="btn btn-danger">กลับ</a> 
                    </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>