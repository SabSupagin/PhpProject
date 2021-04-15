<?php 
include('header.php');
include('..\global_service\connectdb.php');

$sql = "SELECT * FROM aby_prefix ORDER BY prefix_id DESC ";
$query = mysqli_query($conn,$sql);

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
              <h6 class="h2 text-white d-inline-block mb-0">คำนำหน้าชื่อ</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">คำนำหน้าชื่อ</li>
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
                  <h3 class="mb-0">ตารางคำนำหน้าชื่อ</h3>
                </div>
                <div class="col text-right">
                  <a href="prefix_create.php" class="btn btn-primary">เพิ่มคำนำหน้าชื่อ</a>
                </div>
              </div>
            </div>

            <div class="card-header border-0">
              <!-- <h3 class="mb-0">ตารางคำนำหน้าชื่อ</h3> -->
              <input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
            </div>
            

            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="name mb-0 text-sm text-center" >ลำดับ</th>
                    <th class="name mb-0 text-sm text-center" >คำนำหน้าชื่อ</th>
                    <th class="name mb-0 text-sm text-center" >การดำเนินการ</th>
                  </tr>
                </thead>

                <tbody id="myTable" >
                <?php
                    $item = 1;
                    while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center text-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php echo $item;?></span>
                        </div>
                      </div>
                    </th>

                    <td class="budget">
                        <?php echo $result["prefix_name"];?>
                    </td>

                    <td class="budget text-center">
                        <a  href="prefix_edit.php?prefix_id=<?php echo $result["prefix_id"] ?>" class="btn btn-info">
                        <i class="ni ni-scissors"> แก้ไข</i>
                        </a>
                      
                        <a href="JavaScript:if(confirm('คุณต้องการลบ <?php echo $result["prefix_name"];?> หรือไม่')==true){window.location='/\UrByD/service/prefix_service.php?action=delete_prefix&prefix_id=<?php echo $result["prefix_id"] ?>';}" class="btn btn-danger" ><i class="fa fa-minus-circle"> ลบ</i></a>
                    
                    </td>
                    
                  </tr>
                  
                  
                <?php
                  $item++;
                    }
                ?>
                </tbody>
              </table>
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