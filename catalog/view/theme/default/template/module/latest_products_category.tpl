<?php if ($products && !$subcats) { ?>

<div class="box-title">
  <h3>
    <a class="viewall" href="<?php echo $category_url; ?>"><?php echo $heading_title; ?></a>
  </h3>
</div>
<div class="owl-carousel latest_category_carousel">
  <?php foreach ($products as $product) { ?>
  <?php include($product_item); ?>
  <?php } ?>
</div>
<?php if (isset($banner_bottom1['thumb'])) { ?>
<?php if ($banner_bottom1['scale'] == '50%') { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-12'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
  <div class="row">
    <?php if (!empty($banner_bottom1['link'])) { ?>
    <div class="image"><a href="<?php echo $banner_bottom1['link']; ?>"><img src="<?php echo $banner_bottom1['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>
    <?php } else { ?>
    <div class="image"><img src="<?php echo $banner_bottom1['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
    <?php } ?>
  </div>
</div>
<?php } ?>
<?php if (isset($banner_bottom2['thumb'])) { ?>
<?php if ($banner_bottom2['scale'] == '50%') { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-12'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
  <div class="row">
    <?php if (!empty($banner_bottom2['link'])) { ?>
    <div class="image"><a href="<?php echo $banner_bottom2['link']; ?>"><img src="<?php echo $banner_bottom2['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>
    <?php } else { ?>
    <div class="image"><img src="<?php echo $banner_bottom2['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
    <?php } ?>
  </div>
</div>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".owl-carousel.latest_category_carousel").owlCarousel({
		itemsCustom : [[320, 1],[500, 2],[768, 3],[992, 4],[1199, 5]],											   
		lazyLoad : true,
		navigation : true,
		navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		scrollPerPage : true
    }); 
		});
</script>
<?php } elseif ($subcats) { ?>
<div class="category-module" id="latest_category<?php echo $module; ?>">
  <div class="box-title">
    <h3>
      <a class="viewall" href="<?php echo $category_url; ?>"><?php echo $heading_title; ?></a>
    </h3>
  </div>
  <div class="category-module-content">
    <ul id="sub-cat<?php echo $module; ?>" class="tabs">
      <?php foreach ($subcats as $subcat) { ?>
      <?php if (count($subcat['subproducts']) > $pmin) { ?>
      <li><a href="#tab-cat<?php echo $subcat['id']; ?>-<?php echo $module; ?>"><?php echo $subcat['name']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php foreach ($subcats as $subcat) { ?>
    <?php if (count($subcat['subproducts']) > $pmin) { ?>
    <div id="tab-cat<?php echo $subcat['id']; ?>-<?php echo $module; ?>" class="tab_content">
      <div class="owl-carousel latest_category_tabs">
        <?php foreach ($subcat['subproducts'] as $product) { ?>
        <?php include($product_item); ?>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
</div>
<?php if (isset($banner_bottom1['thumb'])) { ?>
<?php if ($banner_bottom1['scale'] == '50%') { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-12'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
  <div class="row">
    <?php if (!empty($banner_bottom1['link'])) { ?>
    <div class="image"><a href="<?php echo $banner_bottom1['link']; ?>"><img src="<?php echo $banner_bottom1['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>
    <?php } else { ?>
    <div class="image"><img src="<?php echo $banner_bottom1['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
    <?php } ?>
  </div>
</div>
<?php } ?>
<?php if (isset($banner_bottom2['thumb'])) { ?>
<?php if ($banner_bottom2['scale'] == '50%') { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-12'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
  <div class="row">
    <?php if (!empty($banner_bottom2['link'])) { ?>
    <div class="image"><a href="<?php echo $banner_bottom2['link']; ?>"><img src="<?php echo $banner_bottom2['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>
    <?php } else { ?>
    <div class="image"><img src="<?php echo $banner_bottom2['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
    <?php } ?>
  </div>
</div>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#latest_category<?php echo $module; ?> .owl-carousel.latest_category_tabs").owlCarousel({
			itemsCustom : [[320, 1],[500, 2],[768, 3],[992, 4],[1199, 5]],
			lazyLoad : true,
			navigation : true,
			navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			scrollPerPage : true,
	});
	$("#latest_category<?php echo $module; ?> .tab_content").addClass("deactive");
	$("#latest_category<?php echo $module; ?> .tab_content:first").show();
	//Default Action
    $("#latest_category<?php echo $module; ?> ul#sub-cat<?php echo $module; ?> li:first").addClass("active").show(); //Activate first tab
    //On Click Event
    $("#latest_category<?php echo $module; ?> ul#sub-cat<?php echo $module; ?> li").click(function() {
        $("#latest_category<?php echo $module; ?> ul#sub-cat<?php echo $module; ?> li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
		$("#latest_category<?php echo $module; ?> .tab_content").hide(); 
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });
});
</script>
<?php } ?>
