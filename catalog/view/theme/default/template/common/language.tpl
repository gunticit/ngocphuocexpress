<?php if (count($languages) > 1) { ?>
<div>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language">
    <div class="btn-group">
          <?php foreach ($languages as $language) { ?>
          <span><a href="<?php echo $language['code']; ?>"><img src="<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /></a></span>
          <?php } ?>
      </div>
      <input type="hidden" name="code" value="" />
      <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
    </form>
  </div>
  <?php } ?>
