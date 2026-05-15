<?php echo $header; ?>
<div class="page-title title-left transparent-bg" style="min-height: 50px;">
  <div class="wf-wrap">
    <div class="wf-container-title">
      <div class="wf-table container" style="height: 50px;">
        <div class="row">
          <div class="wf-td col-sm-7"><h1 class="h3-size entry-title"><?php echo $heading_title; ?></h1></div>
          <div class="wf-td col-sm-5"><div class="assistive-text"></div>
          <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="<?php echo $breadcrumb['href']; ?>" itemprop="item"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a></li>
            <?php } ?>
          </ul> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">

  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">

          <div class="box_gallery">
          <div class="list_gallery">
              <div class="row">
            <?php if ($gallerys) { ?> 
                  <div class="thumbnails">
                  <?php foreach ($gallerys as $gallery) { ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="item-lb">
                    <div class="item-gallery">
                      <div class="image"><a class="apopup" href="<?php echo $gallery['popup'];?>" "><img src="<?php echo $gallery['thumb'];?>" ></a></div>
                     
                    </div>
                  </div>
                    </div>
                  <?php } ?>
                  </div>    
             <?php } ?>
          </div>
            </div>
        
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<style type="text/css">
  .mfp-wrap, .mfp-bg{
    z-index: 99999;
  }
</style>
<script type="text/javascript">
  



$(document).ready(function() {
  $('.thumbnails').magnificPopup({
    type:'image',
    delegate: 'a',
    gallery: {
      enabled:true
    }
  });
});

</script>

<?php echo $footer; ?>
