<!-- <h3><?php echo $heading_title; ?></h3>
<div class="list-group">
<ul class="list-item">
  <?php if (!$logged) { ?>
  <li><a href="<?php echo $login; ?>" ><?php echo $text_login; ?></a></li>
  <li><a href="<?php echo $register; ?>" ><?php echo $text_register; ?></a></li>
  <li><a href="<?php echo $forgotten; ?>" ><?php echo $text_forgotten; ?></a></li>
  <?php } ?>
  <li><a href="<?php echo $account; ?>" ><?php echo $text_account; ?></a></li>
  <?php if ($logged) { ?>
  <li><a href="<?php echo $edit; ?>" ><?php echo $text_edit; ?></a></li>
  <li><a href="<?php echo $password; ?>" ><?php echo $text_password; ?></a></li>
  <?php } ?>
  <li><a href="<?php echo $address; ?>" ><?php echo $text_address; ?></a></li>
  <li><a href="<?php echo $wishlist; ?>" ><?php echo $text_wishlist; ?></a></li>
  <li><a href="<?php echo $order; ?>" ><?php echo $text_order; ?></a></li>
  <li><a href="<?php echo $download; ?>" ><?php echo $text_download; ?></a></li>
  <li><a href="<?php echo $recurring; ?>" ><?php echo $text_recurring; ?></a></li>
  <li><a href="<?php echo $reward; ?>" ><?php echo $text_reward; ?></a></li>
  <li><a href="<?php echo $return; ?>" ><?php echo $text_return; ?></a></li>
  <li><a href="<?php echo $transaction; ?>" ><?php echo $text_transaction; ?></a></li>
  <li><a href="<?php echo $newsletter; ?>" ><?php echo $text_newsletter; ?></a></li>
  <?php if ($logged) { ?>
  <li><a href="<?php echo $logout; ?>" ><?php echo $text_logout; ?></a></li>
  <?php } ?>
  </ul>
</div> -->

<div class="module-category-account">
  <ul>
    <?php foreach ($categories as $category){ ?>
    <li><a href="<?= $category['href']; ?>"><?= $category['name']; ?></a></li>
    <?php if($category['children']){ ?> 
    <div class="danh-muc-home">
      <ul>
        <?php foreach($category['children'] as $child){ ?> 
        <li>
          <div class="image"><a href="<?= $child['href']; ?>">
            <img src="image/<?= $child['image']; ?>" alt="<?= $child['name']; ?>">
            <div class="view_detail"> <span>Xem chi tiết</span></div>
          </a></div>
          <div class="caption">
            <h3><a href="<?= $child['href']; ?>"><?= $child['name']; ?></a></h3>
            <h4><?= $child['meta_description']; ?></h4>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
    <?php } ?>
  </ul>
</div>