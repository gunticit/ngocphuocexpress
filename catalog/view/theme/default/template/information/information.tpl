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
<?php if(!$aboutus){ ?> 
  <div class="container">
  <div class="row"><?php echo $column_left; ?>
  <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
  <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } ?>
  <div id="content" class="<?php echo $class; ?>">
    <div class="bg-contact" >
      <?php echo $content_top; ?>
      <?php echo $description; ?><?php echo $content_bottom; ?></div>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php } else { ?>
  <div class="cnt-aboutus" style="background: url('<?= $bg_img; ?>');    background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 .col-md-offset-6">
          <div class="cnt-cnt-about">
            <div class="title">
              <h3><?php echo $heading_title; ?></h3>
            </div>
            <div class="description">
              <?= $description; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?php echo $footer; ?> 