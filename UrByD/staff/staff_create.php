<?php 
include('header.php');
include('..\global_service\connectdb.php');

$code = "US";//query MAX ID
$strSQL = "SELECT MAX(staff_id) AS staff_id FROM aby_staff";
$executeQry = mysqli_query($conn,$strSQL);
$rs = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
$maxId = substr($rs['staff_id'], -4);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
$maxId = ($maxId+1);
$maxId = substr("0000".$maxId, -4);
$staff_id = $code.$maxId;



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
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มพนักงาน</li>
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
                  <h3 class="mb-0">เพิ่มพนักงาน </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-create-staff" class="form-horizontal" method="POST" action="\UrByD/service/staff_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" >รหัสพนักงาน</label>
                        <input type="text" class="form-control" name="staff_id" value="<?php echo $staff_id; ?>" readonly/>
                        <br>

                        <label class="form-control-label" >สิทธิ์เข้าใช้งาน</label>
                        <select name="role_id" class="form-control">
                                <option value='2'>พนักงานใช้ระบบ</opton>
                                <option value='4'>พนักงานทั่วไป</opton>
                        </select>
                        <br>

                        <label class="form-control-label" >คำนำหน้าชื่อ</label>
                        <select name="prefix_id" class="form-control">
                            <?php
                            ini_set('display_errors', 1);
                            error_reporting(~0);

                            $strsql = "SELECT * FROM aby_prefix ORDER BY prefix_id ASC";
                            $result2 = mysqli_query($conn, $strsql) or die ("Error in query: $strsql " . mysqli_error());

                            while($rs = mysqli_fetch_array($result2)){?>
                                <option value='<?php echo $rs['prefix_id'];?>'><?php echo $rs['prefix_name'];?> </opton>
                            <?php } ?>
                        </select>
                        <br>

                        <label class="form-control-label" for="input-username">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" name="staff_name" 
                                        onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"/>
                        <br>

                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >ชื่อผู้ใช้งาน</label>
                                    <input type="text"  class="form-control" name="username" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >รหัสผ่าน</label>
                                    <input type="password"  class="form-control" name="password" >
                                </div>
                            </div>
                        </div>
                        <br>


                        <label class="form-control-label" for="input-username">ที่อยู่</label>
                            <textarea type="text" rows="4" class="form-control" name="staff_address" ></textarea> 
                        <br>

                        <label class="form-control-label" for="input-username">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="staff_telephone"/>
                        
                        





                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="action" value="create_staff"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลพนักงาน หรือไม่')" href="javascript:$('#form-create-staff').submit();">บันทึก</a>
                    
                        <a href="staff.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>