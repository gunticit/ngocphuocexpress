<div class="pro-lastest">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">

 <!--  <div class="des-lastest">

    <?= $description_about; ?>

  </div> -->

  <div class="box-title">

    <h3>THÔNG TIN CÁC TUYẾN <?= $owner; ?></h3>

  </div>

  <?php if (isset($banner_left['thumb']) && isset($banner_right['thumb'])) { ?>

  <?php $class = 'col-sm-12'; ?>

  <?php $item = '[[320, 2],[500, 2],[768, 3],[992, 3],[1199, 4]]'; ?>

  <?php } else if (isset($banner_left['thumb']) || isset($banner_right['thumb'])) { ?>

  <?php $class = 'col-sm-12'; ?>

  <?php $item = '[[320, 2],[500, 2],[768, 3],[992, 3],[1199, 4]]'; ?>

  <?php } else { ?>

  <?php $class = 'col-sm-12'; ?>

  <?php $item = '[[320, 2],[500, 2],[768, 3],[992, 5],[1199, 5]]'; ?>

  <?php } ?>

  <div class="<?php echo $class; ?>">

    <div class="row">

      <?php if(isset($homepage) && $homepage != '' && $homepage != null ){ ?> 

      <div class="latest_module">

        <?php foreach ($products as $key => $product) { ?>

        <div class="item-pro-latest">

          <?php include($product_item); ?>

        </div>

        <?php } ?>

      </div>

      <?php } else { ?>

      <div class="latest_module-r">

        <?php foreach ($products as $key => $product) { ?>

        <div class="item-pro-latest">

          <?php include($product_item); ?>

        </div>

        <?php } ?>

      </div>

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

</div>
</div>
</div>
</div>

<div class="row banner-lastest">

  <?php if (isset($banner_left['thumb'])) { ?>

  <div class="col-sm-6">

    <?php if (!empty($banner_left['link'])) { ?>

    <div class="image"><a href="<?php echo $banner_left['link']; ?>"><img src="<?php echo $banner_left['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>

    <?php } else { ?>

    <div class="image"><img src="<?php echo $banner_left['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>

    <?php } ?> 

  </div>

  <?php } ?>

  <?php if (isset($banner_right['thumb'])) { ?>

  <div class="col-sm-6">

    <?php if (!empty($banner_right['link'])) { ?>

    <div class="image"><a href="<?php echo $banner_right['link']; ?>"><img src="<?php echo $banner_right['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>

    <?php } else { ?>

    <div class="image"><img src="<?php echo $banner_right['thumb']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>

    <?php } ?>

  </div>

  <?php } ?>

</div>
<script>
  $('.latest_module').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    ]
  });
</script>
<!-- <script type="text/javascript">

 $(document).ready(function() {

  $(".owl-carousel.latest_module").owlCarousel({

   itemsCustom : <?php echo $item; ?>,											   

   lazyLoad : true,

   navigation : true,

   navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],

   scrollPerPage : true

 }); 

});

</script> -->