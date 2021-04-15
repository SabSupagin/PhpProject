<?php 
include('header.php');
include('..\global_service\connectdb.php');

$sql = "SELECT COUNT(product_id) AS totalmember FROM aby_product ";
$query = mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);
$num1 = $result["totalmember"];

$sql2 = "SELECT COUNT(staff_id) AS totalmember FROM aby_staff ";
$query2 = mysqli_query($conn,$sql2);
$result2=mysqli_fetch_array($query2,MYSQLI_ASSOC);
$num2 = $result2["totalmember"];




?>

 <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">หน้าหลัก</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">

            <div class="col-xl-6 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">สินค้า</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $num1 ?> รายการ</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">พนักงาน</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $num2 ?> คน</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
      

<?php include('footer.php');?>