<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["category_id"])){
    $strID = $_GET["category_id"];
}


$sql = "SELECT * FROM aby_category WHERE category_id = '".$strID."' ";
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
              <h6 class="h2 text-white d-inline-block mb-0">ประเภทสินค้า</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="category.php">ประเภทสินค้า</a></li>
                  <li class="breadcrumb-item active" aria-current="page">แก้ไขประเภทสินค้า</li>
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
                  <h3 class="mb-0">แก้ไขประเภทสินค้า </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-edit-category" class="form-horizontal" method="POST" action="\UrByD/service/category_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">ประเภทสินค้า</label>
                        <input type="text" class="form-control" name="category_name" value="<?php echo $result['category_name']; ?>"
                                        onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"/>
                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="category_id" value="<?php echo $result['category_id']; ?>"/>
                        <input type="hidden" name="action" value="edit_category"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการแก้ไขข้อมูลประเภทสินค้า หรือไม่')" href="javascript:$('#form-edit-category').submit();">บันทึก</a>
                    
                        <a href="category.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>