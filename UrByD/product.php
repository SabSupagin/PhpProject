<?php 
include('header2.php');
include('.\global_service\connectdb.php');

$sql = "SELECT * FROM aby_category ORDER BY category_id DESC";
$query = mysqli_query($conn,$sql);

$sql2 = "SELECT p.*,c.category_name ,un.unit_name
        FROM aby_product p
        INNER JOIN aby_category c on c.category_id = p.category_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id  ";

$query2 = mysqli_query($conn,$sql2);

?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col">
				<p class="bread"><span><a href="home.php">หน้าหลัก</a></span> / <span>สินค้า</span></p>
			</div>
		</div>
	</div>
</div>

<div class="breadcrumbs-two">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="breadcrumbs-img" style="background-image: url(images/9.jpg);">
					<h2>สินค้า</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-xl-3">
						<div class="row">
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>ประเภทสินค้า</h3>
									<ul>
										<li>
											<a href="product.php">
												ทั้งหมด
											</a>
										</li>
									<?php
                    					while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                					?>
										<li>
											<a href="product_category_detail.php?category_id=<?php echo $result["category_id"] ?>">
												<?php echo $result["category_name"] ?>
											</a>
										</li>
									<?php
                    					}
                					?>
									</ul>
								</div>
							</div>
						</div>
                    </div>
                    
                    <!--  ข้าง -->
					<div class="col-lg-9 col-xl-9">
						<div class="row row-pb-md">
						<?php
                    				while($result2=mysqli_fetch_array($query2,MYSQLI_ASSOC)){
                				?>
							<div class="col-lg-4 mb-4 text-center">
								<div class="product-entry border">
									<a href="#" class="prod-img">
										<img src="\UrByD/product_image/<?php echo $result2['product_img'] ?>" width="200"  height="200">
									</a>
									<div class="desc">
										<h2><a href="#"><?php echo $result2['product_name']; ?></a></h2>
										<span class="price"><?php echo $result2['product_price']; ?> บาท</span>
									</div>
								</div>
							</div>
							<?php
                    			}
                			?>
							<div class="w-100"></div>

						</div>
					</div>
				</div>
			</div>
		</div>






<?php include('footer.php');?>