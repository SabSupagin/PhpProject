<?php 
include('header.php');
include('..\global_service\connectdb.php');

$strID = null;

if(isset($_GET["product_id"])){
    $strID = $_GET["product_id"];
}


//$sql = "SELECT * FROM aby_product WHERE product_id = '".$strID."' ";

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
                  <li class="breadcrumb-item active" aria-current="page">แก้ไขสินค้า</li>
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
                  <h3 class="mb-0">แก้ไขสินค้า </h3>
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
                        <input type="text" class="form-control" name="product_name" value="<?php echo $result['product_name']; ?>"/>
                        <br>

                        <label class="form-control-label" for="input-username">คำอธิบายสินค้า</label>
                            <textarea type="text" rows="4" class="form-control" name="product_description"><?php echo $result['product_description']; ?></textarea> 
                        <br>

                        <label class="form-control-label" >ประเภทสินค้า</label>
                        <select name="category_id" class="form-control">
                        <option value='<?php echo $result['category_id'];?>'><?php echo $result["category_name"];?> </opton>
                            <?php
                            ini_set('display_errors', 1);
                            error_reporting(~0);

                            $strsql = "SELECT * FROM aby_category ORDER BY category_id ASC";
                            $result2 = mysqli_query($conn, $strsql) or die ("Error in query: $strsql " . mysqli_error());

                            while($rs = mysqli_fetch_array($result2)){?>
                                <option value='<?php echo $rs['category_id'];?>'><?php echo $rs['category_name'];?> </opton>
                            <?php } ?>
                        </select>

                        <br>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >ราคาทุน(บาท)</label>
                                    <input type="number"  class="form-control text-right" name="product_cost" value="<?php echo $result['product_cost']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">ราคาขาย(บาท)</label>
                                    <input type="number" id="input-country" class="form-control text-right" name="product_price"  value="<?php echo $result['product_price']; ?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >สต็อก(จำนวน)</label>
                                    <input type="number"  class="form-control text-right" name="product_stock" value="<?php echo $result['product_stock']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">หน่วยนับ</label>
                                    <select name="unit_id" class="form-control">
                                    <option value='<?php echo $result['unit_id'];?>'><?php echo $result["unit_name"];?> </opton>
                                        <?php
                                        ini_set('display_errors', 1);
                                        error_reporting(~0);

                                        $strsql = "SELECT * FROM aby_unit ORDER BY unit_id ASC";
                                        $result2 = mysqli_query($conn, $strsql) or die ("Error in query: $strsql " . mysqli_error());
                                        
                                        ini_set('display_errors', 1);
                                        error_reporting(~0);

                                        while($rs = mysqli_fetch_array($result2)){
                                        ?>
                                            <option value='<?php echo $rs['unit_id'];?>'><?php echo $rs['unit_name'];?> </opton>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <br>

                      <fieldset id="thumbnail">
                        
                        </legend>
                          <label class="form-control-label" >รูป</label><br>
                          <img src="\UrByD/product_image/<?php echo $result['product_img'] ?>" width="200"  height="200">
                          <input type="file" name="image1"  required="required" />
                          <input type="hidden" name="hdnOldFile" value="<?php echo $result['product_img']; ?> " >
                        <br>

                      </fieldset>



                      
                        </div>
                    </div>
                  </div>

                  <div>
                        <input type="hidden" name="product_id" value="<?php echo $result['product_id']; ?>"/>
                        <input type="hidden" name="action" value="edit_product"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการแก้ไขข้อมูลสินค้า หรือไม่')" href="javascript:$('#form-edit-product').submit();">บันทึก</a>
                    
                        <a href="product.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php');?>

      <script>
    $(document).ready(function(){
        function BindDeleteThumbNailBtn(){
            $('.btn-delete-thumbnail').unbind('click');
            $('.btn-delete-thumbnail').click(function(){
                $(this).parents('.form-group').remove();
                return false;
            })
        }
        BindDeleteThumbNailBtn();
        $('#btn-add-thumbnail').click(function () {
            var thumbnail_cnt = $('input[name^=thumbnail]').length + 1;
            $('#thumbnail').append(' <div class="form-group">' +
            '<label  class="col-md-2 control-label">รูป : </label>' +
            '<div class="col-md-3">' +
            '<div class="fileinput fileinput-new" data-provides="fileinput">' +
            '<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">' +
            '<img src="../assets/images/no-img.png" alt=""/>' +
            '</div>' +
            '<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">' +
            '</div>' +
            '<div>' +
            '<span class="btn btn-default btn-file">' +
            '<span class="fileinput-new">เลือกรูป </span>' +
            '<span class="fileinput-exists">แก้ไข </span>' +
            '<input type="file" name="thumbnail-' + thumbnail_cnt + '" />' +
            '</span>' +
            //'<a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">ลบ </a>' +
            '<a href="javascript:;" class="btn btn-danger fileinput-exists btn-delete-thumbnail" data-dismiss="fileinput">ลบ </a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
            BindDeleteThumbNailBtn();
            return false;
        });
    });
</script>