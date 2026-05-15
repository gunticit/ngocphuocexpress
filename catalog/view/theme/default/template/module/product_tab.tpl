<div id="product-tab-<?php echo $module; ?>" class="product-tab">
  <ul id="tabs-<?php echo $module; ?>" class="tabs">
    <?php if($products && $featured_products_status == 1){ ?>
    <li><a href="#tab-featured-<?php echo $module; ?>"><?php echo $tab_featured; ?></a></li>
    <?php } ?>
    <?php if($latest_products && $latest_products_status == 1){ ?>
    <li><a href="#tab-latest-<?php echo $module; ?>"><?php echo $tab_latest; ?></a></li>
    <?php } ?>
    <?php if($bestseller_products && $bestseller_products_status == 1){ ?>
    <li><a href="#tab-bestseller-<?php echo $module; ?>"><?php echo $tab_bestseller; ?></a></li>
    <?php } ?>
    <?php if($special_products && $special_products_status == 1){ ?>
    <li><a href="#tab-special-<?php echo $module; ?>"><?php echo $tab_special; ?></a></li>
    <?php } ?>
  </ul>
  <?php if($products && $featured_products_status == 1){ ?>
  <div id="tab-featured-<?php echo $module; ?>" class="tab_content">
    <div class="owl-carousel product_carousel_tab">
      <?php foreach ($products as $product) { ?>
        <?php include($product_item); ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if($latest_products && $latest_products_status == 1){ ?>
  <div id="tab-latest-<?php echo $module; ?>" class="tab_content">
    <div class="owl-carousel product_carousel_tab">
      <?php foreach ($latest_products as $product) { ?>
        <?php include($product_item); ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if($bestseller_products && $bestseller_products_status == 1){ ?>
  <div id="tab-bestseller-<?php echo $module; ?>" class="tab_content">
    <div class="owl-carousel product_carousel_tab">
      <?php foreach ($bestseller_products as $product) { ?>
        <?php include($product_item); ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if($special_products && $special_products_status == 1){ ?>
  <div id="tab-special-<?php echo $module; ?>" class="tab_content">
    <div class="owl-carousel product_carousel_tab">
      <?php foreach ($special_products as $product) { ?>
        <?php include($product_item); ?>
      <?php } ?>
    </div>
  </div>
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
	$("#product-tab-<?php echo $module; ?> .product_carousel_tab").owlCarousel({
		itemsCustom : [[320, 1],[600, 2],[768, 3],[992, 3],[1199, 4]],											   
		lazyLoad : true,
		navigation : true,
		navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		scrollPerPage : true
    }); 
	$("#product-tab-<?php echo $module; ?> .tab_content").addClass("deactive");
	$("#product-tab-<?php echo $module; ?> .tab_content:first").show();
    //Default Action
    $("ul#tabs-<?php echo $module; ?> li:first").addClass("active").show(); //Activate first tab
    //On Click Event
    $("ul#tabs-<?php echo $module; ?> li").click(function() {
        $("ul#tabs-<?php echo $module; ?> li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
		$("#product-tab-<?php echo $module; ?> .tab_content").hide(); 
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });
});
</script>
