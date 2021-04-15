<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["prefix_id"])){
    $strID = $_GET["prefix_id"];
}


$sql = "SELECT * FROM aby_prefix WHERE prefix_id = '".$strID."' ";
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
              <h6 class="h2 text-white d-inline-block mb-0">คำนำหน้าชื่อ</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="prefix.php">คำนำหน้าชื่อ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">แก้ไขคำนำหน้าชื่อ</li>
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
                  <h3 class="mb-0">แก้ไขคำนำหน้าชื่อ </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-edit-prefix" class="form-horizontal" method="POST" action="\UrByD/service/prefix_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">คำนำหน้าชื่อ</label>
                        <input type="text" class="form-control" name="prefix_name" value="<?php echo $result['prefix_name']; ?>"
                                        onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"/>
                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="prefix_id" value="<?php echo $result['prefix_id']; ?>"/>
                        <input type="hidden" name="action" value="edit_prefix"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการแก้ไขข้อมูลคำนำหน้าชื่อ หรือไม่')" href="javascript:$('#form-edit-prefix').submit();">บันทึก</a>
                    
                        <a href="prefix.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>