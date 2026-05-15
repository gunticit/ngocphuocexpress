<div class="form-group required">
  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-android"></i></span>
    <input type="text" name="captcha" id="input-captcha" class="form-control box-input-1" placeholder="<?php echo $entry_captcha; ?>" />
    <img src="index.php?route=common/captcha/captcha" alt="captcha" class="captcha-image" /> </div>
  <?php if ($error_captcha) { ?>
  <div class="text-danger"><?php echo $error_captcha; ?></div>
  <?php } ?>
</div>
