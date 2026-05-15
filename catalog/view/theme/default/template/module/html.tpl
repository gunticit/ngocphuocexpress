<div class="list-group">
	<div class="content-html">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<?php if($heading_title) { ?>

					<h2 class=""><span><?php echo $heading_title; ?></span></h2>

					<?php } ?>

					<div class="bg-white-html ">

						<?php echo $html; ?>

					</div>

				</div>
				<div class="col-sm-6 item-img-html1">
					<div><img src="<?= $background ?>" alt=""></div>
				</div>
				<div class="col-sm-6 item-img-html2">
					<div><img src="<?= $background2 ?>" alt=""></div>
				</div>
			</div>

		</div>

	</div>

	<div class="module-tslc">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 text-center">
					<img src="image/icon-1.png" alt="">
					<?= $config_tamnhin; ?>
				</div>
				<div class="col-sm-4 text-center">
					<img src="image/icon-2.png" alt="">
					<?= $config_sumenh; ?>
				</div>
				<div class="col-sm-4 text-center">
					<img src="image/icon-3.png" alt="">
					<?= $config_gtcl; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(!empty($img_setting)){ ?> 

<section id="sec-bestmoments" style="background:url('<?= $img_setting; ?>') #C49A6C;background-position:center;background-size: cover;"><h3></h3></section>

<?php } ?>
<style>
	.item-img-html1{
		padding-right: 7.5px;
	}
	.item-img-html2{
		padding-left: 7.5px;
	}
	.item-img-html1>div,.item-img-html2 >div{
		overflow: hidden;
	}
	.item-img-html1 img,.item-img-html2 img{
		width: 100%;
		transition: all ease .4s;
	}
	.item-img-html1:hover img,.item-img-html2:hover img{
		transform: scale(1.1);
	}
	.content-html {
		background: url('image/line-pattern.png');
		padding: 50px 0 50px;
		position: relative
	}
	.content-html:before{
		content: '';
		background-color: rgba(255, 255, 255, 0.82);
		z-index:1;
		top: 0;
		left: 0;
		display: inline-block;
		width: 100%;
		height: 100%;
		position: absolute;
	}
	.content-html h2 span{
		position: relative;
	}
	.content-html h2 span:after{
		content: '';
		background: url(image/line-pattern-copy-150x11.png);
		width: 70px;
		height: 5px;
		background-size: 100%;
		position: absolute;
		bottom: -15px;
		left: 50%;
		transform: translateX(-50%);
	}
	.content-html .container{
		position: relative;
		z-index: 1;
	}
	.content-html h2{
		text-align: center;
		padding-bottom: 20px;
		margin-bottom: 20px;
	}
	.content-html h2 span{
		font-size: 24px;
		color: #000;
		text-align: center;
	}
	.content-html .bg-white-html p{
		margin-bottom: 10px;
	}
	@media(max-width: 768px){
		.item-img-html1{
			padding-right: 15px;
		}
		.item-img-html2{
			padding-left: 15px;
		}
	}
</style>