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
<div class="bg-category pro-cat-pro">
  <div class="container">
    <?php echo $content_top; ?>
    <?php if ($thumb || $description) { ?>
      <div class="row" style="padding: 30px 0;">
        <?php if ($description) { ?>
          <div class="col-sm-7"><?php echo $description; ?></div>
        <?php } ?>
        <?php if ($thumb) { ?>
          <div class="col-sm-5">
            <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail" />
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    <?php if ($products) { ?>
  <!-- <div class="row-clear">
    <div class="col-md-6">
      <div class="row">
        <h2><?php echo $heading_title; ?></h2>
        <div class="btn-group hidden">
          <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
          <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
        </div>
      </div>
    </div>
    <div class="col-md-2 text-right texts-sort">
      <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
    </div>
    <div class="col-md-4 text-right">
      <div class="row">
        <select id="input-sort" class="form-control" onchange="location = this.value;">
          <?php foreach ($sorts as $sorts) { ?>
          <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
          <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <br /> -->
  <?php foreach ($products as $product) { ?>
    <div class="col-sm-4 col-xs-12">
      <?php include('product_item.tpl'); ?>
    </div>
  <?php } ?>
  <div style="clear:both; width:100%">
    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
  </div>
<?php } ?>
<?php if (!$categories && !$products) { ?>
  <p><?php echo $text_empty; ?></p>
  <div class="buttons">
    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
  </div>
<?php } ?>
<?php echo $content_bottom; ?></div></div>
  <!-- 
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
      
      <?php echo $column_right; ?></div> 
    </div>
  </div>
-->
<?php echo $footer; ?>
