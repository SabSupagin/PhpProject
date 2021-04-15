<?php 
include('header.php');
include('.\global_service\connectdb.php');

$sql2 = "SELECT p.*,c.category_name ,un.unit_name
        FROM aby_product p
        INNER JOIN aby_category c on c.category_id = p.category_id
        INNER JOIN aby_unit un on un.unit_id = p.unit_id  ";

$query2 = mysqli_query($conn,$sql2);

?>

<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/หลัง2.jpg);">
			   		
			   	</li>
			   	<li style="background-image: url(images/หลัง.jpg);">
			   		
			   	</li>
			   	<li style="background-image: url(images/มายหลัง.jpg);">

				</li>

				<li style="background-image: url(images/ช้างหลัง.jpg);">
			   		
			   	</li>

				<li style="background-image: url(images/ไฮเนหลัง.jpg);">
			   		
			   	</li>

				<li style="background-image: url(images/2.jpg);">
			   		
			   	</li>
			  	</ul>
		  	</div>
</aside>

<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2> สิ น ค้ า ทั้ ง ห ม ด </h2>
					</div>
				</div>
				<div class="row row-pb-md">
					<?php
                    	while($result2=mysqli_fetch_array($query2,MYSQLI_ASSOC)){
                	?>
					<div class="col-lg-3 mb-4 text-center">
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
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p><a href="product.php" class="btn btn-primary btn-lg">สินค้า</a></p>
					</div>
				</div>
			</div>
		</div>



<?php include('footer.php');?>