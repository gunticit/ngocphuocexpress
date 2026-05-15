<div class="product-thumb">

	<div class="image">

		<div class="border-img">

			<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>

		</div>

	</div>

	<div class="caption">

		<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
		<?php if(!empty($product['viewed'])){ ?> 
		<div class="view-pro text-center">
			<i class="fa fa-bar-chart" aria-hidden="true"></i><span> Lượt xem <?= $product['viewed']; ?></span>
		</div>
		<?php } ?>
		<div class="descr-pro">
			<p>Khởi hành từ: <span><?= $product['sku']; ?></span></p>
			<p>Điểm đến: <span><?= $product['upc']; ?></span></p>
<?php if($product['location']) { ?> 


 

            <p>Đặt vé: <a href="tel:<?= $product['location']; ?>"><?= $product['location']; ?></a></p>

               <?php } ?>

                 <?php if($product['mpn']){ ?> 
           	<p>Đặt vé: <a href="tel:<?= $product['mpn']; ?>"><?= $product['mpn']; ?></a></p>
            <?php } ?>


			
		</div>
	</div>

</div>

