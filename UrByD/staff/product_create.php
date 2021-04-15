<?php 
include('header.php');
include('..\global_service\connectdb.php');

$code = "PR";//query MAX ID
$strSQL = "SELECT MAX(product_id) AS product_id FROM aby_product";
$executeQry = mysqli_query($conn,$strSQL);
$rs = mysqli_fetch_array($executeQry,MYSQLI_ASSOC);
$maxId = substr($rs['product_id'], -4);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
$maxId = ($maxId+1);
$maxId = substr("0000".$maxId, -4);
$product_id = $code.$maxId;
                   

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
                  <li class="breadcrumb-item active" aria-current="page">เพิ่มสินค้า</li>
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
                  <h3 class="mb-0">เพิ่มสินค้า </h3>
                </div>
              </div>
            <div class="card-body">

            <form id="form-create-product" class="form-horizontal" method="POST" action="\UrByD/service/product_service.php" enctype="multipart/form-data">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">

                        <label class="form-control-label" >รหัสสินค้า</label>
                        <input type="text" class="form-control" name="product_id" value="<?php echo $product_id; ?>" readonly/>
                        <br>

                        <label class="form-control-label" >ชื่อสินค้า</label>
                        <input type="text" class="form-control" name="product_name" />
                        <br>

                        <label class="form-control-label" for="input-username">คำอธิบายสินค้า</label>
                            <textarea type="text" rows="4" class="form-control" name="product_description" ></textarea> 
                        <br>

                        
                        <label class="form-control-label" >ประเภทสินค้า</label>
                        <!-- <input type="text" class="form-control" name="category_id"/> -->
                        <select name="category_id" class="form-control">
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

                        <!--
                        <label class="form-control-label" >บริษัทตัวแทนจำหน่าย</label>
                        <select name="supplier_id" class="form-control">
                            <?php
                            ini_set('display_errors', 1);
                            error_reporting(~0);

                            $strsql = "SELECT * FROM aby_supplier ORDER BY supplier_id ASC";
                            $result2 = mysqli_query($conn, $strsql) or die ("Error in query: $strsql " . mysqli_error());

                            while($rs = mysqli_fetch_array($result2)){?>
                                <option value='<?php echo $rs['supplier_id'];?>'><?php echo $rs['supplier_name'];?> </opton>
                            <?php } ?>
                        </select>

                        <br> -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >ราคาทุน(บาท)</label>
                                    <input type="number"  class="form-control text-right" name="product_cost" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">ราคาขาย(บาท)</label>
                                    <input type="number" id="input-country" class="form-control text-right" name="product_price"  >
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" >สต็อก(จำนวน)</label>
                                    <input type="number"  class="form-control text-right" name="product_stock" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">หน่วยนับ</label>
                                    <!-- <input type="text"  class="form-control" name="unit_id" > -->
                                    <select name="unit_id" class="form-control">
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
                          <label class="form-control-label" >รูป</label>
                          <input type="file" name="image1"  required="required"/>
                        <br>

                      </fieldset>


                        
                        
                      </div>
                    </div>
                    
                  </div>

                  <div>
                        <input type="hidden" name="action" value="create_product"/>
                  </div>

                    <div class="panel-footer">
                        <a class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลสินค้า หรือไม่')" href="javascript:$('#form-create-product').submit();">บันทึก</a>
                    
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
            '<div class="col-md-3">' +
            //'<a class="glyphicon glyphicon-remove-circle text-danger btn-delete-thumbnail"></a>' +
            '</div>' +
            '</div>');
            BindDeleteThumbNailBtn();
            return false;
        });
    });
</script>