<?php echo $header; ?>
<section class="header-breadcrumb" style="background-image: url(http://carpenter.weblusive-themes.com/wp-content/uploads/2016/04/banner.jpg)">
  
  <div class="container">
    <div class="row m0 page-cover">
      <h2 class="page-cover-tittle">
      <?php echo $heading_title; ?>
      </h2>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>        
    </div>
    </div>
  </section>
<div class="container">
	<div class="row">
		<?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
			<?php $class = 'col-sm-6'; ?>
			<?php } elseif ($column_left || $column_right) { ?>
			<?php $class = 'col-sm-9'; ?>
			<?php } else { ?>
			<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>">

			<?php echo $content_top; ?>
			<div class="box_gallery">
				<div class="list_gallery">
					<?php foreach ($gallerys as $gallery) { ?>
						<div class="col-sm-6 item-lb">
							<div class="item-gallery">
								<div class="image">
									<a href="<?php echo $gallery['href'];?>">
										<img src="<?php echo $gallery['thumb'];?>" alt="<?php echo $gallery['name'];?>" title="<?php echo $gallery['name'];?>">
									</a>
								</div>
								<div class="caption">
									<div class="name">
										<a class="apopup" href="<?php echo $gallery['href'];?>">
											<h2><?php echo $gallery['name'];?></h2>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="pana"><?php echo $pagination; ?></div>
			</div>
			<?php echo $content_bottom; ?>
		</div>
		<?php echo $column_right; ?>
	</div>
</div>

<?php echo $footer; ?>
