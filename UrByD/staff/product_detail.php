<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["product_id"])){
    $strID = $_GET["product_id"];
}


$sql = "SELECT p.*,c.category_name ,un.unit_name
        FROM aby_product p
        INNER JOIN aby_category c on c.category_id = p.category_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id
        WHERE product_id = '".$strID."' ";

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
              <h6 class="h2 text-white d-inline-block mb-0">สินค้า</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="product.php">สินค้า</a></li>
                  <li class="breadcrumb-item active" aria-current="page">รายละเอียดสินค้า</li>
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
                  <h3 class="mb-0">รายละเอียดสินค้า </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-edit-product" class="form-horizontal" method="POST" action="\UrByD/service/product_service.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">รหัสสินค้า</label>
                        <input type="text" class="form-control" name="product_id" value="<?php echo $result['product_id']; ?>" readonly/>
                        <br>

                        <label class="form-control-label" >ชื่อสินค้า</label>
                        <input type="text" class="form-control" name="product_name" value="<?php echo $result['product_name']; ?>"readonly/>
                        <br>

                        <label class="form-control-label" for="input-username">คำอธิบายสินค้า</label>
                            <textarea type="text" rows="4" class="form-control" name="product_description"readonly><?php echo $result['product_description']; ?></textarea> 
                        <br>

                        <label class="form-control-label" >ประเภทสินค้า</label>
                        <input type="text" class="form-control" value="<?php echo $result["category_name"];?>"readonly/>
                        <br>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >ราคาทุน(บาท)</label>
                                    <input type="number"  class="form-control text-right" name="product_cost" value="<?php echo $result['product_cost']; ?>"readonly/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">ราคาขาย(บาท)</label>
                                    <input type="number" id="input-country" class="form-control text-right" name="product_price"  value="<?php echo $result['product_price']; ?>"readonly/>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >สต็อก(จำนวน)</label>
                                    <input type="number"  class="form-control text-right" name="product_stock" value="<?php echo $result['product_stock']; ?>"readonly/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">หน่วยนับ</label>
                                    <input type="text" class="form-control" value="<?php echo $result["unit_name"];?>" readonly/>

                                </div>
                            </div>
                        </div>
                        <br>

                        <fieldset id="thumbnail">
                        
                        </legend>
                          <label class="form-control-label" >รูป</label><br>
                          <img src="\UrByD/product_image/<?php echo $result['product_img'] ?>" width="200"  height="200">
                          
                        <br>

                      </fieldset>
                    
                        
                      </div>
                    </div>
                  </div>
                    <div class="panel-footer">
                        <a href="product.php" class="btn btn-danger">กลับ</a> 
                    </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>