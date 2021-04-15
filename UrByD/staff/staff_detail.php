<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["staff_id"])){
    $strID = $_GET["staff_id"];
}



//$sql = "SELECT p.*,r.role_name,u.prefix_name,us.name
//        FROM aby_staff p
//        INNER JOIN aby_role r on r.role_id = p.role_id
//        INNER JOIN aby_prefix u on u.prefix_id = p.prefix_id
//        INNER JOIN aby_user_status u on u.us_id = p.us_id
//       WHERE p.staff_id = '".$strID."' ";

$sql = "SELECT p.*,r.name,o.role_name,u.prefix_name
        FROM aby_staff p
        INNER JOIN aby_user_status r on r.us_id = p.us_id
        INNER JOIN aby_role o on o.role_id = p.role_id
        INNER JOIN aby_prefix u on u.prefix_id = p.prefix_id
        WHERE p.staff_id = '".$strID."' ";

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
              <h6 class="h2 text-white d-inline-block mb-0">พนักงาน</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="staff.php">พนักงาน</a></li>
                  <li class="breadcrumb-item active" aria-current="page">รายละเอียดพนักงาน</li>
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
                  <h3 class="mb-0">รายละเอียดพนักงาน <?php echo $strID; ?> </h3>
                </div>
              </div>
            <div class="card-body">

                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >สิทธิ์เข้าใช้งาน</label>
                                    <input type="text"  class="form-control" name="username" value="<?php echo $result['role_name']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >สถานะ</label>
                                    <input type="text"  class="form-control" name="name" value="<?php echo $result['name']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <br>

                        <label class="form-control-label" >คำนำหน้าชื่อ</label>
                        <input type="text" class="form-control" value="<?php echo $result['prefix_name']; ?>" readonly/>
                        <br>

                        <label class="form-control-label" >ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" value="<?php echo $result['staff_name']; ?>" readonly/>
                        <br>

                        <label class="form-control-label" >ชื่อผู้ใช้งาน</label>
                        <input type="text" class="form-control" value="<?php echo $result['username']; ?>" readonly/>
                        <br>

                        <label class="form-control-label" for="input-username">ที่อยู่</label>
                            <textarea type="text" rows="4" class="form-control" name="staff_address" readonly ><?php echo $result['staff_address']; ?></textarea> 
                        <br>

                        <label class="form-control-label" for="input-username">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="staff_telephone" value="<?php echo $result['staff_telephone']; ?>" readonly/>
                      



                        
                      </div>
                    </div>
                  </div>
                    <div class="panel-footer">
                        <a href="staff.php" class="btn btn-danger">กลับ</a> 
                    </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>