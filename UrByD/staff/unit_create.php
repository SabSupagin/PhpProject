<?php 
include('header.php');
include('..\global_service\connectdb.php');

?>

<!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">หน่วยนับ</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="unit.php">หน่วยนับ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มหน่วยนับ</li>
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
                  <h3 class="mb-0">เพิ่มหน่วยนับ </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-create-unit" class="form-horizontal" method="POST" action="\UrByD/service/unit_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">หน่วยนับ</label>
                        <input type="text" class="form-control" name="unit_name" 
                                        onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value='';}"/>
                      </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="action" value="create_unit"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลหน่วยนับ หรือไม่')" href="javascript:$('#form-create-unit').submit();">บันทึก</a>
                    
                        <a href="unit.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>