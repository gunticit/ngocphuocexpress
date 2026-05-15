<?php echo $header; ?>

<div class="container"> <?php echo $breadcrumb; ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h2 class="box-title-1"><?php echo $heading_title; ?></h2>
      <?php if ($products) { ?>
      <div class="ui-sortable-handle page-frame">
        <div class="row">
          <div class="block">
            <div class="product-category" id="product-category">
              <div class="category-container">
                <p><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></p>
                <div class="row">
                  <div class="col-md-4">
                    <div class="btn-group hidden-xs">
                      <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" 
                      title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
                      <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip"
                       title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
                    </div>
                  </div>
                  <div class="col-md-2 text-right">
                    <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
                  </div>
                  <div class="col-md-3 text-right">
                    <select id="input-sort" class="form-control box-input-1" onchange="location = this.value;">
                      <?php foreach ($sorts as $sorts) { ?>
                      <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                      <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-1 text-right">
                    <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
                  </div>
                  <div class="col-md-2 text-right">
                    <select id="input-limit" class="form-control box-input-1" onchange="location = this.value;">
                      <?php foreach ($limits as $limits) { ?>
                      <?php if ($limits['value'] == $limit) { ?>
                      <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <br />
                <div class="row">
                  <?php foreach ($products as $product) { ?>
                  <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?php include('product_item.tpl'); ?>
                  </div>
                  <?php } ?>
                </div>
                <div class="row">
                  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>