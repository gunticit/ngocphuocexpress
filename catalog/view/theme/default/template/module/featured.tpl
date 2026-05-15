<div class="sp-nb row">

  <div class="col-sm-12">

    <div class="bg-sp-nb">

      <div class="box-title">

        <h3><?php echo $heading_title; ?></h3>

      </div>

      <?php if (isset($banner_left['thumb']) && isset($banner_right['thumb'])) { ?>

      <?php $class = 'col-sm-6'; ?>

      <?php $item = '[[320, 2],[600, 2],[768, 2],[992, 2],[1199, 2]]'; ?>

      <?php } else if (isset($banner_left['thumb']) || isset($banner_right['thumb'])) { ?>

      <?php $class = 'col-sm-9'; ?>

      <?php $item = '[[320, 2],[600, 2],[768, 3],[992, 3],[1199, 3]]'; ?>

      <?php } else { ?>

      <?php $class = 'col-sm-12'; ?>

      <?php $item = '[[320, 2],[600, 2],[768, 3],[992, 3],[1199, 5]]'; ?>

      <?php } ?>

      <?php if (isset($banner_left['thumb'])) { ?>

      <div class="col-sm-3">

        <div class="row">

          <?php if (!empty($banner_left['link'])) { ?>

          <div class="image"><a href="<?php echo $banner_left['link']; ?>"><img src="<?php echo $banner_left['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>

          <?php } else { ?>

          <div class="image"><img src="<?php echo $banner_left['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>

          <?php } ?>

        </div>

      </div>

      <?php } ?>

      <div class="<?php echo $class; ?>">

        <div class="row">

          <div class="featured_carousel">

            <?php foreach ($products as $product) { ?>

            <div class="item-product col-sm-4 col-xs-12">

              <?php include($product_item); ?>

            </div>

            <?php } ?>

            <div class="col-sm-12" style="text-align: center;">
              <a class="xt-tt-banner-grid" href="san-pham">Xem thêm</a>
            </div>
          </div>

        </div>

      </div>

      <?php if (isset($banner_right['thumb'])) { ?>

      <div class="col-sm-3">

        <div class="row">

          <?php if (!empty($banner_right['link'])) { ?>

          <div class="image"><a href="<?php echo $banner_right['link']; ?>"><img src="<?php echo $banner_right['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>

          <?php } else { ?>

          <div class="image"><img src="<?php echo $banner_right['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>

          <?php } ?>

        </div>

      </div>

      <?php } ?>

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

    </div>

  </div>

</div><!-- 

<script type="text/javascript">

(function($) {

  $(function() {

    $(".featured_carousel").simplyScroll({orientation:'vertical',customClass:'vert'});

  });

})(jQuery);

</script> -->

<!-- <script type="text/javascript">

 $(document).ready(function() {

  $(".owl-carousel.featured_carousel").owlCarousel({

   itemsCustom : <?php echo $item; ?>,											   

   lazyLoad : true,

   navigation : true,

   navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],

   scrollPerPage : true

 }); 

});

</script> -->