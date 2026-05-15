<?php if ($status == 1) { ?>
  <div id="banner-grid<?php echo $module; ?>" class="banner-grid">
    <div class="cnt-banner-grd">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="box-title">
              <h2 class="wow animated fadeInDown animated"><?= $heading_title; ?></h2>
              <div class="shortdess-bannergrid wow animated fadeInDown animated">
                <?= $shortdess; ?>
              </div>
            </div>
            <div class="banner-grid-container<?php echo $module; ?>">
              <div class="banner-grid-row<?php echo $module; ?>">
                <?php foreach ($banners as $key => $banner) { ?>
                  <?php if ($banner['link']) { ?>
                    <div class="<?php echo $perrow_id; ?> moderns wow animated fadeInDown animated">
                      <div class="bg-banner">
                        <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
                      </div>
                      <div class="descript-banner">
              <h5><a href="<?php echo $banner['link']; ?>"><?php echo $banner['title']; ?></a></h5><!-- 
              <p><?php echo $banner['description'];?></p>
              <a href="javascript:void(0);" class="vm-banner">Xem thêm</a> -->
            </div>
          </div>
        <?php } else { ?>
          <div class="<?php echo $perrow_id; ?> moderns wow animated fadeInDown animated">
            <div class="bg-banner">
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
            </div>
            <div class="descript-banner">
              <h5><?php echo $banner['title']; ?></h5><!-- 
              <p><?php echo $banner['description'];?></p>
              <a href="javascript:void(0);" class="vm-banner">Xem thêm</a> -->
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="ladi-widget-overlay"></div>
</div>
<?php } else if ($status == 2) { ?>
  <div class="banner-8img">
    <h2 class="wow animated fadeInDown animated"><?= $heading_title; ?></h2>
    <div id="banner-grid<?php echo $module; ?>" class="banner-grid">
      <div class="col-sm-4">
        <?php foreach ($banners1 as $key => $banner) { ?>
          <?php if($key == 0){ ?> 
            <div class="col-sm-6 img-1x">
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
            </div>
          <?php } ?>
          <?php if($key == 1){ ?> 
            <div class="col-sm-6 img-1x">
              <div class="image">
                <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
                <span class="title-img1">
                  <?php echo $banner['title']; ?>
                </span>
              </div>
            </div>
          <?php } ?>
          <?php if($key == 2){ ?>
            <div class="col-sm-12 img-1x">
              <div class="image">
                <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
                <span class="title-img2">
                  <?php echo $banner['title']; ?>
                </span>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <div class="col-sm-4">
        <?php foreach($banners2 as $key => $banner){ ?> 
          <?php if($key < 2){ ?> 
            <div class="col-sm-6 img-2x">
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <div class="col-sm-4">
        <?php foreach($banners3 as $key => $banner){ ?> 
          <?php if($key == 0 ){ ?> 
            <div class="col-sm-12 img-1x">
              <div class="image">
                <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
                <span class="title-img1">
                  <?php echo $banner['title']; ?>
                </span>
              </div>
            </div>
          <?php } else if($key > 0 && $key <= 2) { ?>
            <div class="col-sm-6 img-1x">
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
            </div>
          <?php } ?> 
        <?php } ?>
      </div>
    </div>
  </div>
<?php } else if ($status == 3) { ?>
  <div class="banner-grid-noimg">
    <div class="box-title">
      <h3><?= $heading_title; ?></h3>
      <div class="shortdess-bannergrid">
        <?= $shortdess; ?>
      </div>
    </div>
    <div class="content-bannergrid">
      <?php foreach ($banners as $key => $banner) { ?>
        <?php if($key % 2 != 0){ ?> 
          <div class="row-keyl">
            <div class="bannergrid-itemgrid">
              <div class="max-380px">
                <div class="content-banner-g">
                  <h5><?php echo $banner['title']; ?></h5>
                  <p><?php echo $banner['description'];?></p>
                </div>
              </div>
            </div>
            <div class="bannergrid-itemle">
              <div class="max-380px">
                <span class="span_key">
                  <?php if($key < 10){ ?> 
                    <?= '0'. ++$key; ?>
                  <?php } else { ?>
                    <?= $key; ?>
                  <?php } ?>
                </span>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="row-keyr">
            <div class="bannergrid-itemgrid">
              <div class="max-380px">
                <span class="span_key">
                  <?php if($key < 10){ ?> 
                    <?= '0'. ++$key; ?>
                  <?php } else { ?>
                    <?= $key; ?>
                  <?php } ?>
                </span>
              </div>
            </div> 
            <div class="bannergrid-itemle">
              <div class="max-380px">
                <div class="content-banner-g">
                  <h5><?php echo $banner['title']; ?></h5>
                  <p><?php echo $banner['description'];?></p>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
<?php } else if ($status == 4) { ?>
  <?php foreach($banners as $key => $banner){ ?> 
    <?php if($key == 0 ){ ?> 
      <div class="col-sm-6">
        <div class="image">
          <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
        </div>
      </div>
      <div class="col-sm-6">
        <h3 class="title-img">
          <?php echo $banner['title']; ?>
        </h3>
        <div class="des-img">
          <?php echo $shortdess; ?>
        </div>
        <a style="background-color:#39b54a; color:#ffffff;" class="btn-link-banner" href="<?php echo $banner['link']; ?>" title="">Xem thêm</a>
      </div>
    <?php } ?> 
  <?php } ?>
<?php } else if ($status == 5) { ?>
  <?php foreach($banners as $key => $banner){ ?> 
    <?php if($key == 0 ){ ?> 
      <div class="col-sm-6">
        <h3 class="title-img">
          <?php echo $banner['title']; ?>
        </h3>
        <div class="des-img">
          <?php echo $shortdess; ?>
        </div>
        <a style="background-color:#39b54a; color:#ffffff;" class="btn-link-banner" href="<?php echo $banner['link']; ?>" title="">Xem thêm</a>
      </div>
      <div class="col-sm-6">
        <div class="image">
          <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" />
        </div>
      </div>
    <?php } ?> 
  <?php } ?>
<?php } else if ($status == 6) { ?>
  <h2 class="tt-banner-grid"><?= $heading_title; ?></h2>
  <?php foreach($banners as $key => $banner){ ?> 
    <div class="col-sm-2">
      <div class="box-number-label">
        <div class="box-icon icon-circle icon-bg-green font-SamsungSharpSans-Bold mar-auto"><?= ++$key; ?></div>
        <div class="box-label text-center">
          <h5><?= $banner['title']; ?></h5>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="col-sm-12" style="text-align: center;">
    <a class="xt-tt-banner-grid" href="#">Xem thêm</a>
  </div>
<?php } else if ($status == 7) { ?>

<?php } else if ($status == 8) { ?>

<?php } else if ($status == 9) { ?>

<?php } else if ($status == 10) { ?>

<?php } else if ($status == 11) { ?>

<?php } else { } ?>
