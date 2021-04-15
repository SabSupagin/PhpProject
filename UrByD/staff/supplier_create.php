<?php 
include('header.php');
include('..\global_service\connectdb.php');

$code = "SU";//query MAX ID
$strSQL = "SELECT MAX(supplier_id) AS supplier_id FROM aby_supplier";
$executeQry = mysqli_query($conn,$strSQL);
$rs = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
$maxId = substr($rs['supplier_id'], -4);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
$maxId = ($maxId+1);
$maxId = substr("0000".$maxId, -4);
$supplier_id = $code.$maxId;
                   

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
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มบริษัทตัวแทนจำหน่าย</li>
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
                  <h3 class="mb-0">เพิ่มบริษัทตัวแทนจำหน่าย </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-create-supplier" class="form-horizontal" method="POST" action="\UrByD/service/supplier_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">

                        <label class="form-control-label" for="input-username">รหัสบริษัทตัวแทนจำหน่าย</label>
                        <input type="text" class="form-control" name="supplier_id" value="<?php echo $supplier_id; ?>" readonly/>
                        <br>

                        <label class="form-control-label" for="input-username">บริษัทตัวแทนจำหน่าย</label>
                        <input type="text" class="form-control" name="supplier_name" 
                                        onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"/>

                        <br>

                        <label class="form-control-label" for="input-username">ที่อยู่</label>
                            <textarea type="text" rows="4" class="form-control" name="supplier_address" ></textarea> 
                        <br>

                        <label class="form-control-label" for="input-username">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="supplier_telephone"/>
                      

                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="action" value="create_supplier"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลบริษัทตัวแทนจำหน่าย หรือไม่')" href="javascript:$('#form-create-supplier').submit();">บันทึก</a>
                    
                        <a href="supplier.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>