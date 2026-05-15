<?php foreach ($categories as $category) { ?>
<div class="product-categories">
  <div class="bg-pro-cat">
    <div class="row">
    <div class="col-sm-12">
      <div class="pro-all-cat row">
        <?php foreach ($category['products'] as $product) { ?>
        <div class="col-md-4">
          <?php include($product_item); ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
